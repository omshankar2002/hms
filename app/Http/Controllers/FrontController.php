<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Page;
use App\Models\Product;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\SocialLink;
use App\Models\Service;
use App\Models\Wishlist;
use App\Models\Appointment;
use App\Models\NewsletterSubscriber;
use App\Models\BlogCategory;
use App\Models\AboutSection;
use App\Models\Banner;
// HMS Models
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
public function index() {
    $data['socialLink']   = SocialLink::first();
    $data['services']     = Service::where('status', 1)->orderBy('id', 'DESC')->take(6)->get();
    $data['banner']       = Banner::first();
    $data['about']        = AboutSection::first();
    $data['testimonials'] = Testimonial::where('status', 1)->orderBy('id', 'DESC')->take(6)->get();
    $data['faqs']         = Faq::where('status', 1)->orderBy('id', 'DESC')->take(8)->get();
    $data['blogs']        = Blog::where('status', 1)->latest()->take(3)->get();

    // HMS: Featured room types for homepage
    $data['roomTypes']    = RoomType::where('status', 'active')->withCount('availableRooms')->take(6)->get();

    return view('front.home', $data);
}

// =============================================
// HMS Frontend Methods
// =============================================

public function rooms(Request $request)
{
    $query = RoomType::where('status', 'active')->withCount(['rooms', 'availableRooms']);

    if ($request->filled('min_price')) {
        $query->where('base_price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('base_price', '<=', $request->max_price);
    }
    if ($request->filled('adults')) {
        $query->where('max_adults', '>=', $request->adults);
    }

    $roomTypes   = $query->get();
    $socialLink  = SocialLink::first();

    return view('front.rooms', compact('roomTypes', 'socialLink'));
}

public function roomDetail($slug)
{
    $roomType   = RoomType::where('slug', $slug)->where('status', 'active')->firstOrFail();
    $roomType->load('availableRooms');
    $related    = RoomType::where('status', 'active')->where('id', '!=', $roomType->id)->take(3)->get();
    $socialLink = SocialLink::first();

    return view('front.room-detail', compact('roomType', 'related', 'socialLink'));
}

public function bookingForm(Request $request)
{
    $roomTypes  = RoomType::where('status', 'active')->get();
    $checkIn    = $request->check_in  ?? date('Y-m-d');
    $checkOut   = $request->check_out ?? date('Y-m-d', strtotime('+1 day'));
    $roomTypeId = $request->room_type_id ?? null;
    $socialLink = SocialLink::first();

    // Check available rooms for selected dates
    $availableRooms = [];
    if ($request->filled('check_in') && $request->filled('check_out')) {
        $bookedRooms = Booking::whereIn('status', ['confirmed', 'checked_in'])
            ->where(function ($q) use ($checkIn, $checkOut) {
                $q->whereBetween('check_in', [$checkIn, $checkOut])
                  ->orWhereBetween('check_out', [$checkIn, $checkOut])
                  ->orWhere(function ($q2) use ($checkIn, $checkOut) {
                      $q2->where('check_in', '<=', $checkIn)->where('check_out', '>=', $checkOut);
                  });
            })->pluck('room_id');

        $availableRooms = Room::whereNotIn('id', $bookedRooms)
            ->where('status', 'available')
            ->with('roomType')
            ->get();
    }

    return view('front.booking', compact('roomTypes', 'checkIn', 'checkOut', 'roomTypeId', 'availableRooms', 'socialLink'));
}

public function storeBooking(Request $request)
{
    $request->validate([
        'guest_name'  => 'required|string|max:255',
        'guest_phone' => 'required|string|max:20',
        'guest_email' => 'nullable|email',
        'room_id'     => 'required|exists:rooms,id',
        'check_in'    => 'required|date|after_or_equal:today',
        'check_out'   => 'required|date|after:check_in',
        'adults'      => 'required|integer|min:1',
    ]);

    $guest = Guest::firstOrCreate(
        ['phone' => $request->guest_phone],
        ['name' => $request->guest_name, 'email' => $request->guest_email]
    );
    $guest->update(['name' => $request->guest_name, 'email' => $request->guest_email]);

    $room     = Room::with('roomType')->findOrFail($request->room_id);
    $checkIn  = Carbon::parse($request->check_in);
    $checkOut = Carbon::parse($request->check_out);
    $nights   = $checkIn->diffInDays($checkOut);
    $rate     = $room->roomType->base_price;
    $subtotal = $rate * $nights;
    $tax      = round($subtotal * 0.12, 2);

    $booking = Booking::create([
        'booking_number'   => 'BK' . date('Ymd') . str_pad(Booking::count() + 1, 4, '0', STR_PAD_LEFT),
        'guest_id'         => $guest->id,
        'room_id'          => $room->id,
        'check_in'         => $request->check_in,
        'check_out'        => $request->check_out,
        'adults'           => $request->adults,
        'children'         => $request->children ?? 0,
        'room_rate'        => $rate,
        'nights'           => $nights,
        'room_total'       => $subtotal,
        'services_total'   => 0,
        'discount'         => 0,
        'tax'              => $tax,
        'grand_total'      => $subtotal + $tax,
        'amount_paid'      => 0,
        'amount_due'       => $subtotal + $tax,
        'status'           => 'pending',
        'payment_status'   => 'unpaid',
        'source'           => 'online',
        'special_requests' => $request->special_requests,
    ]);

    $room->update(['status' => 'booked']);

    return redirect()->route('front.booking.confirm', $booking->id)
                     ->with('success', 'Booking confirmed! Your booking number is ' . $booking->booking_number);
}



public function bookingConfirm($id)
{
    $booking    = Booking::with('guest', 'room.roomType')->findOrFail($id);
    $socialLink = SocialLink::first();
    return view('front.booking-confirm', compact('booking', 'socialLink'));
}

    public function services()
    {
        $services   = Service::where('status', 1)->latest()->get();
        $socialLink = SocialLink::first();
        return view('front.services', compact('services', 'socialLink'));
    }

    // =============================================
    // Guest Booking Portal
    // =============================================

    public function myBooking()
    {
        $socialLink = SocialLink::first();
        return view('front.my-booking', compact('socialLink'));
    }

    public function findBooking(Request $request)
    {
        $request->validate([
            'booking_number' => 'required|string',
            'phone'          => 'required|string',
        ]);

        $booking = Booking::with('guest', 'room.roomType')
            ->where('booking_number', strtoupper(trim($request->booking_number)))
            ->whereHas('guest', fn($q) => $q->where('phone', $request->phone))
            ->first();

        if (!$booking) {
            return back()->withInput()->withErrors([
                'not_found' => 'No booking found with this Booking Number and Phone combination. Please check and try again.'
            ]);
        }

        return redirect()->route('front.myBookingDetail', $booking->booking_number);
    }

    public function myBookingDetail($bookingNumber)
    {
        $booking = Booking::with(['guest', 'room.roomType', 'bookingServices.hotelService', 'payments'])
            ->where('booking_number', $bookingNumber)
            ->firstOrFail();

        $socialLink = SocialLink::first();
        return view('front.my-booking-detail', compact('booking', 'socialLink'));
    }

    public function publicCheckAvailability(Request $request)
    {
        $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $bookedRooms = Booking::whereIn('status', ['confirmed', 'checked_in'])
            ->where(function ($q) use ($request) {
                $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                  ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                  ->orWhere(function ($q2) use ($request) {
                      $q2->where('check_in', '<=', $request->check_in)
                         ->where('check_out', '>=', $request->check_out);
                  });
            })->pluck('room_id');

        $rooms = Room::whereNotIn('id', $bookedRooms)
            ->where('status', 'available')
            ->with('roomType')
            ->get();

        return response()->json($rooms);
    }
    
  
    public function media()
    {
        return view('front.media'); 
    }

    public function addToWishlist(Request $request){
        if (Auth::check() == false) {

            session(['url.intended' => url()->previous()]);

            return response()->json([
                'status' => false
            ]);
        } 

        $product = Product::where('id',$request->id)->first();

        if ($product == null) {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-danger">Product not found.</div>'
            ]);
        }


        Wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]
        );



        // $wishlist = new Wishlist;
        // $wishlist->user_id = Auth::user()->id;
        // $wishlist->product_id = $request->id;
        // $wishlist->save();        

        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success"><strong>"'.$product->title.'"</strong> added in your wishlist</div>'
        ]);

    }
    public function faqs()
    {
        $faqs       = Faq::where('status', 1)->orderBy('created_at', 'asc')->get();
        $socialLink = SocialLink::first();
        return view('front.faqs', compact('faqs', 'socialLink'));
    }
    
    public function testimonials()
    {
        $testimonials = Testimonial::where('status', 1)->latest()->get();
        $socialLink   = SocialLink::first();
        return view('front.testimonials', compact('testimonials', 'socialLink'));
    }    


    public function blogs(Request $request)
    {
        $query = Blog::where('status', 1)->orderBy('created_at', 'desc');

        // If category_id is selected, filter by it
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $blogs       = $query->paginate(6);
        $recentBlogs = Blog::where('status', 1)->latest()->take(3)->get();
        $categories  = BlogCategory::where('status', 1)->get();
        $socialLink  = SocialLink::first();

        return view('front.blogs', compact('blogs', 'recentBlogs', 'categories', 'socialLink'));
    }


    
    public function show($slug)
    {
        $blog        = Blog::where('slug', $slug)->firstOrFail();
        $recentBlogs = Blog::where('status', 1)->latest()->take(4)->get();
        $socialLink  = SocialLink::first();
        return view('front.show', compact('blog', 'recentBlogs', 'socialLink'));
    }

    public function contact()
    {
        $socialLink = SocialLink::first();
        return view('front.contact', compact('socialLink'));
    }
    
    public function colorquiz()
    {
        return view('front.colorquiz');
    }

    public function appointment()
    {
        return view('front.appointment');
    }

    public function termsconditions()
    {
        return view('front.terms-&-conditions'); 
    }

    public function refundpolicy()
    {
        return view('front.refund-policy'); 
    }

    public function privacypolicy()
    {
        return view('front.privacy-policy'); 
    }
    
    public function page($slug) {
        $page = Page::where('slug',$slug)->first();
        if($page == null) {
            abort(404);
        } 
        return view('front.page',[
            'page' => $page
        ]);
        
    }

