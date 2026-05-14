<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypesOfMovieModel;
use App\Models\ScreenExpModel;
use App\Models\CastModel;
use App\Models\CrewModel;
use App\Models\MovieModel;
use App\Models\TheaterModel;
use App\Models\ShowModel;
use App\Models\BookingModel;
use Carbon\Carbon;
use DB;

class TheaterManagerController extends Controller
{

    public function changepassword()
    {
        return view('theaterpanel.change_password');
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'newpassword' => 'required',
        ]);
        try {
            $id = $request->id;
            $theater_manager = TheaterModel::find($id);
            $theater_manager->password = $request->newpassword;
            $theater_manager->save();
            $theater_manager = TheaterModel::find($id);
            $request->session()->flash('success', 'Password Change SuccessFully');
            $request->session()->put('TheaterManagerLogginId', $theater_manager);
            return view('theaterpanel.change_password');
        } catch (Exception $e) {
            $request->session()->flash('er', $e->getMessage());
            return view('theaterpanel.change_password');
        }
    }
    public function Movie()
    {
        $movietypes=TypesOfMovieModel::all();
        $screenexp=ScreenExpModel::all();
        $actors=CastModel::all();
        $crew=CrewModel::all();
        return view('theaterpanel.Movies_theater',compact('movietypes','screenexp','actors','crew'));
    }

    public function AddMovie(Request $request)
    {
        $validated = $request->validate([
            'movie_name' => 'required',
            'movie_description' => 'required',
            'movie_img' => 'required',
            'movie_type' => 'required',
            'movie_duration' => 'required',
            'movie_language' => 'required',
            'screen_type' => 'required',
            'release_date' => 'required',
            'movie_trailer' => 'required',
            'movie_trailer_date' => 'required',
            'movie_cast' => 'required',
            'movie_crew' => 'required',
        ]);

        $movie = new MovieModel();
        $movie->movie_name = $request->movie_name;
        $file= $request->file('movie_img');
        $extenstion=$file->getClientOriginalExtension();
        $filename=rand(11111,99999).'.'.$extenstion;
        $file->move('image_upload/',$filename);
        $movie->movie_image=$filename;
        $movie->movie_description = $request->movie_description;
        $movie_type=implode(',', $request->movie_type);
        $movie->movie_type = $movie_type;
        $movie->movie_duration = $request->movie_duration;
        $language = implode(',', $request->movie_language);
        $movie->language = $language;
        $screen_type=implode(',', $request->screen_type);
        $movie->screen_type = $screen_type;
        $movie->release_date = $request->release_date;
        $movie->movie_trailer = $request->movie_trailer;
        $movie->movie_trailer_date = $request->movie_trailer_date;
        $cast=implode(',', $request->movie_cast);
        $movie->movie_cast = $cast;
        $crew=implode(',', $request->movie_crew);
        $movie->movie_crew = $crew;
        $movie->save();

        return redirect('/movie')->with('status','Movie Added Successfully');

    }

    public function movie_list()
    {
        $movies=MovieModel::all();
        return view('theaterpanel.movie_list',compact('movies'));
    }

    public function editMovie($id)
    {
        $movie = MovieModel::find($id);
        $movie->movie_type=explode(',', $movie->movie_type);
        $movie->language=explode(',', $movie->language);
        $movie->screen_type=explode(',', $movie->screen_type);
        $movie->movie_cast=explode(',', $movie->movie_cast);
        $movie->movie_crew= explode(',', $movie->movie_crew);
        $movietypes=TypesOfMovieModel::all();
        $screenexp=ScreenExpModel::all();
        $actors=CastModel::all();
        $crew=CrewModel::all();
        return view('theaterpanel.editmovie',compact('movie','movietypes','screenexp','actors','crew'));
    }

    public function updateMovie(Request $request, $id)
    {
        $request->validate([
        'movie_name' => 'required',
        'movie_description' => 'required',
        'movie_img' => 'nullable|image|mimes:jpg,jpeg,png',
        'movie_type' => 'required|array',
        'movie_duration' => 'required',
        'movie_language' => 'required|array',
        'screen_type' => 'required|array',
        'release_date' => 'required',
        'movie_trailer' => 'required',
        'movie_trailer_date' => 'required',
        'movie_cast' => 'required|array',
        'movie_crew' => 'required|array',
        ]);


        $movie = MovieModel::find($id);
        $movie->movie_name = $request->movie_name;
        if($request->hasFile('movie_img'))
        {
            $file= $request->file('movie_img');
            $extenstion=$file->getClientOriginalExtension();
            $filename=rand(11111,99999).'.'.$extenstion;
            $file->move('image_upload/',$filename);
            $movie->movie_image=$filename;
        }
        $movie->movie_description = $request->movie_description;
        $movie_type=implode(',', $request->movie_type);
        $movie->movie_type = $movie_type;
        $movie->movie_duration = $request->movie_duration;
        $language = implode(',', $request->movie_language);
        $movie->language = $language;
        $screen_type=implode(',', $request->screen_type);
        $movie->screen_type = $screen_type;
        $movie->release_date = $request->release_date;
        $movie->movie_trailer = $request->movie_trailer;
        $movie->movie_trailer_date = $request->movie_trailer_date;
        $cast=implode(',', $request->movie_cast);
        $movie->movie_cast = $cast;
        $crew=implode(',', $request->movie_crew);
        $movie->movie_crew = $crew;
        $movie->save();

        return redirect('/movie')->with('status','Movie Updated Successfully');

    }

    public function deleteMovie($id)
    {
        $movie = MovieModel::find($id);
        $movie->delete();
        return redirect('/movie')->with('status','Movie Deleted Successfully');
    }

    public function ShowTime()
    {
        $movies=MovieModel::all();
        $theaters=TheaterModel::all();
        $screxps=ScreenExpModel::all();
        return view('theaterpanel.showtime',compact('movies','theaters','screxps'));
    }

    public function AddShowTime(Request $request)
    {
        $request->validate([
            'movie_name' => 'required',
            'show_date' => 'required',
            'show_time' => 'required',
            'language' => 'required',
            'screen_type' => 'required',
            'screen_no' => 'required',
        ]);

        $showtime = new ShowModel();
        $showtime->movie_id = $request->movie_name;
        $showtime->theater_id = session('TheaterManagerLogginId')->id;
        $showtime->show_date = $request->show_date;
        $showtime->show_time = $request->show_time;
        $showtime->language = $request->language;
        $showtime->screen_type = $request->screen_type;
        $showtime->screen_no = $request->screen_no;
        $showtime->save();

        return redirect('/showtime')->with('status','Showtime Added Successfully');
    }

    public function bookingList(Request $request)
{
    $theater = session('TheaterManagerLogginId');

    if(!$theater){
        return redirect('/signin')->with('fail','Please login first');
    }

    $theaterId = $theater->id;

    $query = BookingModel::with(['userData','movieData','showData'])
        ->where('theater_id', $theaterId)
        ->whereHas('showData');

    // 📅 Date filter
    if($request->date){
        $query->whereHas('showData', function($q) use ($request){
            $q->whereDate('show_date', $request->date);
        });
    }

    // 🎬 Show time filter
    if($request->show_time){
        $query->whereHas('showData', function($q) use ($request){
            $q->whereTime('show_time', $request->show_time);
        });
    }

    // 🎥 Movie filter (NEW 🔥)
    if($request->movie_id){
        $query->where('movie_id', $request->movie_id);
    }

    // 💳 Payment filter
    if($request->payment_status){
        $query->where('payment_status', $request->payment_status);
    }

    $bookings = $query->latest()->get();

    // 🎯 Dropdown show times
    $showTimes = ShowModel::where('theater_id', $theaterId)
        ->select('show_time')
        ->distinct()
        ->orderBy('show_time')
        ->pluck('show_time');

    // 🎥 Dropdown movies (NEW)
    $movies = MovieModel::whereIn('id',
        ShowModel::where('theater_id', $theaterId)->pluck('movie_id')
    )->get();

    return view('theaterpanel.booking_manage', compact('bookings','showTimes','movies'));
}

    public function scannerPage()
    {
        return view('theaterpanel.ticket-scanner');
    }


