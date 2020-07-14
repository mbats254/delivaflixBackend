

@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Games')])
    <style>
            .alert-success{
                display: none;
                background-color: rgba(0,250,0,0.7)
            }
        </style>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add Games Details') }}</h3>
                            </div>

                        </div>
                    <div class="card-body">
                            <form method='POST' action='{{ route('post.games') }}' enctype="multipart/form-data" id="movie_form">
                                    @csrf

                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Game Name') }}</label>
                                        <input type="text" name="title" placeholder="Game Name" id="imdbsrch" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Game Genre') }}</label>
                                       <select class="form-control" name="genre">
                                        @foreach($genres as $genre => $values)
                                        <option>{!! $values !!}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Rating') }}</label>
                                            <input type="number" max="10" min="0" name="rating" id="rating" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                        </div>

                                        <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Poster') }}</label>
                                            <input type="file" name="poster" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required accept=".gif,.jpg,.png,.JPEG" autofocus>
                                        </div>

                                        <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Publisher') }}</label>
                                            <input type="text" name="publisher" id="publisher" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                        </div>

                                        <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Year') }}</label>
                                            <input type="text" name="year" id="year" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                        </div>
                                        <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Requirements') }}</label>
                                            <textarea name="requirements" id="requirements" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus></textarea>
                                        </div>
                                        <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Size') }}</label>
                                            <input type="number" name="size" placeholder="Size in Mbs" id="size" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus></input>
                                        </div>
                                        <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Price') }}</label>
                                            <input type="number" name="price"  id="size" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus></input>
                                        </div>

                                <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> Game Added Successfully
                                </div>
                                <input type="submit" class="btn btn-success mt-4" value="Submit">

                                </form>
                                {{-- <button class="btn btn-success mt-4 add_field" id="this">Add Field</button> --}}
                             </div>

                </div>
            </div>
        </div>
<script type="text/javascript">
$(document).ready(function(){
//TMDB Movie Search
moviearr = [];
                 baseURL = 'https://api.themoviedb.org/3/';
                 baseImageURL = 'https://image.tmdb.org/t/p/';
                 APIKEY = '1b6741a859c40a4e6458e2936606c45b';
          $('#imdbsbmt').on('click', function(event){
                 event.preventDefault();

                 $('#imdbsbmt').attr('value', 'loading...');
                 searchstr = $('#imdbsrch').val();

                 $('#searchitems').empty();
                 $.getJSON(''+baseURL+'search/movie?api_key='+APIKEY+'&query='+searchstr, function(response){
                 $('#imdbsbmt').attr('value', 'search');
                //    $('#output').html(JSON.stringify(response));
                    len = response.results.length;

                    if (len == 0) {
                      $('#searchitems').append('<p>No matches were found<p>')
                    }
                    loops = Math.ceil(len/6);  //round off upwards
                    current = 0; //keep track of the current item being printed
                    for(p=0; p < loops; p++){
                      $('#searchitems').append('<div class="row">');
                      for(i=0; i < 6; i++){
                        if (current > len) {
                          break;
                        }
                          first = response.results[current];
                          //vote_count = first['vote_count'];
                          idd = first['id'];
                          moviearr.push(idd);
                         // vote_average = first['vote_average'];
                          poster_path = first['poster_path'];
                          backdrop_path = first['backdrop_path'];
                          plot = first['overview'];
                        //   alert(plot)
                          release_date = first['release_date'];
                          title = first['title'];
                         imagestr = baseImageURL+'w154'+poster_path;
                         $('#tmplt').clone().appendTo('#searchitems');
                         $('#searchitems').find('.item:last-child').removeClass('hide').attr('id', 'itemno_'+idd);
                         $('#itemno_'+idd).find('.movie-img').attr('src', imagestr);
                        //  $('#itemno_'+idd).find('.movie-img').attr('title', plot);
                         $('#itemno_'+idd).find('.movie_name').text(title);
                         $('#itemno_'+idd).find('.release_date').text(release_date);
                         $('#itemno_'+idd).find('.plot').text(plot);
                         $('#itemno_'+idd).find('.select_movie').attr('id', 'btn_'+current);
                         $('#itemno_'+idd).find('.movie_id').append(idd);
                        current++;
                      }
                      $('#searchitems').append('</div>');
                  }
            });
        });
        $("#submitmv").click(function(event){//get the form data
//        event.preventDefault();
        //var formValues = $('#movie_form').serialize();
        var Imdb_ID = $('[name = Imdb_ID]').val();
        var movie_size = $('[name = movie_size]').val();
        var movie_quality = $('[name = movie_quality]').val();
        url = '/post/movies/';
        $("#submitmv").attr('value', 'Loading...');
        if(Imdb_ID){
        $.get(url, {imdb: Imdb_ID, size : movie_size, quality : movie_quality},
            function(response){
                $("#submitmv").attr('value', 'Post Movie');
                  //update the div
                  if(response == 0){
                    $('#mverror').html('<strong>Already Exists</strong>');
                    $('#mverror').fadeIn();
                    setTimeout(function(){
                        $('#mverror').fadeOut('slow')},10000
                    );
                  }
                  else if (response == 1){
                    $('#searchitems').empty();
                      $('.alert-success').fadeIn();
				    setTimeout(function() {
					$('.alert-success').fadeOut("slow");
				}, 4000 );
                $('.reset').click();
                      //alert(response);
                  }
                  else{

                      $('#mverror').html('<strong>Something went wrong</strong>');
                      $('#mverror').fadeIn();
                    setTimeout(function(){
                        $('#mverror').fadeOut('slow')},10000
                    );

                  }


                }
        );}else{
            $('#mverror').html('<strong>Empty values</strong>');
                    $('#mverror').fadeIn();
                     $("#submitmv").attr('value', 'Post Movie');
                     setTimeout(function(){
                        $('#mverror').fadeOut('slow')},5000
                    );
        }
        return false; //cancel on original event to prevent form submitting
    });
});

</script>
        @include('layouts.footers.auth')
    </div>
@endsection







