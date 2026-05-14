<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieModel;
use App\Models\TypesOfMovieModel;
use App\Models\ScreenExpModel;
use App\Models\CastModel;
use App\Models\CrewModel;
use App\Models\TheaterModel;
use App\Models\ShowModel;
use App\Models\CityModel;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;



class UserController extends Controller
{

    public function Register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile_no' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:8',
        ]);
       
        $user = new UserModel();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->password = $request->password;
        $user->save();
        return redirect('/signin')->with('success', 'Registration successful. Please login.');
    }

    public function updateProfile(Request $request)
    {
        $userId = session('UserLogginId');

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:user_models,email,' . $userId,
            'mobile_no' => 'nullable|string|max:15',
        ]);

        $user = UserModel::find($userId);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no ?? '';

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully ✅');
    }

    public function home()
{
    $movies = MovieModel::latest()->get();
    $cities = CityModel::all();
    $cinemas = TheaterModel::all();
    $user = null;

    if(session()->has('UserLogginId')){
        $user = UserModel::find(session('UserLogginId'));
    }

    return view('userpanel.home', compact('cities','user','movies','cinemas'));
}
    public function MovieGrid()
    {
        $movies=MovieModel::latest()->paginate(6);
        $movietypes=TypesOfMovieModel::all();
        $screenexp=ScreenExpModel::all();
        return view('userpanel.movie-grid', compact('movies','movietypes','screenexp'));
    }

// public function filter(Request $request)
// {
//     $query = MovieModel::query();

//     if (!empty($request->language)) {
//         $query->where(function ($q) use ($request) {
//             foreach ($request->language as $lang) {
//                 $q->orWhereJsonContains('language', $lang);
//             }
//         });
//     }

//     if (!empty($request->experience)) {
//         $query->whereIn('screen_type', $request->experience);
//     }

//     if (!empty($request->genre)) {
//         $query->whereIn('movie_type', $request->genre);
//     }

//     $movies = $query->latest()->paginate(6); // ✅ IMPORTANT

//     return view('userpanel.partials.movie-list', compact('movies'))->render();
// }

public function filter(Request $request)
{
    $query = MovieModel::query();

    // Language
    if (!empty($request->language)) {
        $query->where(function ($q) use ($request) {
            foreach ($request->language as $lang) {
                $q->orWhere('language', 'LIKE', "%$lang%");
            }
        });
    }

    // Screen Type
    if (!empty($request->experience)) {
        $query->where(function ($q) use ($request) {
            foreach ($request->experience as $exp) {
                $q->orWhere('screen_type', 'LIKE', "%$exp%");
            }
        });
    }

    // Genre
    if (!empty($request->genre)) {
        $query->where(function ($q) use ($request) {
            foreach ($request->genre as $genre) {
                $q->orWhere('movie_type', 'LIKE', "%$genre%");
            }
        });
    }

    $movies = $query->latest()->paginate(6);

    return view('userpanel.partials.movie-list', compact('movies'))->render();
}



    public function MovieDetails($id)
    {
        $movie = MovieModel::find($id);
        $movie->movie_type=explode(',', $movie->movie_type);
        $movie->language=explode(',', $movie->language);
        $movie->screen_type=explode(',', $movie->screen_type);
        $movie->movie_cast=explode(',', $movie->movie_cast);
        $movie->movie_crew= explode(',', $movie->movie_crew);
        $matchedTypes = TypesOfMovieModel::whereIn('id', $movie->movie_type)->get();
        $matcheScreenExp = ScreenExpModel::whereIn('id', $movie->screen_type)->get();
        $matchedActors = CastModel::whereIn('id', $movie->movie_cast)->get();
        $matchedCrew = CrewModel::whereIn('id', $movie->movie_crew)->get();
        $screenexp=ScreenExpModel::all();
        $actors=CastModel::all();
        $crew=CrewModel::all();
        return view('userpanel.movie-details', compact('movie','matcheScreenExp','actors','crew','matchedTypes','matchedActors','matchedCrew','screenexp'));
    }


// public function ShowTime($id)
// {
//     $movie = MovieModel::findOrFail($id);

//     $screxps = ScreenExpModel::all();

//     $nowTime = Carbon::now()->format('H:i:s');

//     $showtime = ShowModel::where('movie_id', $id)
//                 ->where('show_time', '>', $nowTime)
//                 ->orderBy('show_time')
//                 ->get()
//                 ->groupBy('theater_id');

//     $theaters = TheaterModel::all();
//     $movie->language = $movie->language 
//         ? explode(',', $movie->language) 
//         : [];

//     return view('userpanel.showtime', compact('movie','theaters','showtime','screxps'));
// }

