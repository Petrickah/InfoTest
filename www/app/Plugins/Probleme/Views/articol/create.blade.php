@extends('Probleme::articol')

@section('articol-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Adaugare problema noua</h4>
                    {!! Form::open(['class'=>'forms-sample', 'url'=>'problema', 'method'=>'POST', 'files'=>'true']) !!}
                    <div class="form-group">
                        {!! Form::label('Titlu', 'Titlu'); !!}
                        {!! Form::text('Titlu', '', ['class'=>'form-control', 'placeholder'=>'Titlu']); !!}
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-lg-4">
                            {!! Form::label('Categorie', 'Categorie'); !!}
                            {!! Form::text('Categorie', '', ['class'=>'form-control', 'placeholder'=>'Categorie']) !!}
                        </div>
                        <div class="col-md-4 col-lg-4">
                            {!! Form::label('keywords', 'Cuvinte cheie'); !!}
                            {!! Form::text('keywords', '', ['class'=>'form-control', 'placeholder'=>'Keywords...']) !!}
                        </div>
                        <div class="col-md-4 col-lg-4" style="margin-top:5px">
                            Fisiere Evaluator<br> {!! Form::file('evaluator'); !!}
                        </div>
                    </div>
                    <div class="form-group" style="padding-left:35%; padding-right:35%; margin-top:5px">
                            Thumbnail {!! Form::file('thumbnail') !!}
                    </div>
                    <div class="form-group">
                        <label style="width: 100%;">
                            Continut: <br><br>
                            {!! Form::textarea('Continut', '', ['class'=>'form-control summernote']) !!}
                        </label>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Posteaza', ['class'=>'btn btn-gradient-primary mr-2']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
