@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>{{ $producto->name }}</h1>
        <p><strong>Categoría:</strong> {{ $producto->category->name }}</p>
        <p><strong>Descripción:</strong> {{ $producto->description }}</p>
        <p><strong>Precio:</strong> Q{{ $producto->price }}</p>

        <a href="{{ route('productos.index') }}" class="btn btn-primary">Volver a la lista de productos</a>
    </div>
@endsection
