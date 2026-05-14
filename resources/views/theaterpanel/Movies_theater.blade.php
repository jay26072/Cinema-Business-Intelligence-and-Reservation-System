@extends('theaterpanel.master')
@section('content')
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
                    
                    <form class="forms-sample " method="POST" action="{{url('/addmovie')}}" enctype="multipart/form-data">
                      @csrf
                      <img id="preview" src="#" alt="preview" style="max-width: 200px; display: none; border:2px solid black; margin-bottom: 10px"/>

                     <div class="form-group">
                        <label for="img">Movie Image</label>
                        <input type="file" class="form-control" id="img" name="movie_img" onchange="previewImage(this)">
                         
                        <h6 style="color:red">@error('movie_img'){{$message}}@enderror</h6>
                      </div>


                      <div class="form-group">
                        <label for="movie_name">Movie Name</label>
                        <input type="text" class="form-control" id="movie_name" placeholder="Enter Movie Name" name="movie_name">
                        <h6 style="color:red">@error('movie_name'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_desc">Movie Description</label>
                        <input type="text" class="form-control" id="movie_desc" placeholder="Enter Movie Name" name="movie_description">
                        <h6 style="color:red">@error('movie_description'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_type">Movie Type</label>
                        <br>
                        @foreach($movietypes as $movietype)
                        <input type="checkbox" name="movie_type[]" id="movie_type" value="{{$movietype->id}}"> <label for="movie_type">{{$movietype->movie_type}}</label><br>
                        @endforeach
                        <h6 style="color:red">@error('movie_type'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_duration">Movie Duration</label>
                        <input type="text" class="form-control" id="movie_duration" placeholder="Enter Movie Duration" name="movie_duration">
                        <h6 style="color:red">@error('movie_duration'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_language">Select Language</label>
                        <br>
                        <input type=checkbox name="movie_language[]" id="movie_language" value="English"> <label for="movie_language">English</label><br>
                        <input type=checkbox name="movie_language[]" id="movie_language" value="Hindi"> <label for="movie_language">Hindi</label><br>
                        <input type=checkbox name="movie_language[]" id="movie_language" value="Gujarati"> <label for="movie_language">Gujarati</label><br>
                        <input type=checkbox name="movie_language[]" id="movie_language" value="Tamil"> <label for="movie_language">Tamil</label><br>
                        <input type=checkbox name="movie_language[]" id="movie_language" value="Kannada"> <label for="movie_language">Kannada</label>

                        <h6 style="color:red">@error('movie_language'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="screen_type">Screen Type</label>
                        <br>
                        @foreach($screenexp as $screen_type)
                        <input type="checkbox" name="screen_type[]" id="screen_type" value="{{$screen_type->id}}"> <label for="screen_type">{{$screen_type->screen_type}}</label><br>
                        @endforeach
                        <h6 style="color:red">@error('screen_type'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_release">Movie Release Date</label>
                        <input type="date" class="form-control" id="movie_release" name="release_date">
                        <h6 style="color:red">@error('release_date'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_trailer">Movie Trailer</label>
                        <input type="text" class="form-control" id="movie_trailer" placeholder="Enter Movie Trailer Link" name="movie_trailer">
                        <h6 style="color:red">@error('movie_trailer'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="trailer_release">Movie Trailer Release Date</label>
                        <input type="date" class="form-control" id="trailer_release" name="movie_trailer_date">
                        <h6 style="color:red">@error('movie_trailer_date'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_cast">Movie Cast</label>
                        <br>
                        @foreach($actors as $actor)
                        <input type="checkbox" name="movie_cast[]" id="movie_cast" value="{{$actor->id}}"> <label for="movie_cast">{{$actor->castname}}</label><br>
                        @endforeach
                        <h6 style="color:red">@error('movie_cast'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_crew">Movie Crew</label>
                        <br>
                        @foreach($crew as $crew)
                        <input type="checkbox" name="movie_crew[]" id="movie_crew" value="{{$crew->id}}"> <label for="movie_crew">{{$crew->crewname}} [{{$crew->type}}]</label><br>
                        @endforeach
                        <h6 style="color:red">@error('movie_crew'){{$message}}@enderror</h6>
                      </div>

                      <button type="submit" class="btn btn-primary me-2">Add Movie</button>
                    </form>
                  </div>
                </div>
              </div>
<script>
  function previewImage(input) {
  var file = input.files[0]; // Get the selected file
  var reader = new FileReader();
  
  // If a file is selected, show the preview image
  if (file) {
    reader.onload = function(e) {
      $("#preview").attr("src", e.target.result).show(); // Show and set the preview image
    };
    reader.readAsDataURL(file);
  } else {
    $("#preview").hide(); // Hide the preview if no file is selected
  }
}

</script>

@endsection