public function subscribe(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:newsletter_subscribers,email',
    ]);

    NewsletterSubscriber::create([
        'email' => $request->email,
    ]);

   return redirect()->to(route('front.home', ['newsletter' => 1]))
                 ->with('success', 'Newsletter subscribed successfully!');

}
    

    public function sendContactEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'contact-name' => 'required',
            'contact-email' => 'required|email',
            'contact-phone' => 'required|numeric',
            'service' => 'required',
            'contact-message' => 'required|min:10',
            'contact_time' => 'required|array|min:1'
        ], [
            'contact_time.required' => 'Please select at least one preferred contact time'
        ]);
    
        if ($validator->passes()) {
            // डेटाबेस में सेव करें
            $appointment = Appointment::create([
                'name' => $request->input('contact-name'), // 'contact-name' → 'name' (डेटाबेस कॉलम)
                'email' => $request->input('contact-email'),
                'phone' => $request->input('contact-phone'),
                'service' => $request->input('service'),
                'message' => $request->input('contact-message'),
                'contact_time' => $request->input('contact_time') // JSON में सेव होगा
            ]);
    
            // ईमेल भेजें
            $mailData = [
                'contact_name' => $appointment->name,
                'contact_email' => $appointment->email,
                'contact_phone' => $appointment->phone,
                'service' => $appointment->service,
                'contact_message' => $appointment->message,
                'contact_time' => implode(', ', $appointment->contact_time),
                'mail_subject' => 'New Appointment Request'
            ];
    
            $adminEmail = 'om.shankar@wamexs.com';
            Mail::to($adminEmail)->send(new ContactEmail($mailData));
    
            session()->flash('success', 'Thanks for contacting us! We will get back to you soon.');
    
            return response()->json([
                'status' => true,
                'message' => 'Data saved and email sent successfully.'
            ]);
    
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
}