public function ShowTime(Request $request, $id)
{
    $movie = MovieModel::findOrFail($id);
    $screxps = ScreenExpModel::all();
    $theaters = TheaterModel::all();

    $selectedDate = $request->date ?? Carbon::today()->format('Y-m-d');
    $selectedExp  = $request->experience ?? null;

    $query = ShowModel::where('movie_id', $id)
        ->whereDate('show_date', $selectedDate);

    if ($selectedExp) {
        $query->where('screen_type', $selectedExp);
    }

    // 🔥 Only filter past time IF selected date is today
    if ($selectedDate == Carbon::today()->format('Y-m-d')) {
        $query->where('show_time', '>=', Carbon::now()->format('H:i:s'));
    }

    $showtime = $query->orderBy('show_time')
        ->get()
        ->groupBy('theater_id');

    if ($request->ajax()) {
        return view('userpanel.partials.showtime', compact('showtime','theaters'))->render();
    }

    $movie->language = $movie->language 
        ? explode(',', $movie->language) 
        : [];

    return view('userpanel.showtime', compact(
        'movie','theaters','showtime','screxps'
    ));
}

// public function SeatSelection($id)
// {
//     $show = ShowModel::find($id);
//     $theater = TheaterModel::find($show->theater_id);
//     $movie = MovieModel::find($show->movie_id);
//     $screxps = ScreenExpModel::all();


//     // 🔓 Auto release expired locked seats
//     BookingModel::where('show_id', $show->id)
//         ->where('booking_status','locked')
//         ->where('expires_at','<', now())
//         ->update([
//             'booking_status'=>'cancelled'
//         ]);

//     // 🎟 Get confirmed + active locked seats
//     $bookedSeats = BookingModel::where('show_id', $show->id)
//         ->where(function($q){
//             $q->where('booking_status','confirmed')
//               ->orWhere(function($q2){
//                   $q2->where('booking_status','locked')
//                      ->where('expires_at','>', now());
//               });
//         })
//         ->pluck('seat_number')
//         ->toArray();

//     // Decode JSON seat array
//     $bookedSeats = collect($bookedSeats)
//         ->flatMap(function($seat){
//             return json_decode($seat, true);
//         })
//         ->toArray();

//     return view('userpanel.seat-selection', compact(
//         'show',
//         'theater',
//         'movie',
//         'bookedSeats',
//         'screxps'
//     ));
// }


// public function SeatSelection($id)
// {
//     $show = ShowModel::findOrFail($id);
//     $theater = TheaterModel::find($show->theater_id);
//     $movie = MovieModel::find($show->movie_id);
//     $screxps = ScreenExpModel::all();

//     /* -------------------------------------------------
//        🔓 AUTO RELEASE EXPIRED LOCKED SEATS
//     -------------------------------------------------*/
//     BookingModel::where('show_id', $show->id)
//         ->where('booking_status','locked')
//         ->where('expires_at','<', now())
//         ->update([
//             'booking_status'=>'cancelled'
//         ]);

//     /* -------------------------------------------------
//        🎟 GET CONFIRMED + ACTIVE LOCKED SEATS
//     -------------------------------------------------*/
//     $bookedSeatsRaw = BookingModel::where('show_id', $show->id)
//         ->where(function($q){
//             $q->where('booking_status','confirmed')
//               ->orWhere(function($q2){
//                   $q2->where('booking_status','locked')
//                      ->where('expires_at','>', now());
//               });
//         })
//         ->pluck('seat_number')
//         ->toArray();

//     $bookedSeats = collect($bookedSeatsRaw)
//         ->flatMap(fn($seat) => json_decode($seat, true))
//         ->toArray();


//     /* =================================================
//         🚀 SURGE PRICING LOGIC STARTS HERE
//     ================================================= */

//     // 🎬 Base prices
//     $basePrices = [
//         'Premium' => 300,
//         'Gold'    => 200,
//         'Silver'  => 150,
//     ];

//     $showDate = Carbon::parse($show->show_date);
//     $showTime = Carbon::parse($show->show_time);
//     $now = Carbon::now();

//     $isWeekend = $showDate->isWeekend();
//     $isPrimeTime = $showTime->hour >= 18; // After 6PM

//     // 🪑 Total seats (based on your layout)
//     $totalSeats = 100; // Adjust if dynamic

//     $confirmedCount = BookingModel::where('show_id', $show->id)
//         ->where('booking_status','confirmed')
//         ->count();

//     $occupancyPercent = ($confirmedCount / $totalSeats) * 100;

//     $surgeMultiplier = 1;

//     // Weekend
//     if($isWeekend){
//         $surgeMultiplier += 0.10;
//     }

//     // Prime time
//     if($isPrimeTime){
//         $surgeMultiplier += 0.10;
//     }

