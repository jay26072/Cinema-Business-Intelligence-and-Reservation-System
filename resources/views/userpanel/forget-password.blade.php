@extends('userpanel.master')
@section('content')

<section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
<div class="container">
<div class="padding-top padding-bottom">
<div class="account-area">

<div class="section-header-3">
<span class="cate">Forgot Password</span>
<h2 class="title">Send OTP</h2>
</div>

<form class="account-form" action="/send-otp" method="post">
@csrf
<div class="form-group">
<label>Email<span>*</span></label>
<input type="email" name="email" placeholder="Enter Email" required>
</div>

<div class="form-group text-center">
<input type="submit" value="Send OTP">
</div>
</form>

</div>
</div>
</div>
</section>

@endsection