@extends('userpanel.master')
@section('content')

<section class="account-section bg_img" data-background="{{ asset('assets/images/account/account-bg.jpg') }}">
    <div class="container">
        <div class="padding-top padding-bottom">
            <div class="account-area">

                <div class="section-header-3">
                    <span class="cate">Hello {{ $user->name }}</span>
                    <h2 class="title">My Profile</h2>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="account-form" action="{{ url('/update-profile') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile_no" value="{{ $user->mobile_no ?? '' }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" required>
                    </div>

                    <div class="form-group text-center mt-3">
                        <button type="submit" class="custom-button" style="width: auto;">
                            Update Profile
                        </button>
                    </div>
                </form>

                 <div class="form-group text-center mt-3">
                    <a href="{{ url('/booking_history') }}" class="custom-button">
                        Booking History
                    </a>
                </div>

                <div class="form-group text-center mt-3">
                    <a href="{{ url('/user_logout') }}" class="custom-button">
                        Logout
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection