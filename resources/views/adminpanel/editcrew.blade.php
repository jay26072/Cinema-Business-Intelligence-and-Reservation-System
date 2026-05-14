@extends('adminpanel.master')
@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Crew Form</h4>
                    <hr>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="forms-sample " method="POST" action="{{url('updatecrew/'.$crew->id)}}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="crew">Crew</label>
                        <input type="text" class="form-control" id="crew" placeholder="Enter Crew Name" value="{{$crew->name}}" name="crewname">
                        <h6 style="color:red">@error('crewname'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="crew">Crew Type</label>
                        <select name="crewtype" id="crewtype" class="form-control">
                            <option value="{{$crew->type}}">{{$crew->type}}</option>
                            <option value="Producer">Producer</option>
                            <option value="Director">Director</option>
                            <option value="Writer">Writer</option>
                            <option value="Productionhouse">Production House</option>
                        </select>
                        <h6 style="color:red">@error('crewname'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                      <img src="{{url('/image_upload/'.$crew->image)}}" width="100px" height="100px">
                      </div>

                      <div class="form-group">
                        <label for="crew">Image</label>
                        
                        <input type="file" class="form-control" id="img" name="crew_img">
                        <h6 style="color:red">@error('crew_img'){{$message}}@enderror</h6>
                      </div>
                      <button type="submit" class="btn btn-warning me-2">Update Crew</button>
                    </form>
                  </div>
                </div>
              </div>

@endsection