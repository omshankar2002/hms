<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Guest;
use App\Models\HotelService;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('guest', 'room.roomType');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        if ($request->filled('date')) {
            $query->whereDate('check_in', $request->date);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('booking_number', 'like', "%$s%")
                  ->orWhereHas('guest', fn($g) => $g->where('name', 'like', "%$s%")
                                                     ->orWhere('phone', 'like', "%$s%"));
            });
        }

        $bookings = $query->latest()->paginate(20);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $roomTypes     = RoomType::where('status', 'active')->with('availableRooms')->get();
        $rooms         = Room::where('status', 'available')->with('roomType')->get();
        $hotelServices = HotelService::where('status', 'active')->get();
        return view('admin.bookings.create', compact('roomTypes', 'rooms', 'hotelServices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_name'  => 'required|string',
            'guest_phone' => 'required|string',
            'guest_email' => 'nullable|email',
            'room_id'     => 'required|exists:rooms,id',
            'check_in'    => 'required|date',
            'check_out'   => 'required|date|after:check_in',
            'adults'      => 'required|integer|min:1',
            'children'    => 'nullable|integer|min:0',
            'source'      => 'required|string',
        ]);

        // Create or find guest
        $guest = Guest::firstOrCreate(
            ['phone' => $request->guest_phone],
            [
                'name'  => $request->guest_name,
                'email' => $request->guest_email,
            ]
        );
        $guest->update(['name' => $request->guest_name, 'email' => $request->guest_email]);

        $room     = Room::with('roomType')->findOrFail($request->room_id);
        $checkIn  = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights   = $checkIn->diffInDays($checkOut);
        $rate     = $room->roomType->base_price;

        $booking = Booking::create([
            'booking_number'  => 'BK' . date('Ymd') . str_pad(Booking::count() + 1, 4, '0', STR_PAD_LEFT),
            'guest_id'        => $guest->id,
            'room_id'         => $room->id,
            'check_in'        => $request->check_in,
            'check_out'       => $request->check_out,
            'adults'          => $request->adults,
            'children'        => $request->children ?? 0,
            'room_rate'       => $rate,
            'nights'          => $nights,
            'room_total'      => $rate * $nights,
            'services_total'  => 0,
            'discount'        => $request->discount ?? 0,
            'tax'             => 0,
            'grand_total'     => 0,
            'amount_paid'     => 0,
            'amount_due'      => 0,
            'status'          => $request->status ?? 'confirmed',
            'payment_status'  => 'unpaid',
            'source'          => $request->source,
            'special_requests'=> $request->special_requests,
            'notes'           => $request->notes,
        ]);

        // Add services if any
        if ($request->filled('services')) {
            foreach ($request->services as $serviceData) {
                if (!empty($serviceData['id']) && !empty($serviceData['qty'])) {
                    $svc = HotelService::find($serviceData['id']);
                    if ($svc) {
                        BookingService::create([
                            'booking_id'      => $booking->id,
                            'hotel_service_id'=> $svc->id,
                            'quantity'        => $serviceData['qty'],
                            'unit_price'      => $svc->price,
                            'total_price'     => $svc->price * $serviceData['qty'],
                        ]);
                    }
                }
            }
        }

        // Update room status
        $room->update(['status' => 'booked']);

        // Recalculate totals
        $booking->recalculateTotals();

        return redirect()->route('bookings.show', $booking->id)
                         ->with('success', 'Booking created successfully. Booking #' . $booking->booking_number);
    }

    public function show(Booking $booking)
    {
        $booking->load('guest', 'room.roomType', 'bookingServices.hotelService', 'payments');
        $hotelServices = HotelService::where('status', 'active')->get();
        return view('admin.bookings.show', compact('booking', 'hotelServices'));
    }

    public function edit(Booking $booking)
    {
        $booking->load('guest', 'room.roomType', 'bookingServices.hotelService');
        $rooms         = Room::with('roomType')->get();
        $hotelServices = HotelService::where('status', 'active')->get();
        return view('admin.bookings.edit', compact('booking', 'rooms', 'hotelServices'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'adults'    => 'required|integer|min:1',
            'status'    => 'required|string',
        ]);

        $checkIn  = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights   = $checkIn->diffInDays($checkOut);

        $booking->update([
            'check_in'         => $request->check_in,
            'check_out'        => $request->check_out,
            'adults'           => $request->adults,
            'children'         => $request->children ?? 0,
            'nights'           => $nights,
            'room_total'       => $booking->room_rate * $nights,
            'discount'         => $request->discount ?? 0,
            'status'           => $request->status,
            'special_requests' => $request->special_requests,
            'notes'            => $request->notes,
        ]);

        // Handle room status change when cancelled/checked_out
        if (in_array($request->status, ['cancelled', 'checked_out'])) {
            $booking->room->update(['status' => 'available']);
        }

        $booking->recalculateTotals();

        return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking updated.');
    }

    public function addService(Request $request, Booking $booking)
    {
        $request->validate([
            'hotel_service_id' => 'required|exists:hotel_services,id',
            'quantity'         => 'required|integer|min:1',
        ]);

        $svc = HotelService::findOrFail($request->hotel_service_id);

        BookingService::create([
            'booking_id'       => $booking->id,
            'hotel_service_id' => $svc->id,
            'quantity'         => $request->quantity,
            'unit_price'       => $svc->price,
            'total_price'      => $svc->price * $request->quantity,
            'notes'            => $request->notes,
        ]);

        $booking->recalculateTotals();

        return back()->with('success', 'Service added to booking.');
    }

    public function removeService(BookingService $bookingService)
    {
        $booking = $bookingService->booking;
        $bookingService->delete();
        $booking->recalculateTotals();

        return back()->with('success', 'Service removed from booking.');
    }

    public function checkAvailability(Request $request)
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

        $available = Room::whereNotIn('id', $bookedRooms)
                         ->where('status', '!=', 'maintenance')
                         ->with('roomType')
                         ->get();

        return response()->json($available);
    }

    public function invoice(Booking $booking)
    {
        $booking->load('guest', 'room.roomType', 'bookingServices.hotelService', 'payments');
        return view('admin.bookings.invoice', compact('booking'));
    }
}