public function verifyTicket(Request $request)
{
    try {

        // 🔹 STEP 1: GET QR DATA
        $reference = $request->booking_reference;

        if(!$reference){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Ticket'
            ]);
        }

        // 🔹 STEP 2: DECODE QR (if JSON)
        if(is_string($reference) && str_contains($reference,'{')){
            $data = json_decode($reference, true);

            if(!$data || !isset($data['booking_reference'])){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Invalid Ticket'
                ]);
            }

            $reference = $data['booking_reference'];
        }

        // 🔹 STEP 3: FETCH BOOKING
        $booking = BookingModel::with(['movieData','showData','userData'])
            ->where('booking_reference', $reference)
            ->first();

        if(!$booking){
            return response()->json([
                'status'=>'error',
                'message'=>'Invalid Ticket'
            ]);
        }

        // 🔹 STEP 4: CHECK PAYMENT
        if($booking->payment_status !== 'completed'){
            return response()->json([
                'status'=>'error',
                'message'=>'Invalid Ticket'
            ]);
        }

        // 🔹 STEP 5: CHECK SHOW DATA
        if(!$booking->showData){
            return response()->json([
                'status'=>'error',
                'message'=>'Invalid Ticket'
            ]);
        }

        // 🔹 STEP 6: THEATER VALIDATION
        $scannerTheaterId = session('theater_id');

        if($scannerTheaterId && $booking->showData->theater_id != $scannerTheaterId){
            return response()->json([
                'status'=>'error',
                'message'=>'Invalid Ticket'
            ]);
        }

        // 🔹 STEP 7: DUPLICATE SCAN
        if($booking->is_scanned == '1'){
            return response()->json([
                'status'=>'error',
                'message'=>'Ticket Already Used'
            ]);
        }

        // 🔹 STEP 8: TIME VALIDATION
       // 🔹 STEP 8: TIME VALIDATION (FINAL FIX - NO BUG)

