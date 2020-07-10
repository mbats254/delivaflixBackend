

@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Series')])
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
                                <h3 class="mb-0">{{ __('Add Series Details') }}</h3>
                            </div>

                        </div>
                    <div class="card-body">
                            <form method='POST' action='{{ route('post.series') }}' enctype="multipart/form-data" id="movie_form">
                                    @csrf
                                   <center> <strong>TMDB Search</strong> <br></center>
                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Series Name') }}</label>
                                        <input type="text" name="series_name" placeholder="Series Name" id="imdbsrch" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                                    </div>
                                    <input type="button" class="btn btn-success mt-4" id="imdbsbmt" value="Search">
                                    <div id='searchitems' class="row">

                                    </div>

                                    <div id="tmplt" class="item hide col-md-2 ">
                                        <div class="w3l-movie-gride-agile select_movie w3l-movie-gride-agile1">
                                              <div id="" class="hvr-shutter-out-horizontal hide">
                                                   <div class="w3l-action-icon">
                                                    <i class="fa fa-play-circle " id="current_" aria-hidden="true"></i>
                                                  </div>
                                                </div>
                                                <div class="mid-1 agileits_w3layouts_mid_1_home"><img src="" title="album-name" class="movie-img img-responsive" alt="" />
                                                  <div class="w3l-movie-text">
                                                    <h6><a class="movie_name" href=""></a></h6>
                                                   <Strong><strong></strong></Strong> <p class="movie_id" name="">SeriesID:
                                                    </p>
                                                  </div>
                                                  <div class="mid-2 agile_mid_2_home"><p class='release_date'></p> <p class="plot hide"></p>
                                                    <div class="clearfix"></div></div>
                                                </div>
                                          </div>
                                    </div>



                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('IMDB ID') }}</label>
                                            <input type="text" name="imdb_id" id="Imdb_ID" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                        </div>

                                        <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Size') }}</label>
                                            <input type="number" name="size" id="size" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                        </div>


                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ __('Seasons Available') }}</label>
                                    <input type="number" name="season_available" id="season_available" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                </div>
                                <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> Series Successfuly Added
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
//TMDB Series Search
moviearr = [];
                 baseURL = 'https://api.themoviedb.org/3/';
                 baseImageURL = 'https://image.tmdb.org/t/p/';
                 APIKEY = '1b6741a859c40a4e6458e2936606c45b';
          $('#imdbsbmt').on('click', function(event){
                 event.preventDefault();

                 $('#imdbsbmt').attr('value', 'loading...');
                 searchstr = $('#imdbsrch').val();

                 $('#searchitems').empty();
                 $.getJSON(''+baseURL+'search/tv?api_key='+APIKEY+'&query='+searchstr, function(response){
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
                          release_date = first['first_air_date'];
                          title = first['original_name'];
                         imagestr = baseImageURL+'w154'+poster_path;
                         $('#tmplt').clone().appendTo('#searchitems');
                         $('#searchitems').find('.item:last-child').removeClass('hide').attr('id', 'itemno_'+idd);
                         $('#itemno_'+idd).find('.movie-img').attr('src', imagestr);
                         $('#itemno_'+idd).find('.movie-img').attr('title', plot);
                         $('#itemno_'+idd).find('.movie_name').text(title);
                         $('#itemno_'+idd).find('.release_date').text(release_date);
                        //  $('#itemno_'+idd).find('.plot').text(plot);
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







