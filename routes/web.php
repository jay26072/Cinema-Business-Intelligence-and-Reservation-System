<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\TheaterManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('userpanel.home');
// });

Route::get('/', [UserController::class, 'home']);

Route::get('/about', function () {
    return view('userpanel.about');
});
Route::get('/contact', function () {
    return view('userpanel.contact');
});

Route::get('/signup', function () {
    return view('userpanel.signup');
});
Route::get('/signin', function () {
    return view('userpanel.signin');
});

// Rest Password

Route::get('/forget-password', [UserController::class, 'forgetPassword']);
Route::post('/send-otp', [UserController::class, 'sendOtp']);

Route::get('/verify-otp', [UserController::class, 'verifyOtpPage']);
Route::post('/verify-otp', [UserController::class, 'verifyOtp']);

Route::get('/reset-password', [UserController::class, 'resetPasswordPage']);
Route::post('/reset-password', [UserController::class, 'resetPassword']);

// End



Route::post('/insertsignup', [UserController::class, 'Register']);

Route::get('/movies', [UserController::class, 'MovieGrid']);

Route::get('/movies/filter', [UserController::class, 'filter'])->name('movies.filter');

Route::get('/movie-details/{id}',[UserController::class,'MovieDetails']);

// Route::get('/showtime/{id}',[UserController::class,'ShowTime']);
Route::get('/showtime/{id}', [UserController::class, 'ShowTime'])->name('showtime');

// Route::get('/get-showtimes', [UserController::class, 'getShowtimes']);

Route::get('/seat-selection/{id}',[UserController::class,'SeatSelection']);

Route::get('/seat-plan/{show_id}', [UserController::class, 'seatPlan'])->name('seat.plan');

Route::get('/get-seats/{showId}', [UserController::class, 'getSeats']);

Route::post('/create-booking',
    [BookingController::class, 'createBooking'])
    ->name('create.booking');

Route::get('/payment/{booking}',[PaymentController::class, 'index'])
    ->name('payment.page');

Route::post('/apply-promo', [PaymentController::class, 'applyPromo'])
    ->name('apply.promo');

Route::get('/get-movies-live', [UserController::class, 'getMoviesLive']);





Route::get('login',[LoginController::class,'Login']);

Route::post('insertlogin',[LoginController::class,'check']);

// Route::middleware(['user_login'])->group(function () 
// {
// Route::get('userindex',[UserController::class,'userindex']);
// Route::post('update-profile',[UserController::class,'updateProfile']);
// Route::get('user_logout',[LoginController::class,'Userlogout']);

// Route::get('/movies', [UserController::class, 'MovieGrid']);

// Route::get('/movies/filter', [UserController::class, 'filter'])->name('movies.filter');

// Route::get('/movie-details/{id}',[UserController::class,'MovieDetails']);

// // Route::get('/showtime/{id}',[UserController::class,'ShowTime']);
// Route::get('/showtime/{id}', [UserController::class, 'ShowTime'])->name('showtime');

// // Route::get('/get-showtimes', [UserController::class, 'getShowtimes']);

// Route::get('/seat-selection/{id}',[UserController::class,'SeatSelection']);

// Route::get('/seat-plan/{show_id}', [UserController::class, 'seatPlan'])->name('seat.plan');

// Route::post('/create-booking',
//     [BookingController::class, 'createBooking'])
//     ->name('create.booking');

// Route::get('/payment/{booking}',[PaymentController::class, 'index'])
//     ->name('payment.page');

// Route::post('/apply-promo', [PaymentController::class, 'applyPromo'])
//     ->name('apply.promo');

// Route::post('/razorpay/order', [PaymentController::class, 'createRazorpayOrder']);

// Route::post('/razorpay/verify', [PaymentController::class, 'verifyRazorpayPayment']);

// Route::get('/cancel-booking/{id}', [PaymentController::class, 'cancelBooking']);

// Route::get('/thank-you/{id}', [PaymentController::class, 'thankYou'])->name('thank.you');

// Route::get('/ticket/download/{reference}', [PaymentController::class, 'downloadTicket'])
//     ->name('ticket.download');

// Route::get('/booking_history',[UserController::class,'bookingHistory']);
   
// });

Route::middleware(['user_login'])->group(function () 
{
    Route::get('userindex',[UserController::class,'userindex']);
    Route::post('update-profile',[UserController::class,'updateProfile']);
    Route::get('user_logout',[LoginController::class,'Userlogout']);

    Route::post('/razorpay/order', [PaymentController::class, 'createRazorpayOrder']);
    Route::post('/razorpay/verify', [PaymentController::class, 'verifyRazorpayPayment']);

    Route::get('/cancel-booking/{id}', [PaymentController::class, 'cancelBooking']);
    Route::get('/thank-you/{id}', [PaymentController::class, 'thankYou'])->name('thank.you');
    Route::get('/ticket/download/{reference}', [PaymentController::class, 'downloadTicket']);

    Route::get('/booking_history',[UserController::class,'bookingHistory']);
});

