<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use App\Models\CityModel;
use App\Models\TypesofMovieModel;
use App\Models\CrewModel;
use App\Models\CastModel;
use App\Models\ScreenExpModel;
use App\Models\TheaterModel;
use App\Models\MovieModel;
use App\Models\PromoCode;
use App\Models\BookingModel;
use App\Models\ShowModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\TheaterWelcomeMail;
use App\Mail\TheaterPasswordReset;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminPanelController extends Controller
{
    public function changepassword()
    {
        return view('adminpanel.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
        'id' => 'required',
        'newpassword' => 'required',
        ]);

        $id = $request->id;
        $admin = LoginModel::find($id);
        $admin->password = $request->newpassword;
        $admin->save();
        $admin = LoginModel::find($id);
        $request->session()->flash('success', 'Password Change SuccessFully');
        $request->session()->put('AdminLogginId', $admin);

        return redirect('/chpass')->with('status','Password Updated Successfully');
    }

    
   public function city()
   {
    $cityList=CityModel::all();
    return view('adminpanel.city',compact('cityList'));
   }

   public function Addcity(Request $request)
    {

        $request->validate([
            'city_name'  => 'required|unique:city_models,city_name|'
        ]);

        $city = new CityModel();
        $city->city_name = $request->city_name;
        $city->save();

        return redirect('/city')->with('status','City Added Successfully');
    }

    public function editCity($id)
    {
        $cityList = CityModel::find($id);
        return view('adminpanel.editcity', compact('cityList'));
    }

    public function updateCity(Request $request, $id)
    {
        $request->validate([
            'city_name'  => 'required|unique:city_models,city_name'
        ]);

        $city = CityModel::find($id);
        $city->city_name = $request->city_name;
        $city->save();

        return redirect('/city')->with('status','City Updated Successfully');
    }

    public function DeleteCity($id)
    {
        $city = CityModel::find($id);
        $city->delete();
        return redirect('/city')->with('status','City Deleted Successfully');
    }

    public function MovieType()
    {
        $movietype=TypesofMovieModel::all();
        return view('adminpanel.movietype',compact('movietype'));
    }
    public function AddMovieType(Request $request)
    {
        $request->validate([
            'movie_type'  => 'required|unique:typesof_movie_models,movie_type'
        ]);

        $movietype = new TypesofMovieModel();
        $movietype->movie_type = $request->movie_type;
        $movietype->save();

        return redirect('/movietype')->with('status','Movie Type Added Successfully');
    }

    public function editMovieType($id)
    {
        $movietype = TypesofMovieModel::find($id);
        return view('adminpanel.editmovietype', compact('movietype'));
    }

    public function updateMovieType(Request $request, $id)
    {
        $request->validate([
            'movie_type'  => 'required|unique:typesof_movie_models,movie_type'
        ]);

        $movietype = TypesofMovieModel::find($id);
        $movietype->movie_type = $request->movie_type;
        $movietype->save();

        return redirect('/movietype')->with('status','Movie Type Updated Successfully');
    }

    public function DeleteMovieType($id)
    {
        $movietype = TypesofMovieModel::find($id);
        $movietype->delete();
        return redirect('/movietype')->with('status','Movie Type Deleted Successfully');
    }

    // Cast

    public function Cast()
    {
        $cast=CastModel::all();
        return view('adminpanel.cast',compact('cast'));
    }

    public function AddCast(Request $request)
    {

        $request->validate([
            'castname'  => 'required|unique:cast_models,castname',
            'cast_img'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        
        $cast = new CastModel();
        $cast->castname = $request->castname;
        $file= $request->file('cast_img');
        $extenstion=$file->getClientOriginalExtension();
        $filename=rand(11111,99999).'.'.$extenstion;
        $file->move('image_upload/',$filename);
        $cast->image=$filename;   
        $cast->save();

        return redirect('/cast')->with('status','Cast Added Successfully');

    }

    public function editCast($id)
    {
        $cast = CastModel::find($id);
        return view('adminpanel.editcast', compact('cast'));
    }

    public function updateCast(Request $request, $id)
    {
        $request->validate([
            'castname'  => 'required',
            'cast_img'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $cast = CastModel::find($id);
        $cast->castname = $request->castname;
        if($request->hasFile('cast_img'))
        {
            $file= $request->file('cast_img');
            $extenstion=$file->getClientOriginalExtension();
            $filename=rand(11111,99999).'.'.$extenstion;
            $file->move('image_upload/',$filename);
            $cast->image=$filename;
        }
        $cast->save();

        return redirect('/cast')->with('status','Cast Updated Successfully');
    }

    public function DeleteCast($id)
    {
        $cast = CastModel::find($id);
        $cast->delete();
        return redirect('/cast')->with('status','Cast Deleted Successfully');
    }

    // crew

    public function Crew()
    {
        $crew=CrewModel::all();
        return view('adminpanel.crew',compact('crew'));
    }

    public function AddCrew(Request $request)
    {   

        $request->validate([
            'crewname'  => 'required|unique:crew_models,crewname',
            'crew_img'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'crewtype'  => 'required'
        ]);

        $crew = new CrewModel();
        $crew->crewname = $request->crewname;
        $crew->type = $request->crewtype;
        $file= $request->file('crew_img');
        $extenstion=$file->getClientOriginalExtension();
        $filename=rand(11111,99999).'.'.$extenstion;
        $file->move('image_upload/',$filename);
        $crew->image=$filename;   
        $crew->save();

        return redirect('/crew')->with('status','Crew Added Successfully');
    }

    public function editCrew($id)
    {
        $crew = CrewModel::find($id);
        return view('adminpanel.editcrew', compact('crew'));
    }

    public function updateCrew(Request $request, $id)
    {
        $request->validate([
            'crewname'  => 'required',
            'crew_img'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $crew = CrewModel::find($id);
        $crew->crewname = $request->crewname;
        $crew->type = $request->countryid;
        if($request->hasFile('crew_img'))
        {
            $file= $request->file('crew_img');
            $extenstion=$file->getClientOriginalExtension();
            $filename=rand(11111,99999).'.'.$extenstion;
            $file->move('image_upload/',$filename);
            $crew->image=$filename;
        }
        $crew->save();

        return redirect('/crew')->with('status','Crew Updated Successfully');
    }

    public function DeleteCrew($id)
    {
        $crew = CrewModel::find($id);
        $crew->delete();
        return redirect('/crew')->with('status','Crew Deleted Successfully');
    }
    

    // Screen Exp

    public function ScreenExp()
    {
        $screen=ScreenExpModel::all();
        return view('adminpanel.screenexp',compact('screen'));
    }

    public function AddScreenExp(Request $request)
    {
        $request->validate([
            'screen_type'  => 'required|unique:screen_exp_models,screen_type'
        ]);

        $screen = new ScreenExpModel();
        $screen->screen_type = $request->screen_type;
        $screen->save();

        return redirect('/screentype')->with('status','Screen Type Added Successfully');
    }
    
    public function DeleteScreenExp($id)
    {
        $screen = ScreenExpModel::find($id);
        $screen->delete();
        return redirect('/screentype')->with('status','Screen Type Deleted Successfully');
    }

    public function Theater()
    {
        $theater=TheaterModel::all();
        $city=CityModel::all();
        return view('adminpanel.theaters',compact('theater','city'));
    }

    public function AddTheater(Request $request)
    {
        $request->validate([
            'theater_img'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theater_name'  => 'required|unique:theater_models,theater_name',
            'cityid'  => 'required',
            'theater_address'  => 'required',
            'theater_contact'  => 'required',
            'theater_email'  => 'required|unique:theater_models,theater_email',
            'password'  => 'required',
            'no_of_screen'  => 'required'
        ]);

        $theater = new TheaterModel();
        $theater->theater_name = $request->theater_name;
        $theater->theater_address = $request->theater_address;
        $theater->cityid = $request->cityid;
        $theater->theater_contact = $request->theater_contact;
        $theater->theater_email = $request->theater_email;
        $theater->password = $request->password;
        $theater->no_of_screen = $request->no_of_screen;
        $file= $request->file('theater_img');
        $extenstion=$file->getClientOriginalExtension();
        $filename=rand(11111,99999).'.'.$extenstion;
        $file->move('image_upload/',$filename);
        $theater->theater_image=$filename;

        $theater->save();

        // ✅ SEND EMAIL
        Mail::to($theater->theater_email)
            ->send(new TheaterWelcomeMail($theater, $request->password));
        

        return redirect('/theater')->with('status','Theater Added Successfully');
    }

    public function ManageTheater()
    {
        $theater=TheaterModel::all();
        return view('adminpanel.manage_theater',compact('theater'));
    }

    public function editTheater($id)
    {
        $theater = TheaterModel::find($id);
        $city=CityModel::all();
        return view('adminpanel.edittheater', compact('theater','city'));
    }

    public function updateTheater(Request $request, $id)
    {
        $request->validate([
            'theater_img'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theater_name'  => 'required',
            'cityid'  => 'required',
            'theater_address'  => 'required',
            'theater_contact'  => 'required',
            'theater_email'  => 'required',
            'no_of_screen'  => 'required'
        ]);

        $theater = TheaterModel::find($id);
        $theater->theater_name = $request->theater_name;
        $theater->cityid = $request->cityid;
        $theater->theater_address = $request->theater_address;
        $theater->theater_contact = $request->theater_contact;
        $theater->theater_email = $request->theater_email;
        $theater->no_of_screen = $request->no_of_screen;
        if($request->hasFile('theater_img'))
        {
            $file= $request->file('theater_img');
            $extenstion=$file->getClientOriginalExtension();
            $filename=rand(11111,99999).'.'.$extenstion;
            $file->move('image_upload/',$filename);
            $theater->theater_image=$filename;
        }
        $theater->save();
        return redirect('/manage_theater')->with('status','Theater Updated Successfully');
    }


public function insertPromo(Request $request)
{
    $request->validate([
        'code' => 'required|unique:promo_codes,code',
        'discount_type' => 'required',
        'discount_value' => 'required|numeric'
    ]);

    $promo= new PromoCode();
    $promo->code=$request->code;
    $promo->discount_type=$request->discount_type;
    $promo->discount_value=$request->discount_value;
    $promo->min_amount=$request->min_amount;
    $promo->usage_limit=$request->usage_limit;
    $promo->expires_at=$request->expires_at;
    $promo->is_active=$request->is_active;
    $promo->save();

    return redirect('/promo')->with('status','Promo Code Added Successfully');
}

public function promoPage()
{
    $promoList = PromoCode::all();
    return view('adminpanel.promocode', compact('promoList'));
}


public function deletePromo($id)
{
    $promo = PromoCode::find($id);
    $promo->delete();
    return redirect('/promo')->with('status','Promo Deleted Successfully');
}

public function bookingList(Request $request)
{
    $query = BookingModel::with(['userData','movieData','theaterData'])->whereHas('showData');

    // 🎭 Theater
    if($request->theater_id){
        $query->where('theater_id', $request->theater_id);
    }

    // 💳 Payment
    if($request->payment_status){

        $query->where('payment_status', $request->payment_status);
    }

    // 📅 Specific Date (SHOW DATE)
    if($request->date){
        $query->whereHas('showData', function($q) use ($request){
            $q->whereDate('show_date', $request->date);
        });
    }

    // ⏰ TIME FILTER (SHOW BASED)
    if($request->time_filter == 'today'){
        $query->whereHas('showData', function($q){
            $q->whereDate('show_date', now());
        });
    }

    // 🎬 FILTER BY SHOW TIME
if($request->show_time){
    $query->whereHas('showData', function($q) use ($request){
        $q->whereTime('show_time', $request->show_time);
    });
}

    if($request->time_filter == 'week'){
        $query->whereHas('showData', function($q){
            $q->whereBetween('show_date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        });
    }

    if($request->time_filter == 'month'){
        $query->whereHas('showData', function($q){
            $q->whereMonth('show_date', now()->month);
        });
    }

    $bookings = $query->latest()->get();
    $theaters = TheaterModel::all();

    $showTimes = ShowModel::select('show_time')
    ->distinct()
    ->orderBy('show_time')
    ->pluck('show_time');

    return view('adminpanel.booking-list', compact('bookings','theaters','showTimes'));
}

public function exportPdf(Request $request)
{
    $query = BookingModel::with(['userData','movieData','showData','theaterData']);

    // SAME FILTERS (copy paste)
    if($request->theater_id){
        $query->where('theater_id', $request->theater_id);
    }

    if($request->payment_status){
        $query->where('payment_status', $request->payment_status);
    }

    if($request->date){
        $query->whereHas('showData', function($q) use ($request){
            $q->whereDate('show_date', $request->date);
        });
    }

    if($request->time_filter == 'today'){
        $query->whereHas('showData', fn($q)=>$q->whereDate('show_date', now()));
    }

    if($request->time_filter == 'week'){
        $query->whereHas('showData', fn($q)=>$q->whereBetween('show_date', [now()->startOfWeek(), now()->endOfWeek()]));
    }

    if($request->time_filter == 'month'){
        $query->whereHas('showData', fn($q)=>$q->whereMonth('show_date', now()->month));
    }

    $bookings = $query->get();

    $pdf = Pdf::loadView('adminpanel.booking-pdf', compact('bookings'));

    return $pdf->download('booking-report.pdf');
}


public function adminDashboard(Request $request)
{
    $admin = LoginModel::find(session('AdminLogginId'));
    $filter = $request->filter ?? 'month';

    $baseQuery = BookingModel::where('payment_status', 'completed');

    // 📅 FILTER
    if ($filter == 'today') {
        $baseQuery->whereDate('created_at', today());
    } elseif ($filter == 'week') {
        $baseQuery->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    } else {
        $baseQuery->whereMonth('created_at', now()->month);
    }

    // 🎭 THEATER STATS
    $theaterStats = (clone $baseQuery)
        ->select(
            'theater_id',
            DB::raw('SUM(total_price) as revenue'),
            DB::raw('COUNT(*) as bookings')
        )
        ->groupBy('theater_id')
        ->with('theaterData')
        ->get();

    $topTheater = $theaterStats->sortByDesc('revenue')->first();

    // 📊 CHART DATA
    $labels = $theaterStats->pluck('theaterData.theater_name')->values();
    $bookingData = $theaterStats->pluck('bookings')->values();
    $revenueData = $theaterStats->pluck('revenue')->values();

    // 🥧 PIE CHART
    $pieLabels = $labels;
    $pieData = $revenueData;

    // 📈 TOTALS
    $totalTheaters = TheaterModel::count();
    $totalRevenue = $theaterStats->sum('revenue');
    $totalBookings = $theaterStats->sum('bookings');

    // 🔥 GROWTH
    $todayRevenue = BookingModel::whereDate('created_at', today())->sum('total_price');
    $yesterdayRevenue = BookingModel::whereDate('created_at', today()->subDay())->sum('total_price');

    $revenueGrowth = $yesterdayRevenue > 0
        ? round((($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100, 2)
        : 0;

    $todayBookings = BookingModel::whereDate('created_at', today())->count();
    $yesterdayBookings = BookingModel::whereDate('created_at', today()->subDay())->count();

    $bookingGrowth = $yesterdayBookings > 0
        ? round((($todayBookings - $yesterdayBookings) / $yesterdayBookings) * 100, 2)
        : 0;
        
    $totalSeats = 100;
    $occupancy = BookingModel::where('booking_status', 'confirmed')
        ->select('movie_id', DB::raw('COUNT(*) as sold'))
        ->groupBy('movie_id')
        ->get()
        ->map(function ($item) use ($totalSeats) {
            $item->percent = round(($item->sold / $totalSeats) * 100);
            return $item;
        });



    return view('adminpanel.adminindex', compact(
        'theaterStats',
        'topTheater',
        'labels',
        'bookingData',
        'revenueData',
        'pieLabels',
        'pieData',
        'totalTheaters',
        'totalRevenue',
        'totalBookings',
        'revenueGrowth',
        'bookingGrowth',
        'filter',
        'occupancy',
        'admin',
    ));

}

public function dashboardData(Request $request)
{
    
    $filter = $request->filter ?? 'month';

    $baseQuery = BookingModel::where('payment_status', 'completed');

    if ($filter == 'today') {
        $baseQuery->whereDate('created_at', today());
    } elseif ($filter == 'week') {
        $baseQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    } else {
        $baseQuery->whereMonth('created_at', now()->month);
    }

    // 🎭 Theater Stats
    $theaterStats = (clone $baseQuery)
        ->select(
            'theater_id',
            DB::raw('SUM(total_price) as revenue'),
            DB::raw('COUNT(*) as bookings')
        )
        ->groupBy('theater_id')
        ->with('theaterData')
        ->get();

    $totalRevenue = $theaterStats->sum('revenue');
    $totalBookings = $theaterStats->sum('bookings');

    // 📊 Chart Data
    $labels = $theaterStats->pluck('theaterData.theater_name');
    $bookingData = $theaterStats->pluck('bookings');
    $revenueData = $theaterStats->pluck('revenue');

    // 🥧 Pie Data
    $pieLabels = $labels;
    $pieData = $revenueData;

    return response()->json([
        'totalRevenue' => $totalRevenue,
        'totalBookings' => $totalBookings,
        'labels' => $labels,
        'bookingData' => $bookingData,
        'revenueData' => $revenueData,
        'pieLabels' => $pieLabels,
        'pieData' => $pieData
    ]);
    
}


public function theaterList()
{
    $theaters = TheaterModel::with('cityData')->get();

    return view('adminpanel.theater_reset_password', compact('theaters'));
}

public function resetTheaterPassword($id)
{
    $theater = TheaterModel::find($id);

    if(!$theater){
        return back()->with('status', 'Theater not found');
    }

    $newPassword = '12345';

    // Save password
    $theater->password = $newPassword;
    $theater->save();

    // Send email
    try {
        Mail::to($theater->theater_email)
            ->send(new TheaterPasswordReset($theater, $newPassword));
    } catch (\Exception $e) {
        return back()->with('status', 'Password reset but failed to send email');
    }

    return back()->with('status', 'Password reset & email sent');
}


}
