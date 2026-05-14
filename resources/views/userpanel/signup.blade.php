@extends('userpanel.master')
@section('content')

 <!-- ==========Sign-In-Section========== -->
    <section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <div class="section-header-3">
                        <span class="cate">welcome</span>
                        <h2 class="title">to Boleto </h2>
                    </div>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="account-form" method="POST" action="{{url('/insertsignup')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name<span>*</span></label>
                            <input type="text" placeholder="Enter Your Full Name" id="name" name="name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32">
                            <h6 style="color:red">@error('name'){{$message}}@enderror</h6>
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span>*</span></label>
                            <input type="text" placeholder="Enter Your Email" id="email" name="email" >
                            <h6 style="color:red">@error('email'){{$message}}@enderror</h6>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile Number<span>*</span></label>
                            <input type="text" placeholder="Enter Your Mobile Number" id="mobile" name="mobile_no" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
                            <h6 style="color:red">@error('mobile_no'){{$message}}@enderror</h6>
                        </div>

                        <div class="form-group">
                            <label for="pass1">Password<span>*</span></label>
                            <input type="password" placeholder="Password" id="pass1" name="password" maxlength="8">
                            <h6 style="color:red">@error('password'){{$message}}@enderror</h6>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Sign Up">
                        </div>
                    </form>
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success')}}
                        </div>
                  @endif
                  @if(Session::get('fail'))
                        <div class="alert alert-danger">
                        {{ Session::get('fail')}}
                        </div>
                  @endif
                    <div class="option">
                        Already have an account? <a href="{{url('/signin')}}">Login</a>
                    </div>
                    <div class="or"><span>Or</span></div>
                    <ul class="social-icons">
                        <li>
                            <a href="#0">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#0" class="active">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#0">
                                <i class="fab fa-google"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Sign-In-Section========== -->
@endsection