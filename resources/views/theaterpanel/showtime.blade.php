@extends('theaterpanel.master')
@section('content')

@php
    $theater = session('TheaterManagerLogginId');
@endphp
  <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Movie Form</h4>
                    <hr>
                    <div class="">
                      @if(session('status'))
                        <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                    </div>
                    
                    <form class="forms-sample " method="POST" action="{{url('/addshowtime')}}" >
                      @csrf
                      
                      <div class="form-group">
                        <label for="movie">Movie Name</label>
                        <select class="form-control" id="movie" name="movie_name">
                            <option value="">Select Movie</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}">{{ $movie->movie_name }}</option>
                            @endforeach
                      </select>
                        <h6 style="color:red">@error('movie_name'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="theater">Theater Name</label>
                        <select class="form-control" id="theater" name="theater_name">
                            <option value="{{ session('TheaterManagerLogginId')->id }}">
                                {{ session('TheaterManagerLogginId')->theater_name }}
                            </option>
                        </select>
                        <h6 style="color:red">@error('movie_name'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="showdate">Show Date</label>
                        <input type="date" class="form-control" id="showdate" placeholder="Enter Show Time" name="show_date">
                        <h6 style="color:red">@error('show_date'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="showtime">Show Time</label>
                        <input type="time" class="form-control" id="showtime" placeholder="Enter Show Time" name="show_time">
                        <h6 style="color:red">@error('show_time'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="language">Select Language</label>
                        <select class="form-control" id="language" name="language">
                            <option value="">Select Language</option>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Gujarati">Gujarati</option>
                            <option value="Tamil">Tamil</option>
                        </select>
                        <h6 style="color:red">@error('show_time'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="screen_type">Screen Type</label>
                        <br>
                          <select class="form-control" id="screen_type" name="screen_type">
                            <option value="">Screen Type</option>
                            @foreach($screxps as $screxp)
                            <option value="{{$screxp->id}}">{{$screxp->screen_type}}</option>
                            @endforeach
                          </select>
                        <h6 style="color:red">@error('screen_type'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
    <label for="screen_no">Screen No</label>
    <br>

    <select class="form-control" id="screen_no" name="screen_no">
        <option value="">Select Screen No</option>

        @for($i = 1; $i <= $theater->no_of_screen; $i++)
            <option value="{{ $i }}"
                {{ old('screen_no') == $i ? 'selected' : '' }}>
                {{ $i }}
            </option>
        @endfor

    </select>

    <h6 style="color:red">
        @error('screen_no') {{ $message }} @enderror
    </h6>
</div>

                      

                      <button type="submit" class="btn btn-primary me-2">Add Showtime</button>
                    </form>
                  </div>
                </div>
              </div>

@endsection