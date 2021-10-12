@extends('partials.navbar')

@section('search_bar')
    <div class="search-field d-none d-md-block">
        {!! Form::open(['url' => '#', 'method'=>'post', 'class'=>'d-flex align-items-center h-100']); !!}
        <div class="input-group">
            <div class="input-group-prepend bg-transparent"><i class="input-group-text border-0 mdi mdi-magnify"></i></div>
            {!! Form::text('search', '', [
                    'style'=>'padding-top:20px',
                    'class'=>'form-control bg-transparent border-0',
                    'placeholder'=>'Search projects'
                ]
            ); !!}
        </div>
        {!! Form::close(); !!}
    </div>
@endsection

@section('user')
    <?php
        $username = 'face1';
        $name = "David Greymaax";
        if(isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            $user = \App\Models\User::all()->where('auth_token', '=', $token)->first();
            if(isset($user)) {
                if(file_exists('../../images/faces/'.$user->Username))
                    $username = $user->Username;
                if(!empty($user->Nume) && !empty($user->Prenume))
                    $name = "$user->Nume $user->Prenume";
                else $name = $user->Username;
            }
        }
    ?>
    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
        <div class="nav-profile-img">
            <img src="../../images/faces/{{$username}}.jpg" alt="image">
            <span class="availability-status online"></span>
        </div>
        <div class="nav-profile-text">
            <p class="mb-1 text-black">{{$name}}</p>
        </div>
    </a>
    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
        <a class="dropdown-item" href="#">
            <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="admin/logout">
            <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
    </div>
@endsection
