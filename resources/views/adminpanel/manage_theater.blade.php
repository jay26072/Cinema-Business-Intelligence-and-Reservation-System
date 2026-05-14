@extends('adminpanel.master')
@section('content')

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Theater</h3a>
              </div>
               <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Theater Logo</th>
                    <th>Theater Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($theater as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td><img src="{{url('/image_upload/'.$item->theater_image)}}" width="100px" height="100px"></td>
                      <td>{{$item->theater_name}}</td>
                      <td>{{$item->theater_address}}</td>
                      <td>{{$item->theater_contact}}</td>
                      <td>{{$item->theater_email}}</td>
                      <td><a href="{{ url('edittheater/'.$item->id) }}" class="btn btn-primary">Edit</a></td>
                      <td><a href="{{ url('deletetheater/'.$item->id) }}" class="btn btn-danger" onclick="return confirm('Are u sure delete ?')">Delete</a></td>
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