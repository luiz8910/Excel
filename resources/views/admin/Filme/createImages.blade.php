@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Nova Imagem - {{ $filme->nome }}</h3>

            {!! Form::open(['route'=>['admin.filme.uploadImage', $filme->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::label("Nome", "Imagem do Filme:") !!}
                    {!! Form::file("img", null,
                    ["class" => "form-control"]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Upload', null, ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection