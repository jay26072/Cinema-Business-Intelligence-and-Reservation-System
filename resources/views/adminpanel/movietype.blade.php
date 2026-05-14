@extends('adminpanel.master')
@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Movie Type Form</h4>
                    <hr>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="forms-sample " method="POST" action="{{url('/addmovietype')}}">
                      @csrf
                      <div class="form-group">
                        <label for="type">Movie Type</label>
                        <input type="text" class="form-control" id="type" placeholder="Enter Movie Type" name="movie_type">
                        <h6 style="color:red">@error('movie_type'){{$message}}@enderror</h6>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Add Type</button>
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
                <h3 class="card-title">View City</h3a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Movie Type</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($movietype as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->movie_type}}</td>
                      
                      <td><a href="{{ url('editmovietype/'.$item->id) }}" class="btn btn-primary">Edit</a></td>
                      <td><a href="{{ url('deletemovietype/'.$item->id) }}" class="btn btn-danger" onclick="return confirm('Are u sure delete ?')">Delete</a></td>
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