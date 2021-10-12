@include("Theme::sections.header")

<section class="ftco-section bg-light" style="padding-top:25px; padding-bottom:96px;">
    <h1 class="text-center"><b>Probleme</b></h1>
    <div class="container">
        <div class="row">
            @foreach($probleme as $problem)
                @include("Theme::components.tile")
            @endforeach
        </div>
    </div>
</section>

@include("Theme::sections.footer")