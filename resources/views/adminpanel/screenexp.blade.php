@extends('adminpanel.master')
@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Screen Type Form</h4>
                    <hr>
                    <div class="">
                  @if(session('status'))
                    <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                </div>
                    <form class="forms-sample " method="POST" action="{{url('/addscreentype')}}">
                      @csrf
                      <div class="form-group">
                        <label for="screen">Screen Type</label>
                        <input type="text" class="form-control" id="screen" placeholder="Enter Crew Name" name="screen_type">
                        <h6 style="color:red">@error('screen_type'){{$message}}@enderror</h6>
                      </div>

                      <button type="submit" class="btn btn-primary me-2">Add Screen Type</button>
                    </form>
                  </div>
                </div>
              </div>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Screen</h3a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Screen Type</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($screen as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->screen_type}}</td>
                      <td><a href="{{ url('deletescreen/'.$item->id) }}" class="btn btn-danger" onclick="return confirm('Are u sure delete ?')">Delete</a></td>
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