//     // Occupancy-based surge
//     if($occupancyPercent >= 70){
//         $surgeMultiplier += 0.20;
//     }
//     elseif($occupancyPercent >= 50){
//         $surgeMultiplier += 0.10;
//     }

//     // 🎯 Final dynamic prices
//     $sections = [
//         'Premium' => [
//             'rows' => ['A','B','C'],
//             'seats' => 10,
//             'price' => round($basePrices['Premium'] * $surgeMultiplier)
//         ],
//         'Gold' => [
//             'rows' => ['D','E','F'],
//             'seats' => 10,
//             'price' => round($basePrices['Gold'] * $surgeMultiplier)
//         ],
//         'Silver' => [
//             'rows' => ['G','H','I','J'],
//             'seats' => 10,
//             'price' => round($basePrices['Silver'] * $surgeMultiplier)
//         ],
//     ];

//     /* ================================================= */

//     return view('userpanel.seat-selection', compact(
//         'show',
//         'theater',
//         'movie',
//         'bookedSeats',
//         'screxps',
//         'sections',
//         'surgeMultiplier',
//         'occupancyPercent'
//     ));
// }

public function SeatSelection($id)
{
    $show = ShowModel::findOrFail($id);
    $theater = TheaterModel::findOrFail($show->theater_id);
    $movie = MovieModel::findOrFail($show->movie_id);

    /* -------------------------------------------------
   🔓 AUTO RELEASE EXPIRED LOCKED SEATS
-------------------------------------------------*/
BookingModel::where('show_id', $show->id)
    ->where('booking_status', 'locked')
    ->where('expires_at', '<', now())
    ->update([
        'booking_status' => 'cancelled'
    ]);

/* -------------------------------------------------
   🎟 GET CONFIRMED SEATS
-------------------------------------------------*/
$confirmedSeatsRaw = BookingModel::where('show_id', $show->id)
    ->where('booking_status', 'confirmed')
    ->pluck('seat_number')
    ->toArray();

$confirmedSeats = collect($confirmedSeatsRaw)
    ->flatMap(fn($seat) => json_decode($seat, true))
    ->toArray();

/* -------------------------------------------------
   🔒 GET ACTIVE LOCKED SEATS
-------------------------------------------------*/
$lockedSeatsRaw = BookingModel::where('show_id', $show->id)
    ->where('booking_status', 'locked')
    ->where('expires_at', '>', now())
    ->pluck('seat_number')
    ->toArray();

$lockedSeats = collect($lockedSeatsRaw)
    ->flatMap(fn($seat) => json_decode($seat, true))
    ->toArray();
    /* -----------------------------
       1️⃣ Base Prices
    ------------------------------*/

    $sections = [
        'Premium' => [
            'rows' => ['A','B','C'],
            'seats' => 10,
            'original_price' => 300
        ],
        'Gold' => [
            'rows' => ['D','E','F'],
            'seats' => 10,
            'original_price' => 200
        ],
        'Silver' => [
            'rows' => ['G','H','I','J'],
            'seats' => 10,
            'original_price' => 150
        ],
    ];

/* -----------------------------
   2️⃣ Auto Flash Sale Logic
------------------------------*/

$nowIST = Carbon::now('Asia/Kolkata');
$todayIST = $nowIST->format('Y-m-d');

$flashSale = false;
$flashDiscountPercent = 20;
$flashEndsAt = null;

if ($show->show_date == $todayIST) {

    $flashStart = Carbon::now('Asia/Kolkata')->setTime(10,0,0);
    $flashEnd   = Carbon::now('Asia/Kolkata')->setTime(11,15,0);

    if ($nowIST->between($flashStart, $flashEnd)) {
        $flashSale = true;

        // Convert IST to UTC for JS timestamp
        $flashEndsAt = $flashEnd->copy()->timezone('UTC');
    }
}

    /* -----------------------------
       3️⃣ Surge Pricing Logic
    ------------------------------*/

    $surge = 1;

    $totalSeats = 100; // your layout total
    $bookedCount = BookingModel::where('show_id', $show->id)
        ->where('booking_status','confirmed')
        ->count();

    $occupancy = ($bookedCount / $totalSeats) * 100;

    if ($occupancy > 70) {
        $surge = 1.20; // 20% surge
    }

    /* -----------------------------
       4️⃣ Final Price Calculation
    ------------------------------*/

    foreach ($sections as $key => $section) {

    $original = $section['original_price'];

    // Apply surge
    $price = $original * $surge;

    // Apply flash discount
    if ($flashSale) {
        $price -= ($price * $flashDiscountPercent / 100);
    }

    $sections[$key]['original_price'] = round($original * $surge);
    $sections[$key]['price'] = round($price);
}

    /* -----------------------------
       5️⃣ Get Booked Seats
    ------------------------------*/

    $bookedSeats = BookingModel::where('show_id', $show->id)
        ->where('booking_status','confirmed')
        ->pluck('seat_number')
        ->flatMap(fn($s) => json_decode($s, true))
        ->toArray();

    /* -----------------------------
     👤 CONFIRMED SEAT USERS ONLY
    ------------------------------*/

$confirmedBookings = BookingModel::with('userData')
    ->where('show_id', $show->id)
    ->where('booking_status', 'confirmed')
    ->get();

$seatUserMap = [];

foreach ($confirmedBookings as $booking) {

    $seats = json_decode($booking->seat_number, true);

    foreach ($seats as $seat) {
        $seatUserMap[$seat] = $booking->userData->name ?? 'User';
    }
}

    return view('userpanel.seat-selection', compact(
        'show',
        'theater',
        'movie',
        'sections',
        'bookedSeats',
        'flashSale',
        'flashDiscountPercent',
        'surge',
        'flashEndsAt',
        'confirmedSeats',
        'lockedSeats',
        'seatUserMap'
    ));
}


