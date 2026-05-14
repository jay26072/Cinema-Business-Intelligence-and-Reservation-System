@extends('adminpanel.master')
@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Cast Form</h4>
                    <hr>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="forms-sample " method="POST" action="{{url('/insertcast')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="cast">Cast</label>
                        <input type="text" class="form-control" id="cast" placeholder="Enter Cast Name" name="castname">
                        <h6 style="color:red">@error('castname'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="cast_img">Image</label>
                        <input type="file" class="form-control" id="img" name="cast_img">
                        <h6 style="color:red">@error('cast_img'){{$message}}@enderror</h6>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Add Cast</button>
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
                <h3 class="card-title">View Cast</h3a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Cast Name</th>
                    <th>Cast Image</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($cast as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->castname}}</td>
                      <td><img src="{{url('/image_upload/'.$item->image)}}" width="50px" height="50px"></td>
                      <td><a href="{{ url('editcast/'.$item->id) }}" class="btn btn-primary">Edit</a></td>
                      <td><a href="{{ url('deletecast/'.$item->id) }}" class="btn btn-danger" onclick="return confirm('Are u sure delete ?')">Delete</a></td>
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