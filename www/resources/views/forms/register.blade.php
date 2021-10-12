@extends ('includes.index')
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
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6><br>
                            {!! Form::open(['url'=> 'user', 'action' => 'post', 'style' => 'pt-3']) !!}
                                <div class="form-group">
                                    {!! Form::text('Username', '', [
                                            'class' => 'form-control form-control-lg',
                                            'placeholder'=>'Username'
                                    ]); !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::email('Email', '', [
                                            'class' => 'form-control form-control-lg',
                                            'placeholder'=>'Email'
                                    ]); !!}
                                </div>
                                <div class="form-group">
                                    <input type="password" name="Password" placeholder="Password" class="form-control form-control-lg">
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            {!! Form::checkbox('agreement', '', false, ['style'=>'form-check-input']) !!} I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    {!! Form::submit('SIGN UP', ['class' => 'btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn']) !!}
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login" class="text-primary">Login</a>
                                </div>
                            {{Form::close()}}
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
