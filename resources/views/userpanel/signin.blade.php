@extends('userpanel.master')
@section('content')
  <section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <div class="section-header-3">
                        <span class="cate">hello</span>
                        <h2 class="title">welcome back</h2>
                    </div>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="account-form" action="/insertlogin" method="post">
                         @csrf
                        <div class="form-group">
                            <label for="user">User Type<span>*</span></label>
                        <select name="user" id="user" class="form-control" required>
                            <option value="">Select User</option>
                            <option value="Admin">Admin</option>
                            <option value="TheaterManager">Theater Manager</option>
                            <option value="User">User</option>
                            <!-- <option value="Deliveryboy">Delivery Boy</option> -->
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="email2">Email<span>*</span></label>
                            <input type="text" placeholder="Enter Your Email" id="email2" name="email" >
                        </div>
                        <div class="form-group">
                            <label for="pass3">Password<span>*</span></label>
                            <input type="password" placeholder="Password" id="pass3" name="password" >
                        </div>
                        <div class="form-group checkgroup">
                            <a href="{{ url('/forget-password') }}" class="forget-pass">Forget Password</a>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="log in">
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
                        Don't have an account? <a href="{{ url('/signup') }}">sign up now</a>
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
@endsection