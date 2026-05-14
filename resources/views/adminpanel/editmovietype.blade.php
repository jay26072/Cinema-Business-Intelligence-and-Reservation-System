@extends('adminpanel.master')
@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Movie Type Form</h4>
                    <hr>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="forms-sample " method="POST" action="{{url('updatetype/'.$movietype->id)}}">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="type">Movie Type</label>
                        <input type="text" class="form-control" id="type" placeholder="Enter Movie Type" name="movie_type" value="{{$movietype->movie_type}}">
                        <h6 style="color:red">@error('movie_type'){{$message}}@enderror</h6>
                      </div>
                      <button type="submit" class="btn btn-warning me-2">Update Type</button>
                    </form>
                  </div>
                </div>
              </div>

@endsection