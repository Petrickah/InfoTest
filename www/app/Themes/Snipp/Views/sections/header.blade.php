@section("header")
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{$title}}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{App\Themes\Snipp\Snipp::print_styles()}}
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" style="top:0; padding-top:15px">
            <div class="container">
                <a class="navbar-brand" href="/">{{$title}}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>

                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                        <li class="nav-item dropdown">
                            <a href="/admin" class="nav-link dropdown-toggle">User Page</a>
                            <div class="dropdown-menu">
                                <a href="/admin" class="dropdown-item">Admin</a>
                                <a href="/admin/login" class="dropdown-item">Login</a>
                                <a href="/admin/register" class="dropdown-item">Register</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav -->
        <div class="hero-wrap" style="height: 80px">
            <div class="overlay" style="height: 80px"></div>
        </div>
@show