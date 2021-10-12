@extends('Probleme::categorie')

@section('categorie-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editare categorie</h4>
                    {!! Form::open(['class'=>'forms-sample', 'url'=>"categorie/$categorie->Denumire", 'method'=>$method]) !!}
                    <div class="form-group">
                        {!! Form::label('Denumire', 'Denumire'); !!}
                        {!! Form::text('Denumire', $categorie->Denumire, ['class'=>'form-control', 'placeholder'=>'Titlu']); !!}
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12">
                            {!! Form::label('keywords', 'Cuvinte cheie'); !!}
                            {!! Form::text('keywords', $kwords, ['class'=>'form-control', 'placeholder'=>'Keywords...']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="width: 100%;">
                            Descriere <br><br>
                            {!! Form::textarea('Descriere', $categorie->Descriere, ['class'=>'form-control summernote']) !!}
                        </label>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Posteaza', ['class'=>'btn btn-gradient-primary mr-2']) !!}
                        <a href="delete" class="col-md-1 btn btn-gradient-danger btn-fw" style="height:25%">Stergere</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
