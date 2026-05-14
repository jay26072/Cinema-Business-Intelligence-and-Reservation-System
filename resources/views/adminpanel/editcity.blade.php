@extends('adminpanel.master')
@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add City Form</h4>
                    <hr>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="forms-sample " method="POST" action="{{url('updatecity/'.$cityList->id)}}">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter City" name="city_name" value="{{$cityList->city_name}}">
                        <h6 style="color:red">@error('city_name'){{$message}}@enderror</h6>
                      </div>
                      <button type="submit" class="btn btn-warning me-2">Update</button>
                    </form>
                  </div>
                </div>
              </div>

<!--  -->
@endsection