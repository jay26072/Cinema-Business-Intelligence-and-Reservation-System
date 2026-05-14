@extends('userpanel.master')
@section('content')

<section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
<div class="container">
<div class="padding-top padding-bottom">
<div class="account-area">

<div class="section-header-3">
<span class="cate">Reset Password</span>
<h2 class="title">New Password</h2>
</div>

<form class="account-form" action="/reset-password" method="post">
@csrf

<div class="form-group">
<label>New Password</label>
<input type="password" name="password" required>
</div>

<div class="form-group">
<label>Confirm Password</label>
<input type="password" name="password_confirmation" required>
</div>

<div class="form-group text-center">
<input type="submit" value="Reset Password">
</div>

</form>

</div>
</div>
</div>
</section>

@endsection