@extends('includes.index')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert"> {{$error}} </div>
                            @endforeach
                        @endif
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="../../images/logo.svg">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            {!! Form::open(['url'=>'admin', 'method'=>'POST', 'class'=>'pt-3']) !!}
                                <div class="form-group">
                                    {!! Form::text('Username', '', ['class'=>'form-control form-control-lg', 'placeholder'=>'Username']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::password('Password', ['class'=>'form-control form-control-lg', 'placeholder'=>'Password']) !!}
                                </div>
                                <div class="mt-3">
                                    {!! Form::submit('SIGN IN', ['class' => 'btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn']) !!}
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            {!! Form::checkbox('logged-in', true, false, ['style'=>'form-check-input']) !!} Keep me signed in </label>
                                    </div>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="register" class="text-primary">Create</a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection
