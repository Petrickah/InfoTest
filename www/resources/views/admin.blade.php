@extends('includes.control_panel')

@section('admin-section')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row col-md-12">
        @if(isset($errors) && !is_null($errors))
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert"> {{$error}} </div>
                @endforeach
            @endif
        @endif
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Comentarii primite <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{\App\Models\Comentariu::all()->count()}} Comentarii</h2>
                    <h6 class="card-text">Comentarii primite de la fani</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Probleme postate <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{\App\Models\Postare::all()->count()}} Postari</h2>
                    <h6 class="card-text">Probleme postate de utilizatori</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Keywords <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{\App\Models\Keyword::all()->count()}} Keywords</h2>
                    <h6 class="card-text">Cuvinte cheie adaugate</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title col-md-6">Probleme recente</h4>
                        <?php
                            $postari_per_page = 5;
                            $nr_pages = count(\App\Models\Postare::all())/$postari_per_page;
                            $articole = \App\Models\Postare::paginate($postari_per_page);
                        ?>
                        @if($nr_pages>1)
                            <?php
                                if(!key_exists('page', $_GET)) $_GET['page'] = 1;
                                $curr_page = (isset($_GET['page']))?($_GET['page']):1;
                            ?>
                            <nav class="col-md-6">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="admin?page=<?php echo ($curr_page==1)?$curr_page:$curr_page-1?>"><i class="mdi mdi-chevron-left"></i></a></li>
                                    @for($i = 1; $i <= $nr_pages; $i++)
                                        <li class="page-item {{$_GET['page']==$i?'active':''}}"><a class="page-link" href="admin?page={{$i}}">{{$i}}</a></li>
                                    @endfor
                                    <li class="page-item <?php echo ($curr_page>$nr_pages)?'active':''?>"><a class="page-link" href="admin?page=<?php echo ($curr_page==$nr_pages)?$curr_page:$curr_page+1?>"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Autor </th>
                                <th> Titlu </th>
                                <th> Categorie </th>
                                <th> Creat la </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($articole as $key=>$postare)
                                    <tr>
                                        <td>
                                            <img src="images/faces/{{strtolower(file_exists('images/faces/'.$postare->autor->Username)?$postare->autor->Username:"face1")}}.jpg" class="mr-2" alt="image"> {{$postare->autor->Username}} </td>
                                        <td> {{$postare->Titlu}} </td>
                                        <td>
                                            {{$postare->categorie->Denumire}}
                                        </td>
                                        <td>{{$postare->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 grid-margin">
            <div class="card" style="height:560px;">
                <div class="card-body p-0">
                    <div id="inline-datepicker" class="datepicker datepicker-custom">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Problema rapida</h4>
                    <p class="card-description">Adaugare rapida de probleme</p>
                    {!! Form::open(['class'=>'forms-sample', 'url'=>'problema', 'method'=>'POST']) !!}
                        <div class="form-group">
                            {!! Form::label('Titlu', 'Titlu'); !!}
                            {!! Form::text('Titlu', '', ['class'=>'form-control', 'placeholder'=>'Titlu']); !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Categorie', 'Categorie'); !!}
                            {!! Form::text('Categorie', '', ['class'=>'form-control', 'placeholder'=>'Categorie']) !!}
                        </div>
                        <div class="form-group">
                            <label style="width: 100%;">
                                Continut: <br><br>
                                {!! Form::textarea('Continut', '', ['class'=>'form-control summernote']) !!}
                            </label>
                        </div>
                        {!! Form::submit('Posteaza', ['class'=>'btn btn-gradient-primary mr-2']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
