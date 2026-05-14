@extends('adminpanel.master')
@section('content')

<div class="col-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<h4 class="card-title">Add Promo Code</h4>
<hr>

@if(session('status'))
    <h6 style="color:green">{{session('status')}}</h6>
@endif

<form method="POST" action="{{url('/insertpromo')}}">
@csrf

<div class="form-group">
<label>Promo Code</label>
<input type="text" class="form-control" name="code" required>
@error('code')<small style="color:red">{{$message}}</small>@enderror
</div>

<div class="form-group">
<label>Discount Type</label>
<select class="form-control" name="discount_type" required>
<option value="percentage">Percentage</option>
<option value="flat">Flat</option>
</select>
</div>

<div class="form-group">
<label>Discount Value</label>
<input type="number" step="0.01" class="form-control" name="discount_value" required>
</div>

<div class="form-group">
<label>Minimum Amount</label>
<input type="number" step="0.01" class="form-control" name="min_amount">
</div>

<div class="form-group">
<label>Usage Limit (optional)</label>
<input type="number" class="form-control" name="usage_limit">
</div>

<div class="form-group">
<label>Expiry Date</label>
<input type="datetime-local" class="form-control" name="expires_at">
</div>

<div class="form-group">
<label>Status</label>
<select class="form-control" name="is_active">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

<button type="submit" class="btn btn-primary">Add Promo</button>

</form>

</div>
</div>
</div>

@endsection
