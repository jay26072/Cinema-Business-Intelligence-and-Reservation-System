@extends('adminpanel.master')
@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Crew Form</h4>
                    <hr>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="forms-sample " method="POST" action="{{url('/insertcrew')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="crew">Crew</label>
                        <input type="text" class="form-control" id="crew" placeholder="Enter Crew Name" name="crewname">
                        <h6 style="color:red">@error('crewname'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="crewtype">Crew Type</label>
                        <select name="crewtype" id="crewtype" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="Producer">Producer</option>
                            <option value="Director">Director</option>
                            <option value="Writer">Writer</option>
                            <option value="Productionhouse">Production House</option>

                        </select>
                        <h6 style="color:red">@error('crewname'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="crew">Image</label>
                        <input type="file" class="form-control" id="img" name="crew_img">
                        <h6 style="color:red">@error('crew_img'){{$message}}@enderror</h6>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Add Crew</button>
                    </form>
                  </div>
                </div>
              </div>

<!--  -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Crew</h3a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Crew Name</th>
                    <th>Crew Type</th>
                    <th>Crew Image</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($crew as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->crewname}}</td>
                      <td>{{$item->type}}</td>
                      <td><img src="{{url('/image_upload/'.$item->image)}}" width="50px" height="50px"></td>
                      <td><a href="{{ url('editcrew/'.$item->id) }}" class="btn btn-primary">Edit</a></td>
                      <td><a href="{{ url('deletecrew/'.$item->id) }}" class="btn btn-danger" onclick="return confirm('Are u sure delete ?')">Delete</a></td>
                    </tr>
                  @endforeach  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
@endsection