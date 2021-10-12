<div class="col-md-4 ftco-animate fadeInUp ftco-animated">
    <div class="blog-entry">
        <a href="{{$problem['page']??'#'}}" class="block-20" style="background-image: url({!!$problem['image']??"/themes/images/image_1.jpg"!!}"></a>
        <div class="text p-4 d-block">
            <div class="meta mb-3">
                <div><a href="#">{!! $problem['date']??"July 12, 2018" !!}</a></div>
                <div><a href="#">{!! $problem['author']??"Admin" !!}</a></div>
            </div>
            <h3 class="heading">
                <a href="{{$problem['page']??'#'}}">
                    {!! $problem['description']??"Even the all-powerful Pointing has no control about the blind texts" !!}
                </a>
            </h3>
        </div>
    </div>
</div>