$showTime = Carbon::createFromFormat(
    'Y-m-d H:i:s',
    $booking->showData->show_date . ' ' . $booking->showData->show_time,
    'Asia/Kolkata'
);

$now = Carbon::now('Asia/Kolkata');

// Convert to timestamp (SAFE)
$showTimestamp = $showTime->timestamp;
$nowTimestamp = $now->timestamp;

// Window (15 min before & after)
$start = $showTimestamp - (15 * 60); // before
$end   = $showTimestamp + (15 * 60); // after

// ❌ Too early
if($nowTimestamp < $start){
    return response()->json([
        'status'=>'error',
        'message'=>'Too Early (Entry opens 15 min before show)'
    ]);
}

// ❌ Too late
if($nowTimestamp > $end){
    return response()->json([
        'status'=>'error',
        'message'=>'Entry Closed (15 min late)'
    ]);
}

// ⚠️ Late entry
if($nowTimestamp > $showTimestamp){
    $status = "late";
    $message = "Late Entry";
}
else{
    // ✅ Allowed
    $status = "success";
    $message = "Entry Allowed";
}

        // 🔹 STEP 9: MARK SCANNED
        $booking->is_scanned = '1';
        $booking->scanned_at = now();
        $booking->save();

        // 🔹 STEP 10: RESPONSE DATA
        $seats = json_decode($booking->seat_number, true) ?? [];

        return response()->json([
            'status' => $status,
            'message' => $message,
            'movie' => $booking->movieData->movie_name ?? 'Unknown',
            'name' => $booking->userData->name ?? 'Guest',
            'seats' => implode(', ', $seats),
            'show_time' => $showTime->format('h:i A')
        ]);

    } catch (\Exception $e) {

        // 🔴 NEVER SHOW SYSTEM ERROR
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid Ticket'
        ]);
    }
}


// Graphs


