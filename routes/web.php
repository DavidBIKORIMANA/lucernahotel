<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Frontend\FrontendRoomController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Backend\RateSeasonController;
use App\Http\Controllers\Backend\ReviewController as BackendReviewController;
use App\Http\Controllers\Backend\HomepageController;
use App\Http\Controllers\Backend\FacilityOptionController;
use App\Models\Booking;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'Index'])->name('home');


Route::get('/dashboard', function () {
   $id = Auth::user()->id;
   $BookingA = Booking::where('user_id', $id)->where('payment_status', 1)->get();
   $BookingP = Booking::where('user_id', $id)->where('payment_status', 0)->get();
   $BookingT = Booking::where('user_id', $id)->get();
   $recentBookings = Booking::with('room.type')->where('user_id', $id)->orderBy('id','desc')->take(5)->get();

   return view('frontend.dashboard.user_dashboard',compact('BookingA','BookingP','BookingT','recentBookings'));
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/password/change/password', [UserController::class, 'ChangePasswordStore'])->name('password.change.store');
   
   
});

require __DIR__.'/auth.php';

// Admin Group Middleware 
Route::middleware(['auth','roles:admin'])->group(function(){
   Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
   Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
   Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
   Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
   Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
   Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
}); // End Admin Group Middleware 
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
// Admin Group Middleware 
Route::middleware(['auth','roles:admin'])->group(function(){
   /// Team All Route 
   Route::controller(TeamController::class)->group(function(){
         Route::get('/all/team', 'AllTeam')->name('all.team')->middleware('permission:team.all');
         Route::get('/add/team', 'AddTeam')->name('add.team')->middleware('permission:team.add');
         Route::post('/team/store', 'StoreTeam')->name('team.store');
         Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
         Route::post('/team/update', 'UpdateTeam')->name('team.update');
         Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
   });
   /// Book Area All Route 
   Route::controller(TeamController::class)->group(function(){
      Route::get('/book/area', 'BookArea')->name('book.area');
      Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update');
   });
   /// RoomType All Route 
   Route::controller(RoomTypeController::class)->group(function(){
      Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list');
      Route::get('/add/room/type', 'AddRoomType')->name('add.room.type');
      Route::post('/room/type/store', 'RoomTypeStore')->name('room.type.store'); 
   });
   /// Room All Route 
   Route::controller(RoomController::class)->group(function(){
      Route::get('/edit/room/{id}/{type}', 'EditRoom')->name('edit.room');
      Route::post('/update/room/{id}', 'UpdateRoom')->name('update.room');
      Route::get('/multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');
      Route::post('/store/room/no/{id}', 'StoreRoomNumber')->name('store.room.no');
      Route::get('/edit/roomno/{id}', 'EditRoomNumber')->name('edit.roomno');
      Route::post('/update/roomno/{id}', 'UpdateRoomNumber')->name('update.roomno');
      Route::get('/delete/roomno/{id}', 'DeleteRoomNumber')->name('delete.roomno');
      Route::get('/delete/room/{id}', 'DeleteRoom')->name('delete.room');
   });
   // Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
   /// Admin Booking All Route 
   Route::controller(BookingController::class)->group(function(){
      Route::get('/booking/list', 'BookingList')->name('booking.list');
      Route::get('/edit_booking/{id}', 'EditBooking')->name('edit_booking');
      Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');
      Route::get('/booking/confirm/{id}', 'ConfirmBooking')->name('booking.confirm');
      Route::post('/booking/deny/{id}', 'DenyBooking')->name('booking.deny');
      Route::post('/booking/verify-payment/{id}', 'VerifyPayment')->name('booking.verify.payment');
      Route::get('/booking/payment-proof/{id}', 'ViewPaymentProof')->name('booking.payment.proof');
      Route::get('/booking/checkin/{id}', 'CheckInBooking')->name('booking.checkin');
      Route::get('/booking/checkout/{id}', 'CheckOutBooking')->name('booking.checkout');
      Route::post('/booking/cancel/{id}', 'CancelBooking')->name('booking.cancel');
      Route::post('/booking/mark-payment/{id}', 'MarkPayment')->name('booking.mark.payment');
   });
   /// Admin Room List All Route 
   Route::controller(RoomListController::class)->group(function(){
      Route::get('/view/room/list', 'ViewRoomList')->name('view.room.list');
      Route::get('/add/room/list', 'AddRoomList')->name('add.room.list'); 
      Route::post('/store/roomlist', 'StoreRoomList')->name('store.roomlist'); 
   });
   /// Rate Season All Route
   Route::controller(RateSeasonController::class)->group(function(){
      Route::get('/rate/seasons', 'AllSeasons')->name('all.seasons');
      Route::get('/add/season', 'AddSeason')->name('add.season');
      Route::post('/store/season', 'StoreSeason')->name('store.season');
      Route::get('/edit/season/{id}', 'EditSeason')->name('edit.season');
      Route::post('/update/season/{id}', 'UpdateSeason')->name('update.season');
      Route::get('/delete/season/{id}', 'DeleteSeason')->name('delete.season');
   });
   /// Admin Room List All Route 
   Route::controller(SettingController::class)->group(function(){
      Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting');
      Route::post('/smtp/update', 'SmtpUpdate')->name('smtp.update');
   });
   /// Tesimonial All Route 
   Route::controller(TestimonialController::class)->group(function(){
      Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial');
      Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial'); 
      Route::post('/store/testimonial', 'StoreTestimonial')->name('testimonial.store'); 
      Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
      Route::post('/update/testimonial', 'UpdateTestimonial')->name('testimonial.update'); 
      Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
   });
   /// Blog Category All Route 
   Route::controller(BlogController::class)->group(function(){
      Route::get('/blog/category', 'BlogCategory')->name('blog.category');
      Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
      Route::get('/edit/blog/category/{id}', 'EditBlogCategory');
      Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
      Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
   });
   /// Blog Post All Route 
   Route::controller(BlogController::class)->group(function(){
      Route::get('/all/blog/post', 'AllBlogPost')->name('all.blog.post');
      Route::get('/add/blog/post', 'AddBlogPost')->name('add.blog.post');
      Route::post('/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
      Route::get('/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
      Route::post('/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
      Route::get('/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');
   });
   /// Frontend Comment All Route 
   Route::controller(CommentController::class)->group(function(){ 
      Route::get('/all/comment/', 'AllComment')->name('all.comment');
      Route::post('/update/comment/status', 'UpdateCommentStatus')->name('update.comment.status');  
   });
   /// Booking Report All Route 
   Route::controller(ReportController::class)->group(function(){ 
      Route::get('/booking/report/', 'BookingReport')->name('booking.report');
      Route::post('/search-by-date', 'SearchByDate')->name('search-by-date');
   });
   /// Site Setting All Route 
   Route::controller(SettingController::class)->group(function(){
      Route::get('/site/setting', 'SiteSetting')->name('site.setting');
      Route::post('/site/update', 'SiteUpdate')->name('site.update');
   });
   /// Review Management Route 
   Route::controller(BackendReviewController::class)->group(function(){
      Route::get('/all/review', 'AllReview')->name('all.review');
      Route::get('/approve/review/{id}', 'ApproveReview')->name('approve.review');
      Route::get('/delete/review/{id}', 'DeleteReview')->name('delete.review');
   });
   /// Gallery All Route
   Route::controller(GalleryController::class)->group(function(){
      Route::get('/all/gallery', 'AllGallery')->name('all.gallery');
      Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
      Route::post('/store/gallery', 'StoreGallery')->name('store.gallery'); 
      Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
      Route::post('/update/gallery', 'UpdateGallery')->name('update.gallery');
      Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');
      Route::post('/delete/gallery/multiple', 'DeleteGalleryMultiple')->name('delete.gallery.multiple');
      // contact message admin view
      Route::get('/contact/message', 'AdminContactMessage')->name('contact.message');
   });
   /// Permission All Route 
   Route::controller(RoleController::class)->group(function(){
      Route::get('/all/permission', 'AllPermission')->name('all.permission');
      Route::get('/add/permission', 'AddPermission')->name('add.permission');
      Route::post('/store/permission', 'StorePermission')->name('store.permission');
      Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
      Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
      Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
      Route::get('/import/permission', 'ImportPermission')->name('import.permission');
      Route::get('/export', 'Export')->name('export');
      Route::post('/import', 'Import')->name('import');
   });
   /// Role All Route 
   Route::controller(RoleController::class)->group(function(){
      Route::get('/all/roles', 'AllRoles')->name('all.roles');
      Route::get('/add/roles', 'AddRoles')->name('add.roles');
      Route::post('/store/roles', 'StoreRoles')->name('store.roles');
      Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
      Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
      Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
      Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
      Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
      Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
      Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
      Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
      Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
   });
   /// Admin User All Route 
   Route::controller(AdminController::class)->group(function(){
      Route::get('/all/admin', 'AllAdmin')->name('all.admin'); 
      Route::get('/add/admin', 'AddAdmin')->name('add.admin');
      Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
      Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
      Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
      Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
      Route::get('/toggle/admin/status/{id}', 'ToggleAdminStatus')->name('toggle.admin.status');
   });
   /// Homepage Content All Route
   Route::controller(HomepageController::class)->group(function(){
      Route::get('/homepage/manage', 'Index')->name('homepage.manage');
      // Sections
      Route::get('/homepage/sections', 'EditSections')->name('homepage.sections');
      Route::post('/homepage/sections/update', 'UpdateSections')->name('homepage.sections.update');
      // Hero Slides
      Route::get('/all/hero/slides', 'AllHeroSlides')->name('all.hero.slides');
      Route::get('/add/hero/slide', 'AddHeroSlide')->name('add.hero.slide');
      Route::post('/hero/slide/store', 'StoreHeroSlide')->name('hero.slide.store');
      Route::get('/edit/hero/slide/{id}', 'EditHeroSlide')->name('edit.hero.slide');
      Route::post('/hero/slide/update', 'UpdateHeroSlide')->name('hero.slide.update');
      Route::get('/delete/hero/slide/{id}', 'DeleteHeroSlide')->name('delete.hero.slide');
      // Hero Stats
      Route::get('/all/hero/stats', 'AllHeroStats')->name('all.hero.stats');
      Route::get('/add/hero/stat', 'AddHeroStat')->name('add.hero.stat');
      Route::post('/hero/stat/store', 'StoreHeroStat')->name('hero.stat.store');
      Route::get('/edit/hero/stat/{id}', 'EditHeroStat')->name('edit.hero.stat');
      Route::post('/hero/stat/update', 'UpdateHeroStat')->name('hero.stat.update');
      Route::get('/delete/hero/stat/{id}', 'DeleteHeroStat')->name('delete.hero.stat');
      // About Pillars
      Route::get('/all/about/pillars', 'AllAboutPillars')->name('all.about.pillars');
      Route::get('/add/about/pillar', 'AddAboutPillar')->name('add.about.pillar');
      Route::post('/about/pillar/store', 'StoreAboutPillar')->name('about.pillar.store');
      Route::get('/edit/about/pillar/{id}', 'EditAboutPillar')->name('edit.about.pillar');
      Route::post('/about/pillar/update', 'UpdateAboutPillar')->name('about.pillar.update');
      Route::get('/delete/about/pillar/{id}', 'DeleteAboutPillar')->name('delete.about.pillar');
      // Amenities (Our Offerings)
      Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
      Route::get('/add/amenity', 'AddAmenity')->name('add.amenity');
      Route::post('/amenity/store', 'StoreAmenity')->name('amenity.store');
      Route::get('/edit/amenity/{id}', 'EditAmenity')->name('edit.amenity');
      Route::post('/amenity/update', 'UpdateAmenity')->name('amenity.update');
      Route::get('/delete/amenity/{id}', 'DeleteAmenity')->name('delete.amenity');
      // Featured Amenities
      Route::get('/all/featured/amenities', 'AllFeaturedAmenities')->name('all.featured.amenities');
      Route::get('/add/featured/amenity', 'AddFeaturedAmenity')->name('add.featured.amenity');
      Route::post('/featured/amenity/store', 'StoreFeaturedAmenity')->name('featured.amenity.store');
      Route::get('/edit/featured/amenity/{id}', 'EditFeaturedAmenity')->name('edit.featured.amenity');
      Route::post('/featured/amenity/update', 'UpdateFeaturedAmenity')->name('featured.amenity.update');
      Route::get('/delete/featured/amenity/{id}', 'DeleteFeaturedAmenity')->name('delete.featured.amenity');
      // Dining Items
      Route::get('/all/dining/items', 'AllDiningItems')->name('all.dining.items');
      Route::get('/add/dining/item', 'AddDiningItem')->name('add.dining.item');
      Route::post('/dining/item/store', 'StoreDiningItem')->name('dining.item.store');
      Route::get('/edit/dining/item/{id}', 'EditDiningItem')->name('edit.dining.item');
      Route::post('/dining/item/update', 'UpdateDiningItem')->name('dining.item.update');
      Route::get('/delete/dining/item/{id}', 'DeleteDiningItem')->name('delete.dining.item');
      // Event Features
      Route::get('/all/event/features', 'AllEventFeatures')->name('all.event.features');
      Route::get('/add/event/feature', 'AddEventFeature')->name('add.event.feature');
      Route::post('/event/feature/store', 'StoreEventFeature')->name('event.feature.store');
      Route::get('/edit/event/feature/{id}', 'EditEventFeature')->name('edit.event.feature');
      Route::post('/event/feature/update', 'UpdateEventFeature')->name('event.feature.update');
      Route::get('/delete/event/feature/{id}', 'DeleteEventFeature')->name('delete.event.feature');
      // Hotel Info
      Route::get('/all/hotel/info', 'AllHotelInfo')->name('all.hotel.info');
      Route::get('/add/hotel/info', 'AddHotelInfo')->name('add.hotel.info');
      Route::post('/hotel/info/store', 'StoreHotelInfo')->name('hotel.info.store');
      Route::get('/edit/hotel/info/{id}', 'EditHotelInfo')->name('edit.hotel.info');
      Route::post('/hotel/info/update', 'UpdateHotelInfo')->name('hotel.info.update');
      Route::get('/delete/hotel/info/{id}', 'DeleteHotelInfo')->name('delete.hotel.info');
      // Site Settings
      Route::get('/homepage/site-settings', 'EditSiteSettings')->name('homepage.site.settings');
      Route::post('/homepage/site-settings/update', 'UpdateSiteSettings')->name('homepage.site.settings.update');
   });
   /// Facility Options All Route
   Route::controller(FacilityOptionController::class)->group(function(){
      Route::get('/all/facility/options', 'AllFacilityOptions')->name('all.facility.options');
      Route::get('/add/facility/option', 'AddFacilityOption')->name('add.facility.option');
      Route::post('/facility/option/store', 'StoreFacilityOption')->name('facility.option.store');
      Route::get('/edit/facility/option/{id}', 'EditFacilityOption')->name('edit.facility.option');
      Route::post('/facility/option/update', 'UpdateFacilityOption')->name('facility.option.update');
      Route::get('/delete/facility/option/{id}', 'DeleteFacilityOption')->name('delete.facility.option');
   });
}); // End Admin Group Middleware 
/// Room All Route 
Route::controller(FrontendRoomController::class)->group(function(){
   Route::get('/rooms/', 'AllFrontendRoomList')->name('froom.all');
   Route::get('/room/details/{id}', 'RoomDetailsPage');
   Route::get('/bookings/', 'BookingSeach')->name('booking.search');
   Route::get('/search/room/details/{id}', 'SearchRoomDetails')->name('search_room_details');
   Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');
   Route::get('/bookings-all/{id}', 'BookingSeachAll')->name('booking.search.all');
});
// Auth Middleware - Admin only booking management routes
Route::middleware(['auth', 'roles:admin'])->group(function(){
   Route::controller(BookingController::class)->group(function(){
      // booking Update 
      Route::post('/update/booking/status/{id}', 'UpdateBookingStatus')->name('update.booking.status');
      Route::post('/update/booking/{id}', 'UpdateBooking')->name('update.booking');
      // Assign Room Route 
      Route::get('/assign_room/{id}', 'AssignRoom')->name('assign_room');
      Route::get('/assign_room/store/{booking_id}/{room_number_id}', 'AssignRoomStore')->name('assign_room_store');
      Route::get('/assign_room_delete/{id}', 'AssignRoomDelete')->name('assign_room_delete');
   });
});

// Auth Middleware - User only routes
Route::middleware(['auth', 'user'])->group(function(){
   /// CHECKOUT ALL Route 
   Route::controller(BookingController::class)->group(function(){
      Route::get('/checkout/', 'Checkout')->name('checkout');
      Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');
      Route::post('/checkout/store/', 'CheckoutStore')->name('checkout.store');
      Route::get('/booking/confirmation/{id}', 'BookingConfirmation')->name('booking.confirmation');
      Route::match(['get', 'post'],'/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');
      ////////// User Booking Route
      Route::get('/user/booking', 'UserBooking')->name('user.booking');
      Route::get('/user/invoice/{id}', 'UserInvoice')->name('user.invoice');
      Route::post('/user/booking/cancel/{id}', 'UserCancelBooking')->name('user.cancel.booking');
   });
   /// User Review Route
   Route::controller(ReviewController::class)->group(function(){
      Route::post('/store/review', 'StoreReview')->name('store.review');
   });
}); // End Group Auth Middleware
/// Frontend Blog  All Route 
Route::controller(BlogController::class)->group(function(){
   Route::get('/blog/details/{slug}', 'BlogDetails');
   Route::get('/blog/cat/list/{id}', 'BlogCatList');
   Route::get('/blog', 'BlogList')->name('blog.list');
});
/// Frontend Comment All Route 
Route::controller(CommentController::class)->group(function(){
   Route::post('/store/comment/', 'StoreComment')->name('store.comment');
});
/// Frontend Gallery All Route 
Route::controller(GalleryController::class)->group(function(){
   Route::get('/gallery', 'ShowGallery')->name('show.gallery');
   // Contact All Route 
   Route::get('/contact', 'ContactUs')->name('contact.us');
   Route::post('/store/contact', 'StoreContactUs')->name('store.contact');
});
/// Notification All Route 
Route::controller(BookingController::class)->group(function(){
   Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');
});




   

