<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use App\Models\TheaterModel;
use App\Models\UserModel;
use Session;

class LoginController extends Controller
{
    public function Login()
    {
        return view('userpanel.signin');
    }
    public function check(Request $request)
    {
    //return $request->all();
        if($request->user=="Admin")
        {
            
             $data=LoginModel::where(['email'=>$request->email,'password'=>$request->password])->first();
             //return $data;
             if($data)
            {
                 $request->session()->put('AdminLogginId',$data);
                    $request->session()->put('role', 'Admin');
                //return $data;
                 return redirect('/adminindex');
            }
            else
                {
                    return back()->with('fail','Invalid Username or  Password');
                }
        }
        elseif($request->user=="TheaterManager")
        {
            $data=TheaterModel::where(['theater_email'=>$request->email,'password'=>$request->password])->first();
            //return $data;
            if($data)
            {
                $request->session()->put('TheaterManagerLogginId',$data);
                $request->session()->put('role', 'TheaterManager');
                //return $data;
                return redirect('/theaterindex');
            }
            else
                {
                    return back()->with('fail','Invalid Username or  Password');
                }
        }
        elseif($request->user=="User")
        {
            $data=UserModel::where(['email'=>$request->email,'password'=>$request->password])->first();
            //return $data;
            if($data)
            {
               $request->session()->put('UserLogginId', $data->id);
               $request->session()->put('role', 'User');
                //return $data;
                return redirect('/userindex');
            }
            else
                {
                    return back()->with('fail','Invalid Username or  Password');
                }
        }
        else
        {
            return back()->with('fail','Please select a user type');
        }

    }

    public function showLogin()
    {
        if(session('UserLogginId') && session('role') == 'User'){
            return redirect('/userindex'); // or '/'
        }
        return view('userpanel.signin');
    }

    // Logout

    public function Adminlogout(Request $request)
    {
        $request->session()->forget('AdminLogginId');
        $request->session()->forget('role');
        // $request->session()->flush();
        // $request->session()->invalidate(); // This destroys the session file on the server
        // $request->session()->regenerateToken();
        return redirect('/signin');
    }

    public function Theaterlogout(Request $request)
    {
        $request->session()->forget('TheaterManagerLogginId');
        $request->session()->forget('role');

        // $request->session()->flush();
        // $request->session()->invalidate(); // This destroys the session file on the server
        // $request->session()->regenerateToken();
        return redirect('/signin');
    }

    public function Userlogout(Request $request)
    {
        $request->session()->forget('UserLogginId');
        $request->session()->forget('role');

        // $request->session()->flush();
        // $request->session()->invalidate(); // This destroys the session file on the server
        // $request->session()->regenerateToken();
        return redirect('/signin');
    }
}
