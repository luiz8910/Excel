<html>
<head>
    @include('admin.include.head')
</head>

<body>

<header>
    @include('admin.include.header')
</header>

<div id="wrapper">

    @include('admin.include.menu-lateral')

    <div class="container espacamento">
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

</div>
</body>
</html>