Route::middleware(['admin_login'])->group(function () 
{
    Route::get('adminindex',[AdminPanelController::class,'adminDashboard']);
    Route::get('admin_logout',[LoginController::class,'Adminlogout']);

    Route::get('chpass',[AdminPanelController::class,'changepassword']);
    Route::put('updatepass',[AdminPanelController::class,'updatePassword']);


// city

Route::get('city',[AdminPanelController::class,'city']);
Route::post('insertcity',[AdminPanelController::class,'Addcity']);
Route::get('editcity/{id}',[AdminPanelController::class,'editCity']);
Route::put('updatecity/{id}',[AdminPanelController::class,'updateCity']);
Route::get('deletecity/{id}',[AdminPanelController::class,'DeleteCity']);
Route::get('booking-list',[AdminPanelController::class,'bookingList']);
Route::get('/admin/bookings/pdf', [AdminPanelController::class, 'exportPdf'])
    ->name('admin.bookings.pdf');

//Movie Type

Route::get('movietype',[AdminPanelController::class,'movietype']);
Route::post('addmovietype',[AdminPanelController::class,'AddMovieType']);
Route::get('editmovietype/{id}',[AdminPanelController::class,'editMovieType']);
Route::put('updatetype/{id}',[AdminPanelController::class,'updateMovieType']);
Route::get('deletemovietype/{id}',[AdminPanelController::class,'DeleteMovieType']);

// Crew

Route::get('crew',[AdminPanelController::class,'Crew']);
Route::post('insertcrew',[AdminPanelController::class,'AddCrew']);
Route::get('editcrew/{id}',[AdminPanelController::class,'editCrew']);
Route::put('updatecrew/{id}',[AdminPanelController::class,'updateCrew']);
Route::get('deletecrew/{id}',[AdminPanelController::class,'DeleteCrew']);

// Cast

Route::get('cast',[AdminPanelController::class,'Cast']);
Route::post('insertcast',[AdminPanelController::class,'AddCast']);
Route::get('editcast/{id}',[AdminPanelController::class,'editCast']);
Route::put('updatecast/{id}',[AdminPanelController::class,'updateCast']);
Route::get('deletecast/{id}',[AdminPanelController::class,'DeleteCast']);

Route::get('screentype',[AdminPanelController::class,'ScreenExp']);
Route::post('addscreentype',[AdminPanelController::class,'AddScreenExp']);

Route::get('theater',[AdminPanelController::class,'Theater']);
Route::post('addtheater',[AdminPanelController::class,'AddTheater']);
Route::get('manage_theater',[AdminPanelController::class,'ManageTheater']);
Route::get('edittheater/{id}',[AdminPanelController::class,'editTheater']);
Route::put('updatetheater/{id}',[AdminPanelController::class,'updateTheater']);
Route::get('deletetheater/{id}',[AdminPanelController::class,'DeleteTheater']);

Route::get('/promo',[AdminPanelController::class,'promoPage']);
Route::post('/insertpromo',[AdminPanelController::class,'insertPromo']);
Route::get('/deletepromo/{id}',[AdminPanelController::class,'deletePromo']);

Route::get('/admin/dashboard-data', [AdminController::class, 'dashboardData']);
Route::get('/theater-list', [AdminPanelController::class, 'theaterList']);
Route::get('/reset-theater-password/{id}', [AdminPanelController::class, 'resetTheaterPassword']);
});

// Theater Manager
Route::middleware(['theater_manager_login'])->group(function () 
{
    Route::get('theaterindex',[TheaterManagerController::class,'theaterindex']);
    Route::get('theater_logout',[LoginController::class,'Theaterlogout']);

    Route::get('/dashboard/live-data', [TheaterManagerController::class, 'liveData']);

    Route::get('changepassword',[TheaterManagerController::class,'changepassword']);
    Route::post('updatepassword',[TheaterManagerController::class,'updatePassword']);

    Route::get('movie',[TheaterManagerController::class,'Movie']);
    Route::post('addmovie',[TheaterManagerController::class,'AddMovie']);
    Route::get('movie_list',[TheaterManagerController::class,'movie_list']);
    Route::get('editmovie/{id}',[TheaterManagerController::class,'editMovie']);
    Route::put('updatemovie/{id}',[TheaterManagerController::class,'updateMovie']);
    Route::get('deletemovie/{id}',[TheaterManagerController::class,'DeleteMovie']);

    Route::get('showtime',[TheaterManagerController::class,'ShowTime']);
    Route::post('addshowtime',[TheaterManagerController::class,'AddShowTime']);

    Route::get('/theater-bookings',[TheaterManagerController::class,'bookingList']);
    Route::get('/theater/scanner', [TheaterManagerController::class,'scannerPage']);
    Route::post('/verify-ticket', [TheaterManagerController::class,'verifyTicket']);
    Route::get('/entry-stats',[PaymentController::class,'entryStats']);

    
   
});





