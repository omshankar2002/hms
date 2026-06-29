<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DiscountCodeController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\SocialLinksController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\ManageContentController;
use App\Http\Controllers\admin\AppointmentController;
use App\Http\Controllers\admin\NewsletterController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\PopupController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\RoomTypeController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\GuestController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\HousekeepingController;
use App\Http\Controllers\admin\HotelServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/test', function () {
//     orderEmail(13);
// });


Route::get('/',[FrontController::class,'index'])->name('front.home');
Route::get('/about', [PageController::class, 'about'])->name('front.about');

// HMS Frontend Routes
Route::get('/rooms', [FrontController::class, 'rooms'])->name('front.rooms');
Route::get('/rooms/{slug}', [FrontController::class, 'roomDetail'])->name('front.room-detail');
Route::get('/book-now', [FrontController::class, 'bookingForm'])->name('front.booking');
Route::post('/book-now', [FrontController::class, 'storeBooking'])->name('front.storeBooking');
Route::get('/booking-confirm/{id}', [FrontController::class, 'bookingConfirm'])->name('front.booking.confirm');
Route::get('/check-availability', [FrontController::class, 'publicCheckAvailability'])->name('front.checkAvailability');

// Guest Booking Portal
Route::get('/my-booking', [FrontController::class, 'myBooking'])->name('front.myBooking');
Route::post('/my-booking', [FrontController::class, 'findBooking'])->name('front.findBooking');
Route::get('/my-booking/{bookingNumber}', [FrontController::class, 'myBookingDetail'])->name('front.myBookingDetail');
Route::get('/faqs', [FrontController::class, 'faqs'])->name('front.faqs');
Route::get('/testimonials', [FrontController::class, 'testimonials'])->name('front.testimonials');
Route::get('/blogs', [FrontController::class, 'blogs'])->name('front.blogs');
Route::get('/blogs/{slug}', [FrontController::class, 'show'])->name('front.show');
Route::get('/services', [FrontController::class, 'services'])->name('front.services');
Route::get('/media', [FrontController::class, 'media'])->name('front.media');
Route::get('/color-quiz', [FrontController::class, 'colorquiz'])->name('front.colorquiz');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/appointment', [FrontController::class, 'appointment'])->name('front.appointment');
Route::get('/terms-&-conditions', [FrontController::class, 'termsconditions'])->name('front.terms-&-conditions');
Route::get('/refund-policy', [FrontController::class, 'refundpolicy'])->name('front.refund-policy');
Route::get('/privacy-policy', [FrontController::class, 'privacypolicy'])->name('front.privacy-policy');
Route::get('/products/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'])->name('front.products');
Route::get('/product/{slug}',[ShopController::class,'product'])->name('front.product');
Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');
Route::post('/update-cart',[CartController::class,'updateCart'])->name('front.updateCart');
Route::post('/delete-item',[CartController::class,'deleteItem'])->name('front.deleteItem.cart');
Route::get('/checkout',[CartController::class,'checkout'])->name('front.checkout');
Route::post('/process-checkout',[CartController::class,'processCheckout'])->name('front.processCheckout');
Route::get('/thanks/{orderId}',[CartController::class,'thankyou'])->name('front.thankyou');
Route::post('/get-order-summery',[CartController::class,'getOrderSummery'])->name('front.getOrderSummery');
Route::post('/apply-discount',[CartController::class,'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount',[CartController::class,'removeCoupon'])->name('front.removeCoupon');
Route::post('/add-to-wishlist',[FrontController::class,'addToWishlist'])->name('front.addToWishlist');
Route::get('/page/{slug}',[FrontController::class,'page'])->name('front.page');
Route::post('/send-contact-email',[FrontController::class,'sendContactEmail'])->name('front.sendContactEmail');
Route::post('/subscribe-newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('front.forgotPassword');
Route::post('/process-forgot-password',[AuthController::class,'processForgotPassword'])->name('front.processForgotPassword');
Route::get('/reset-password/{token}',[AuthController::class,'resetPassword'])->name('front.resetPassword');
Route::post('/process-reset-password',[AuthController::class,'processResetPassword'])->name('front.processResetPassword');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


Route::group(['prefix' => 'account'],function(){
    Route::group(['middleware' => 'guest'],function(){
        Route::get('/login',[AuthController::class,'login'])->name('account.login');
        Route::post('/login',[AuthController::class,'authenticate'])->name('account.authenticate');
        Route::get('/register',[AuthController::class,'register'])->name('account.register');
        Route::post('/process-register',[AuthController::class,'processRegister'])->name('account.processRegister');
    });

    Route::group(['middleware' => 'auth'],function(){
        Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
        Route::post('/update-profile',[AuthController::class,'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address',[AuthController::class,'updateAddress'])->name('account.updateAddress');
        Route::get('/change-password',[AuthController::class,'showChangePasswordForm'])->name('account.changePassword');
        Route::post('/process-change-password',[AuthController::class,'changePassword'])->name('account.processChangePassword');

        Route::get('/my-orders',[AuthController::class,'orders'])->name('account.orders');
        Route::get('/my-wishlist',[AuthController::class,'wishlist'])->name('account.wishlist');
        Route::post('/remove-product-from-wishlist',[AuthController::class,'removeProductFromWishList'])->name('account.removeProductFromWishList');
        Route::get('/order-detail/{orderId}',[AuthController::class,'orderDetail'])->name('account.orderDetail');
        Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');

       
    });
});

Route::group(['prefix' => 'admin'],function(){

    Route::group(['middleware' => 'admin.guest'],function(){
        
        Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');

    });

    Route::group(['middleware' => 'admin.auth'],function(){

        Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');

        // Category Routes
        Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
        Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
        Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
        Route::get('/categories/{category}/edit',[CategoryController::class,'edit'])->name('categories.edit');
        Route::put('/categories/{category}',[CategoryController::class,'update'])->name('categories.update');
        Route::delete('/categories/{category}',[CategoryController::class,'destroy'])->name('categories.delete');

        // Sub Category Routes
        Route::get('/sub-categories',[SubCategoryController::class,'index'])->name('sub-categories.index');
        Route::get('/sub-categories/create',[SubCategoryController::class,'create'])->name('sub-categories.create');
        Route::post('/sub-categories',[SubCategoryController::class,'store'])->name('sub-categories.store');
        Route::get('/sub-categories/{subCategory}/edit',[SubCategoryController::class,'edit'])->name('sub-categories.edit');
        Route::put('/sub-categories/{subCategory}',[SubCategoryController::class,'update'])->name('sub-categories.update');
        Route::delete('/sub-categories/{subCategory}',[SubCategoryController::class,'destroy'])->name('sub-categories.delete');


        // Brands Routes
        Route::get('/brands',[BrandController::class,'index'])->name('brands.index');
        Route::get('/brands/create',[BrandController::class,'create'])->name('brands.create');
        Route::post('/brands',[BrandController::class,'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit',[BrandController::class,'edit'])->name('brands.edit');
        Route::put('/brands/{brand}',[BrandController::class,'update'])->name('brands.update');
        Route::delete('/brands/{brand}',[BrandController::class,'destroy'])->name('brands.delete');


        // Product Routes
        Route::get('/products',[ProductController::class,'index'])->name('products.index');
        Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
        Route::post('/products',[ProductController::class,'store'])->name('products.store');
        Route::get('/products/{product}/edit',[ProductController::class,'edit'])->name('products.edit');
        Route::put('/products/{product}',[ProductController::class,'update'])->name('products.update');
        Route::delete('/products/{product}',[ProductController::class,'destroy'])->name('products.delete');
        Route::get('/get-products',[ProductController::class,'getProducts'])->name('products.getProducts');


        Route::get('/product-subcategories',[ProductSubCategoryController::class,'index'])->name('product-subcategories.index');


        Route::post('/product-images/update',[ProductImageController::class,'update'])->name('product-images.update');
        Route::delete('/product-images',[ProductImageController::class,'destroy'])->name('product-images.destroy');

        // Shipping Routes
        Route::get('/shipping/create',[ShippingController::class,'create'])->name('shipping.create');
        Route::post('/shipping',[ShippingController::class,'store'])->name('shipping.store');
        Route::get('/shipping/{id}',[ShippingController::class,'edit'])->name('shipping.edit');
        Route::put('/shipping/{id}',[ShippingController::class,'update'])->name('shipping.update');
        Route::delete('/shipping/{id}',[ShippingController::class,'destroy'])->name('shipping.delete');

        // Coupon Code Routes

        Route::get('/coupons',[DiscountCodeController::class,'index'])->name('coupons.index');
        Route::get('/coupons/create',[DiscountCodeController::class,'create'])->name('coupons.create');
        Route::post('/coupons',[DiscountCodeController::class,'store'])->name('coupons.store');
        Route::get('/coupons/{coupon}/edit',[DiscountCodeController::class,'edit'])->name('coupons.edit');
        Route::put('/coupons/{coupon}',[DiscountCodeController::class,'update'])->name('coupons.update');
        Route::delete('/coupons/{coupon}',[DiscountCodeController::class,'destroy'])->name('coupons.delete');

        // Order Routes
        Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
        Route::get('/orders/{id}',[OrderController::class,'detail'])->name('orders.detail');
        Route::post('/order/change-status/{id}',[OrderController::class,'changeOrderStatus'])->name('orders.changeOrderStatus');
      Route::post('/admin/orders/{order}/send-invoice-email', [App\Http\Controllers\admin\OrderController::class, 'sendInvoiceEmail'])->name('orders.sendInvoiceEmail');
        Route::get('/orders/{id}/print', [OrderController::class, 'print'])->name('orders.print');



        // User Routes
        Route::get('/users',[UserController::class,'index'])->name('users.index');
        Route::get('/users/create',[UserController::class,'create'])->name('users.create');
        Route::post('/users',[UserController::class,'store'])->name('users.store');
        Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
        Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
        Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.delete');

         // faqs Routes
         Route::get('/faqs',[FaqController::class,'index'])->name('faqs.index');
         Route::get('/faqs/create',[FaqController::class,'create'])->name('faqs.create');
         Route::post('/faqs',[FaqController::class,'store'])->name('faqs.store');
         Route::get('/faqs/{faq}/edit',[FaqController::class,'edit'])->name('faqs.edit');
         Route::put('/faqs/{faq}',[FaqController::class,'update'])->name('faqs.update');
         Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.delete');


          // Testimonials Routes
        Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.delete');

        // web.php
        Route::get('/social-links', [SocialLinksController::class, 'view'])->name('admin.social-links');
        Route::post('/social-links/update', [SocialLinksController::class, 'update'])->name('admin.social-links.update');



         // Blogs Routes
         Route::resource('blogs', BlogController::class);

        //Newsletter
            Route::get('/subscribers', [NewsletterController::class, 'list'])->name('newsletter.list');
            Route::get('/send-mail', [NewsletterController::class, 'bulkForm'])->name('newsletter.bulk');
            Route::post('/send-mail', [NewsletterController::class, 'sendBulkMail'])->name('newsletter.send');
            Route::delete('/subscriber/{id}', [NewsletterController::class, 'destroy'])->name('newsletter.delete');

            Route::get('/subscribers/export', [NewsletterController::class, 'exportCsv'])->name('subscribers.export');


            //Blog Categories
            Route::resource('blog-categories', BlogCategoryController::class);

      
       // Services Routes
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.delete');

        // Manage-Content Routes
        Route::get('/manage-content', [ManageContentController::class, 'index'])->name('manage_content.index');
        Route::get('/manage-content/create', [ManageContentController::class, 'create'])->name('manage_content.create');
        Route::post('/manage-content', [ManageContentController::class, 'store'])->name('manage_content.store');
        Route::get('/manage-content/{manageContent}/edit', [ManageContentController::class, 'edit'])->name('manage_content.edit');
        Route::put('/manage-content/{manageContent}', [ManageContentController::class, 'update'])->name('manage_content.update');
        Route::delete('/manage-content/{manageContent}', [ManageContentController::class, 'destroy'])->name('manage_content.delete');

        Route::get('/admin/appointments', [AppointmentController::class, 'index'])->name('admin.appointments');
         Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('admin.appointments.show');
        Route::delete('/admin/appointments/{id}', [AppointmentController::class, 'destroy'])->name('admin.appointments.delete');

            
        // Page Routes
        Route::get('/pages',[PageController::class,'index'])->name('pages.index');
        Route::get('/pages/create',[PageController::class,'create'])->name('pages.create');
        Route::post('/pages',[PageController::class,'store'])->name('pages.store');
        Route::get('/pages/{page}/edit',[PageController::class,'edit'])->name('pages.edit');
        Route::put('/pages/{page}',[PageController::class,'update'])->name('pages.update');
        Route::delete('/pages/{page}',[PageController::class,'destroy'])->name('pages.delete');

        //for Popups
         Route::get('admin/popup', [PopupController::class, 'edit'])->name('admin.popup.edit');
        Route::post('admin/popup', [PopupController::class, 'update'])->name('admin.popup.update');
       
        //Banner
         Route::get('banner/edit', [BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::post('banner/update', [BannerController::class, 'update'])->name('admin.banner.update');

     Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('/about/update', [AboutController::class, 'update'])->name('about.update');

        // =============================================
        // HMS - Hotel Management System Routes
        // =============================================

        // Room Types
        Route::get('/room-types', [RoomTypeController::class, 'index'])->name('room-types.index');
        Route::get('/room-types/create', [RoomTypeController::class, 'create'])->name('room-types.create');
        Route::post('/room-types', [RoomTypeController::class, 'store'])->name('room-types.store');
        Route::get('/room-types/{roomType}/edit', [RoomTypeController::class, 'edit'])->name('room-types.edit');
        Route::put('/room-types/{roomType}', [RoomTypeController::class, 'update'])->name('room-types.update');
        Route::delete('/room-types/{roomType}', [RoomTypeController::class, 'destroy'])->name('room-types.delete');

        // Rooms
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.delete');

        // Guests
        Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
        Route::get('/guests/create', [GuestController::class, 'create'])->name('guests.create');
        Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');
        Route::get('/guests/{guest}', [GuestController::class, 'show'])->name('guests.show');
        Route::get('/guests/{guest}/edit', [GuestController::class, 'edit'])->name('guests.edit');
        Route::put('/guests/{guest}', [GuestController::class, 'update'])->name('guests.update');
        Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.delete');
        Route::get('/guests-search', [GuestController::class, 'search'])->name('guests.search');

        // Bookings
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
        Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
        Route::get('/bookings/{booking}/invoice', [BookingController::class, 'invoice'])->name('bookings.invoice');
        Route::post('/bookings/{booking}/add-service', [BookingController::class, 'addService'])->name('bookings.addService');
        Route::delete('/booking-services/{bookingService}', [BookingController::class, 'removeService'])->name('bookings.removeService');
        Route::get('/check-availability', [BookingController::class, 'checkAvailability'])->name('bookings.checkAvailability');

        // Payments
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.delete');

        // Housekeeping
        Route::get('/housekeeping', [HousekeepingController::class, 'index'])->name('housekeeping.index');
        Route::get('/housekeeping/create', [HousekeepingController::class, 'create'])->name('housekeeping.create');
        Route::post('/housekeeping', [HousekeepingController::class, 'store'])->name('housekeeping.store');
        Route::post('/housekeeping/{task}/status', [HousekeepingController::class, 'updateStatus'])->name('housekeeping.updateStatus');
        Route::delete('/housekeeping/{task}', [HousekeepingController::class, 'destroy'])->name('housekeeping.delete');

        // Hotel Services
        Route::get('/hotel-services', [HotelServiceController::class, 'index'])->name('hotel-services.index');
        Route::get('/hotel-services/create', [HotelServiceController::class, 'create'])->name('hotel-services.create');
        Route::post('/hotel-services', [HotelServiceController::class, 'store'])->name('hotel-services.store');
        Route::get('/hotel-services/{hotelService}/edit', [HotelServiceController::class, 'edit'])->name('hotel-services.edit');
        Route::put('/hotel-services/{hotelService}', [HotelServiceController::class, 'update'])->name('hotel-services.update');
        Route::delete('/hotel-services/{hotelService}', [HotelServiceController::class, 'destroy'])->name('hotel-services.delete');

        //temp-images.create
        Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-images.create');

        // setting routes
        Route::get('/change-password',[SettingController::class,'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/process-change-password',[SettingController::class,'processChangePassword'])->name('admin.processChangePassword');


        Route::get('/getSlug',function(Request $request){
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');

    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() { 
        Route::group(['as' => 'faqs.'], function() {
            Route::resource('faqs', FaqController::class);
        });
    });




});

// ========================================================================

// Clear application cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

// Clear route cache
Route::get('/route-cache', function() {
    Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

// Clear config cache
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache has been cleared';
});

// Clear view cache
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});