public function bookingHistory()
{
    $userId = session('UserLogginId'); // your login session

    $bookings = BookingModel::with(['movieData','theaterData','showData'])
        ->where('user_id', $userId)
        ->wherehas('showData')
        ->orderBy('id','desc')
        ->get();

    return view('userpanel.booking_history', compact('bookings'));
}


public function userindex()
{
    if(!session()->has('UserLogginId')){
        return redirect('/signin');
    }

    $user = UserModel::find(session('UserLogginId'));
    $cities = CityModel::all();

    return view('userpanel.profile', compact('cities','user'));
}

// Forget Password

public function forgetPassword()
{
    return view('userpanel.forget-password');
}

public function sendOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:user_models,email'
    ]);

    $otp = rand(100000, 999999);

    $user = UserModel::where('email', $request->email)->first();
    $user->otp = $otp;
    $user->otp_expires_at = Carbon::now()->addMinutes(5);
    $user->save();

    // Send Email
   Mail::to($request->email)->send(new OtpMail($otp));

    session(['email' => $request->email]);

    return redirect('/verify-otp')->with('success', 'OTP sent successfully');
}

public function verifyOtpPage()
{
    return view('userpanel.verify-otp');
}

public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required'
    ]);

    $user = UserModel::where('email', session('email'))->first();

    if (!$user || $user->otp != $request->otp) {
        return back()->with('fail', 'Invalid OTP');
    }

    if (Carbon::now()->gt($user->otp_expire_at)) {
        return back()->with('fail', 'OTP expired');
    }

    return redirect('/reset-password');
}

public function resetPasswordPage()
{
    return view('userpanel.reset-password');
}


public function resetPassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed'
    ]);

    $user = UserModel::where('email', session('email'))->first();

    $user->password = $request->password;
    $user->otp = null;
    $user->otp_expires_at = null;
    $user->save();

    return redirect('/signin')->with('success', 'Password reset successful');
}
public function getSeats($showId)
{
    $confirmed = BookingModel::where('show_id', $showId)
        ->where('booking_status', 'confirmed')
        ->pluck('seat_number')
        ->flatMap(fn($s) => json_decode($s, true))
        ->toArray();

    $locked = BookingModel::where('show_id', $showId)
        ->where('booking_status', 'locked')
        ->where('expires_at', '>', now())
        ->pluck('seat_number')
        ->flatMap(fn($s) => json_decode($s, true))
        ->toArray();

    return response()->json([
        'status' => 'success',
        'confirmed' => $confirmed,
        'locked' => $locked
    ]);
}
public function getMoviesLive(Request $request)
{
    try {

        $date = $request->date;
        $cityId = $request->city;
        $search = trim($request->search);

        $shows = ShowModel::with(['movieData','theaterData'])

            ->whereHas('movieData')
            ->whereHas('theaterData')

            // 📅 DATE FILTER (ONLY IF SELECTED)
            ->when($request->filled('date'), function ($q) use ($date) {
                $q->whereDate('show_date', $date);
            })

            // 🎯 CITY FILTER
            ->when($cityId, function ($q) use ($cityId) {
                $q->whereHas('theaterData', function ($q2) use ($cityId) {
                    $q2->where('cityid', $cityId);
                });
            })

            // 🔍 SEARCH FILTER
            ->when($search !== '', function ($q) use ($search) {
                $q->whereHas('movieData', function ($q2) use ($search) {
                    $q2->where('movie_name', 'LIKE', '%' . $search . '%');
                });
            })

            ->orderBy('show_time')
            ->get()
            ->groupBy('movie_id');

        return response()->json($shows);

    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}
}