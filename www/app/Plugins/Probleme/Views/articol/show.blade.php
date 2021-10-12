@extends('Probleme::articol')

@section('articol-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-9"><br><h4 class="card-title">Vezi problema curenta</h4></div>
                        <a href="{{$postare->slug}}/edit" class="col-md-1 btn btn-gradient-primary btn-fw" style="height:25%; margin-right:25px;">Editare</a>
                        <a href="{{$postare->slug}}/delete" class="col-md-1 btn btn-gradient-danger btn-fw" style="height:25%">Stergere</a>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-lg-3">
                            Titlu: {!! $postare->Titlu !!}
                        </div>
                        <div class="col-md-3 col-lg-3">
                            Categorie: {!! $postare->categorie->Denumire !!}
                        </div>
                        <div class="col-md-6 col-lg-6">
                            Cuvinte cheie: {!! $kwords !!}
                        </div>
                    </div>
                    <div class="form-group">
                        Continut: <br><br>
                        {!! $postare->Continut !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
