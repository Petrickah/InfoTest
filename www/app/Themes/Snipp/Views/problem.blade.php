@include("Theme::sections.header")
@section('content')
    <section class="ftco-section" style="margin-top:80px; padding-top:0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate fadeInUp" style="margin: 20px auto 0 auto">
                    <p style="padding: 0 10% 0 10%; ">
                        <?php
                            use App\Plugins\Probleme\Models\Probleme;
                            $problema = Probleme::all()->where("nume", "=", $problemID)->first();
                            $postare = $problema->postare;
                            $imageUrl = substr($problema->thumbnail, strlen("/var/www/html/public"), strlen($problema->thumbnail));
                        ?>
                        <a href="#" class="block-20" style="background-image: url('../..<?php echo !is_null($imageUrl)?$imageUrl:'/images/image.jpg'; ?>');"></a>
                    </p>
                    <h2 class="mb-3">#1. Problema: {{$postare->Titlu}}</h2>
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert"> {{$error}} </div>
                        @endforeach
                    @endif
                    @yield('options')
                    {!!$postare->Continut!!}
                    <p>
                        <a href="/probleme/{{$problemID}}/score" class="btn btn-primary py-3 px-5">Vezi punctaj</a>
                        <a href="/probleme/{{$problemID}}/upload" class="btn btn-primary btn-outline-primary py-3 px-5">Incarca solutia</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@show
@include("Theme::sections.footer")