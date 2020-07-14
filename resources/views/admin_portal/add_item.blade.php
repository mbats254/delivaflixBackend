

@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Item')])
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
                                <h3 class="mb-0">{{ __('Add Item Details') }}</h3>
                            </div>

                        </div>
                    <div class="card-body">
                            <form method='POST' action='{{ route('post.items') }}' enctype="multipart/form-data" id="movie_form">
                                    @csrf

                                <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Item Name') }}</label>
                                        <input type="text" name="item_name" placeholder="Item Name" id="imdbsrch" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                                    </div>

                                    <div class="form-group{{ $errors->has('application_form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Item Table') }}</label>
                                        <input type="text" name="item_table" placeholder="Item Table" id="imdbsrch" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus>
                                    </div>

                                <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> Genre Successfuly Added
                                </div>
                                <input type="submit" class="btn btn-success mt-4" value="Submit">

                                </form>
                                {{-- <button class="btn btn-success mt-4 add_field" id="this">Add Field</button> --}}
                             </div>

                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection







