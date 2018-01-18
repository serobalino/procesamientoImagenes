@extends('plantilla')
@section('cuerpo')
    <div class="container">
        <div class="jumbotron">
            <h1>Resultado</h1>
            <p>Procesamiento de Imágenes.</p>
            <a class="btn btn-info" href="{{route('inicio')}}"> Otra imagen</a>
        </div>
        <br>
        <div class="col-md-12 text-center">
            <h3>Imagen original</h3>
            <img src="{{$imagenes['1']}}" alt="" class="img-responsive img-thumbnail center-block"/>
            <h3>Color remplazado</h3>
            <img src="{{$imagenes['2']}}" alt="" class="img-responsive img-thumbnail center-block"/>
            <h3>Montada</h3>
            <img src="{{$imagenes['3']}}" alt="" class="img-responsive img-thumbnail center-block"/>
        </div>
    </div>
@endsection