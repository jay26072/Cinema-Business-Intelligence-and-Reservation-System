@if($movies->count() > 0)
    @foreach($movies as $movie)
        <div class="col-sm-6 col-lg-4">
            <div class="movie-grid">
                <div class="movie-thumb c-thumb">
                    <a href="{{ url('movie-details/'.$movie->id) }}">
                        <img src="{{ url('/image_upload/'.$movie->movie_image) }}" alt="movie">
                    </a>
                </div>
                <div class="movie-content bg-one">
                    <h5 class="title m-0">
                        <a href="{{ url('movie-details/'.$movie->id) }}">
                            {{ $movie->movie_name }}
                        </a>
                        <h6 class="content m-0 movie-duration"
                            data-minutes="{{ $movie->movie_duration }}"
                            style="font-size: 15px;">
                        </h6>
                    </h5>

                    <ul class="movie-rating-percent">
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('assets/images/tomato.png') }}">
                            </div>
                            <span class="content">88%</span>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('assets/images/cake.png') }}">
                            </div>
                            <span class="content">88%</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach

<div class="col-12 mt-4">
    {{ $movies->links('vendor.pagination.custom') }}
</div>
@else
    <div class="col-12 text-center">
        <h4 class="mt-3">🎬 No movies found</h4>
        <p class="mt-2 mb-3">Try adjusting your filters</p>
    </div>
@endif

<script>
    function fetchMovies(url = "{{ route('movies.filter') }}") {

    let languages = $('.lang-filter:checked').map(function () {
        return $(this).val();
    }).get();

    let experiences = $('.exp-filter:checked').map(function () {
        return $(this).val();
    }).get();

    let genres = $('.genre-filter:checked').map(function () {
        return $(this).val();
    }).get();

    // ✅ CHECK: if all filters empty → reset URL
    if (languages.length === 0 && experiences.length === 0 && genres.length === 0) {
        url = "{{ route('movies.filter') }}"; // default
    }

    $.ajax({
        url: url,
        type: "GET",
        data: {
            language: languages,
            experience: experiences,
            genre: genres
        },
        beforeSend: function () {
            $('#movie-loader').removeClass('d-none');
            $('#movie-list').hide();
        },
        success: function (response) {
            $('#movie-list').html(response);
            formatDurations(); // ✅ re-run
        },
        complete: function () {
            $('#movie-loader').addClass('d-none');
            $('#movie-list').show();
        }
    });
}
</script>