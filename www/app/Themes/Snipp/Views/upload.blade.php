@extends("Theme::problem")

@section('options')
<p style="font-size:14pt">
    {!! Form::open(array('url' => "/probleme/$problemID/upload", 'files'=>true)) !!}
        Incarca solutie: {!! Form::file('solutie'); !!}
        <input type="submit" value="Incarca">
    {!! Form::close() !!}
</p>
@endsection