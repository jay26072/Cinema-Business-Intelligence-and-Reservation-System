@extends('adminpanel.master')
@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Cast Form</h4>
                    <hr>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="forms-sample " method="POST" action="{{url('updatecast/'.$cast->id)}}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="cast">Cast</label>
                        <input type="text" class="form-control" id="cast" placeholder="Enter Cast Name" value="{{$cast->castname}}" name="castname">
                        <h6 style="color:red">@error('castname'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                      <img src="{{url('/image_upload/'.$cast->image)}}" width="100px" height="100px">
                      </div>

                      <div class="form-group">
                        <label for="cast">Image</label>
                        
                        <input type="file" class="form-control" id="img" name="cast_img">
                        <h6 style="color:red">@error('cast_img'){{$message}}@enderror</h6>
                      </div>
                      <button type="submit" class="btn btn-warning me-2">Update Cast</button>
                    </form>
                  </div>
                </div>
              </div>

@endsection