public function theaterindex(Request $request)
{
    $theaterId = session('TheaterManagerLogginId')->id;

    $filter = $request->filter ?? 'month';

    $baseQuery = BookingModel::where('theater_id', $theaterId)
        ->where('payment_status', 'completed');

    if ($filter == 'today') {
        $baseQuery->whereDate('created_at', today());
    } elseif ($filter == 'week') {
        $baseQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    } else {
        $baseQuery->whereMonth('created_at', now()->month);
    }

    // 🎬 Movie stats
    $movieStats = (clone $baseQuery)
        ->select(
            'movie_id',
            DB::raw('SUM(total_price) as revenue'),
            DB::raw('COUNT(*) as bookings')
        )
        ->groupBy('movie_id')
        ->with('movieData')
        ->get();

    $topMovie = $movieStats->sortByDesc('revenue')->first();

    // 🎟 Occupancy
    $totalSeats = 100;

    $occupancy = (clone $baseQuery)
        ->where('booking_status', 'confirmed')
        ->select('movie_id', DB::raw('COUNT(*) as sold'))
        ->groupBy('movie_id')
        ->get()
        ->map(function ($item) use ($totalSeats) {
            $item->percent = round(($item->sold / $totalSeats) * 100);
            return $item;
        });

    // 📊 CHART
    $labels = $movieStats->pluck('movieData.movie_name')->values();
    $bookingData = $movieStats->pluck('bookings')->values();
    $revenueData = $movieStats->pluck('revenue')->values();

    // ===============================
    // 🔥 INDIVIDUAL GROWTH CALCULATIONS
    // ===============================

    // 💰 Revenue Growth
    $todayRevenue = BookingModel::where('theater_id',$theaterId)
        ->whereDate('created_at', today())
        ->sum('total_price');

    $yesterdayRevenue = BookingModel::where('theater_id',$theaterId)
        ->whereDate('created_at', today()->subDay())
        ->sum('total_price');

    $revenueGrowth = $yesterdayRevenue > 0
        ? round((($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100, 2)
        : 0;

    // 🎟 Booking Growth
    $todayBookings = BookingModel::where('theater_id',$theaterId)
        ->whereDate('created_at', today())
        ->count();

    $yesterdayBookings = BookingModel::where('theater_id',$theaterId)
        ->whereDate('created_at', today()->subDay())
        ->count();

    $bookingGrowth = $yesterdayBookings > 0
        ? round((($todayBookings - $yesterdayBookings) / $yesterdayBookings) * 100, 2)
        : 0;

    // 🎟 Occupancy Growth (avg compare)
    $todayOcc = BookingModel::where('theater_id',$theaterId)
        ->whereDate('created_at', today())
        ->count();

    $yesterdayOcc = BookingModel::where('theater_id',$theaterId)
        ->whereDate('created_at', today()->subDay())
        ->count();

    $occupancyGrowth = $yesterdayOcc > 0
        ? round((($todayOcc - $yesterdayOcc) / $yesterdayOcc) * 100, 2)
        : 0;

    // 🎬 Total Movies (current filter based)
    $totalMovies = $movieStats->count();

    // 🎬 Movie Growth (today vs yesterday - unique movies booked)

    // Today
    $todayMovies = BookingModel::where('theater_id', $theaterId)
        ->where('payment_status','completed')
        ->whereDate('created_at', today())
        ->distinct('movie_id')
        ->count('movie_id');

    // Yesterday
    $yesterdayMovies = BookingModel::where('theater_id', $theaterId)
        ->where('payment_status','completed')
        ->whereDate('created_at', today()->subDay())
        ->distinct('movie_id')
        ->count('movie_id');

    // Growth %
    $movieGrowth = $yesterdayMovies > 0
        ? round((($todayMovies - $yesterdayMovies) / $yesterdayMovies) * 100, 2)
        : 0;

    // 🥧 PIE CHART DATA (Movie Revenue Share)
    $pieLabels = $movieStats->pluck('movieData.movie_name')->values();
    $pieData = $movieStats->pluck('revenue')->values();

    return view('theaterpanel.theaterindex', compact(
        'movieStats','topMovie','occupancy',
        'labels','bookingData','revenueData',
        'totalMovies','movieGrowth',
        'pieLabels','pieData',
        'revenueGrowth','bookingGrowth','occupancyGrowth',
        'filter'
    ));
}

}