@extends('theaterpanel.master')
@section('content')

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Movies</h3a>
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
                    <th>Movie Poster</th>
                    <th>Movie Name</th>
                    <th>Duration</th>
                    <th>Language</th>
                    <th>Release Date</th>
                    <th>Trailer</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($movies as $movie)
                    <tr>
                      <td>{{$movie->id}}</td>
                      <td><img src="{{url('/image_upload/'.$movie->movie_image)}}" style="width:100px;height:100px"></td>
                      <td>{{$movie->movie_name}}</td>
                      <td class="movie-duration" data-minutes="{{ $movie->movie_duration }}"></td>
                      <td>{{$movie->language}}</td>
                      <td>{{$movie->release_date}}</td>
                      <td><button type="button" class="btn btn-primary" onclick="openTrailer('{{ $movie->movie_trailer }}')">Preview</button></td>
                      <td><a href="{{url('/editmovie/'.$movie->id)}}" class="btn btn-primary">Update</a></td>
                      <td><a href="{{url('/deletemovie/'.$movie->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- popup -->
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
                                    height="600"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                            </iframe>
                          </div>

                        </div>
                      </div>
                    </div>

                <!-- /popup -->
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

<script>
  function convertMinutesToHours(minutes) {
    const h = Math.floor(minutes / 60);
    const m = minutes % 60;

    return (h ? h + "h " : "") + m + " H";
  }

  document.querySelectorAll('.movie-duration').forEach(td => {
    const minutes = parseInt(td.dataset.minutes, 10);
    td.textContent = convertMinutesToHours(minutes);
  });
</script>

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