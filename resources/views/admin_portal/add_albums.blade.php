

@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Albums')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add Album Details') }}</h3>
                            </div>

                        </div>
                    <div class="card-body">
                            <form method='POST' action='{{ route('post.albums') }}' enctype="multipart/form-data" id="album_form">
                                    @csrf
                                   <center> <strong>LastFM Search</strong> <br></center>
                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Album Name') }}</label>
                                        <input type="text" name="album_name" placeholder="Album Name" id="lastfmsrch" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Artist') }}</label>
                                            <input type="text" name="artist" id="lastfmartist" placeholder="Name of the Artist"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                        </div>

                                        <input type="button" class="btn btn-success mt-4" id="lastfmsubmit" value="Search">

                                        <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Raw Link') }}</label>
                                            <input type="text" name="artist" id="rawlink" placeholder="Raw Link to be Shortened"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                        </div>

                                        <input type="button" class="btn btn-success mt-4" id="rawlinksubmit" value="Shorten">
                            {{-- <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Dish Combination') }}</label><br/>
                                <select class="js-example-basic-multiple select2" name="dish_combination[]" multiple="multiple" required>

                                    @foreach($dish_combination as $dish => $values)
                                    <option value="{!! $values->id !!}">{!! $values->dish !!}</option>
                                  @endforeach
                                </select>

                                </div> --}}
                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ __('Updated Link') }}</label>
                                    <input type="text" name="updated_link" id="updatedlink" placeholder="Update Broken Link"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                </div>

                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ __('Product Code') }}</label>
                                    <input type="text" name="product_codelink" id="product_codelink" placeholder="product code of album to be updated"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                </div>

                                <input type="button" class="btn btn-success mt-4" id="updatedlinkbtn" value="Update">

                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Product Code') }}</label>
                                        <input type="text" name="product_codelink" id="product_codelink" placeholder="product code of album to be updated"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Album Name') }}</label>
                                        <input type="text" name="albumname" id="albumname" placeholder="Album Name"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Genre(s)') }}</label>
                                        <input type="text" name="albumgenre" id="albumgenre" placeholder=""  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Rating') }}</label>
                                        <input type="number" name="albumrating" id="albumrating" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Tracklist') }}</label>
                                        <textarea name="albumtracklist" id="albumtracklist" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus></textarea>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Album Artist') }}</label>
                                        <input type="text" name="albumartist" id="albumartist" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Year') }}</label>
                                        <input type="text" name="albumyear" id="albumyear" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Album Art') }}</label>
                                        <input type="text" name="albumart" id="albumart" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Album Size') }}</label>
                                        <input type="text" name="albumsize" id="albumsize" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Album Link') }}</label>
                                        <input type="text" name="dlink" id="dlink" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required  autofocus>
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
//link shortener
$('#rawlinksubmit').click(function(e){
         e.preventDefault();

     $('#rawlinksubmit').attr('value', 'loading...');
    var rawlink=$('#rawlink').val();
    var apitoken='b0a1168fc804e21808c04ebbd8e53e80';

     $.ajax({
        type:'PUT',
        datatype:'json',
        url:'https://api.shorte.st/v1/data/url',
        data:{'urlToShorten':rawlink},
        headers:{'public-api-token':apitoken},
        success:function(response){
                 //$('#shortlink').append(response
                  var d2=JSON.stringify(response);
                //if ($d2["status"]=="ok"){$shorturl=$d2["shortenedUrl"];}
                                             //alert(d2);

                                             var d3=JSON.parse(d2);
                                             $('#dlink').val(d3.shortenedUrl);
                                             },
                                             complete:function(){
                          $('#rawlinksubmit').attr('value', 'Shorten');

                          /**/
                         }
                                         });
                                       });


    //lastfm search
    var tagname,tagslength,trackname,trackslength,cover,artist,name,url,tags,tracks;

       $('#lastfmsubmit').click(function(e){
           e.preventDefault();

  $('#lastfmsubmit').attr('value', 'loading...');
        var album_search=$('#lastfmsrch').val();
        var artist_search=$('#lastfmartist').val();
        var apikey2='21c0e10fe172ad78dc59bb8427d86539';
      // alert(artist_search);

        $.ajax({
             type:'POST',
             url:'http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=' + apikey2 + '&artist='+ artist_search +'&album='+album_search+'&format=json',
             datatype:'json',
             success:function(data){
                var tagname=data.album.tags.tag;
                var tagslength=tagname.length;
                var trackname=data.album.tracks.track;
                var trackslength=trackname.length;
                var cover=data.album.image[2]['#text'];
                $('#albumart').val(cover);
                var artist=data.album.artist;
                $('#albumartist').val(artist);
                var name=data.album.name;
                $('#albumname').val(name);
                var url=data.album.url;
        /* var date=data.album.date;
         var date2=date.split(",");
         var realdate=date2[0];*/
         $.each(data, function(apikey2,album_search){
            $('#albumresults').append('<div class="w3-row"><b><a href="'+url+'">'+name +' -- '+ trackslength+ ' Tracks </a>- ' +artist+' <br><div class="art"><img src="'+cover+ '"/></div></b></div><br>');

          for(x=0;x<tagslength;x++){
              var tags=tagname[x]['name'];
              $('#albumgenre').val(tags);
          $('#albumresults').append('<p>,'+tags+'</p>');
          }

         for(i=0;i<trackslength;i++){

             var tracks=trackname[i]['name'];
              var trackarray=[];
              trackarray.push(tracks);


             $('#albumtracklist').val(trackarray);
             //track_array.push(tracks[i]['name']);
          $('#albumresults').append(','+ trackarray+' ');

         }

         });
     },

     complete:function(){
         $('#lastfmsubmit').attr('value', 'Search');

         /**/
        }
       });

});


//add to database
    $("#album_form").submit(function(){

           $.ajax({//get the form data
               url: $(this).attr('action'),
               type: $(this).attr('method'),
               data: new FormData(this),
                contentType: false,
               processData:false,
               cache: false,
               success: function(response){
                   //alert(response);
                     //update the div
                      $('.alert-success').fadeIn();
                   setTimeout(function() {
                       $('.alert-success').fadeOut("slow");
                   }, 4000 );
                   $('.reset').click();
               },
                 error: function (response){
                    // alert(response);
                  $('.alert-warning').fadeIn();
                   setTimeout(function() {
                       $('.alert-warning').fadeOut("slow");
                   }, 4000 );
                   $('.reset').click();

                 }
           });
           return false; //cancel on original event to prevent form submitting
       });
//update link
$('#updatedlinkbtn').click(function(e){
                        e.preventDefault();
                             $('#updatedlinkbtn').attr('value','loading...');

                             var updatedlink=$('#updatedlink').val();
                             var product_codelink=$('#product_codelink').val();
                                $.ajax({
                                    url:'/update/link/database',
                                    type:'POST',
                                    data: {updatedlink:updatedlink,product_codelink:product_codelink},
                                    success:function(response){

                                       $('#product_codelink').val('');
                                       $('#updatedlink').val('');
                                    },
                                    complete:function(response){
                                        $('#updatedlinkbtn').attr('value','Update');

                                    }
                                    });

                        });

});

</script>
        @include('layouts.footers.auth')
    </div>
@endsection







