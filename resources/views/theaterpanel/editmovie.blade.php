@extends('theaterpanel.master')
@section('content')
  <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Movie Form</h4>
                    <hr>
                    <div class="">
                      @if(session('status'))
                        <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                    </div>
                    
                    <form class="forms-sample " method="POST" action="{{url('/updatemovie/'.$movie->id)}}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')

                      <img src="{{url('/image_upload/'.$movie->movie_image)}}" max-width="200px" style="max-width: 200px;"/>
                      
                      <img id="preview" src="#" alt="preview" style="max-width: 200px; display: none;"/>

                      <div class="form-group">
                        <button type="button" class="btn btn-danger" onclick="openTrailer('{{ $movie->movie_trailer }}')" style="margin-top: 10px;">
                        ▶ Preview Trailer
                      </button>
                      </div>

                     <div class="form-group">
                        <label for="img">Movie Image</label>
                        <input type="file" class="form-control" id="img" name="movie_img" onchange="previewImage(this)">
                        <h6 style="color:red">@error('movie_image'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_name">Movie Name</label>
                        <input type="text" class="form-control" id="movie_name" placeholder="Enter Movie Name" name="movie_name" value="{{$movie->movie_name}}">
                        <h6 style="color:red">@error('movie_name'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_desc">Movie Description</label>
                        <input type="text" class="form-control" id="movie_desc" placeholder="Enter Movie Name" name="movie_description" value="{{$movie->movie_description}}">
                        <h6 style="color:red">@error('movie_description'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_type">Movie Type</label><br>
                        @foreach($movietypes as $movietype)
                            <input type="checkbox" name="movie_type[]"
                                value="{{$movietype->id}}"
                                {{ in_array($movietype->id, $movie->movie_type ?? []) ? 'checked' : '' }}>
                            <label>{{$movietype->movie_type}}</label><br>
                            @endforeach

                        <br>
                        
                      </div>

                      <div class="form-group">
                        <label for="movie_duration">Movie Duration</label>
                        <input type="text" class="form-control" id="movie_duration" placeholder="Enter Movie Duration" name="movie_duration" value="{{$movie->movie_duration}}">
                        <h6 style="color:red">@error('movie_duration'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">

                      @php
                        $languages = ["English","Hindi","Gujarati","Tamil","Kannada"];
                        @endphp
                        <label for="movie_language">Select Language</label>
                        <br>
                       @foreach($languages as $lang)
                            <input type="checkbox" name="movie_language[]"
                                value="{{$lang}}"
                                {{ in_array($lang, $movie->language ?? []) ? 'checked' : '' }}>
                            <label>{{$lang}}</label><br>
                        @endforeach
                        <h6 style="color:red">@error('movie_language'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="screen_type">Screen Type</label>
                        <br>
                       @foreach($screenexp as $screen)
                            <input type="checkbox" name="screen_type[]"
                                value="{{$screen->id}}"
                                {{ in_array($screen->id, $movie->screen_type ?? []) ? 'checked' : '' }}>
                            <label>{{$screen->screen_type}}</label><br>
                       @endforeach

                        <h6 style="color:red">@error('screen_type'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_release">Movie Release Date</label>
                        <input type="date" class="form-control" id="movie_release" name="release_date" value="{{$movie->release_date}}">
                        <h6 style="color:red">@error('release_date'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_trailer">Movie Trailer</label>
                        <input type="text" class="form-control" id="movie_trailer" placeholder="Enter Movie Trailer Link" name="movie_trailer" value="{{$movie->movie_trailer}}">
                        <h6 style="color:red">@error('movie_trailer'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="trailer_release">Movie Trailer Release Date</label>
                        <input type="date" class="form-control" id="trailer_release" name="movie_trailer_date" value="{{$movie->movie_trailer_date}}">
                        <h6 style="color:red">@error('movie_trailer_date'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_cast">Movie Cast</label>
                        <br>
                        @foreach($actors as $actor)
                            <input type="checkbox" name="movie_cast[]"
                                value="{{$actor->id}}"
                                {{ in_array($actor->id, $movie->movie_cast ?? []) ? 'checked' : '' }}>
                            <label>{{$actor->castname}}</label><br>
                            @endforeach

                        <h6 style="color:red">@error('movie_cast'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="movie_crew">Movie Crew</label>
                        <br>
                        @foreach($crew as $member)
                            <input type="checkbox" name="movie_crew[]"
                                value="{{$member->id}}"
                                {{ in_array($member->id, $movie->movie_crew ?? []) ? 'checked' : '' }}>
                            <label>{{$member->crewname}} [{{$member->type}}]</label><br>
                            @endforeach

                        <h6 style="color:red">@error('movie_cast'){{$message}}@enderror</h6>

                        <div class="modal fade" id="trailerModal" tabindex="-1">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">

                              <div class="modal-header">
                                <h5 class="modal-title">Movie Trailer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <div class="modal-body text-center">
                                <iframe id="trailerFrame"
                                        width="100%"
                                        height="400"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                </iframe>
                              </div>

                            </div>
                          </div>
                        </div>

                      </div>

                      <button type="submit" class="btn btn-warning me-2">Update Movie</button>
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

<script>
function openTrailer(url) {
    let videoId = url.match(
        /(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/
    );

    if (videoId && videoId[1]) {
        let embedUrl = "https://www.youtube.com/embed/" + videoId[1] + "?autoplay=1";
        document.getElementById('trailerFrame').src = embedUrl;

        let modal = new bootstrap.Modal(document.getElementById('trailerModal'));
        modal.show();
    } else {
        alert("Invalid YouTube URL");
    }
}

// STOP video when modal closes
document.getElementById('trailerModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('trailerFrame').src = "";
});
</script>


@endsection