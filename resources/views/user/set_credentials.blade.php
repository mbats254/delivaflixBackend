<html>
<head>
    <title>Set Credentials</title>
</head>
<body>



</body>
</html>



@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Set Credentials')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">



                                <form method='POST' action='{{ route('post.credentials') }}'>
                                    @csrf


                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('User Email') }}</label>
                                    <input type="email" name="name" value="{!! $user->email !!}" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" readonly autofocus>
                                    </div>

                                    <input type="hidden" name="uniqid" value="{!! $user->uniqid !!}">

                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ __('Password') }}</label>
                                <input type="password" name="password" placeholder="password" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                                </div>

                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ __('Confirm Password') }}</label>
                                <input type="password" name="confirm_password" placeholder="confirmation password" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                                </div>

                                <input type="submit" value="Submit">

                                </form>
                             </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
$(document).ready(function(){
   $('#image').on("change", function(){
     $('.should_appear').fadeIn();
   });
});

</script>
        @include('layouts.footers.auth')
    </div>
@endsection






