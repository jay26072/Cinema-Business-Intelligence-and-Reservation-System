@extends('userpanel.master')
@section('content')

<section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
<div class="container">
<div class="padding-top padding-bottom">
<div class="account-area">

<div class="section-header-3">
<span class="cate">Verify OTP</span>
<h2 class="title">Enter OTP</h2>
</div>

<form class="account-form" action="/verify-otp" method="post">
@csrf
<div class="form-group">
<label>OTP<span>*</span></label>
<input type="text" name="otp" placeholder="Enter OTP" required>
</div>

<div class="form-group text-center">
<input type="submit" value="Verify OTP">
</div>
</form>

</div>
</div>
</div>
</section>

@endsection