@extends('layouts.plantilla')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endsection

@section('title', 'Crear Premio')

@section('content')

    <main id='main-crear-premio'>
        <h2>Crear Premio</h2>
        
        <form method="POST" action="{{ route('crear-premio-post') }}" enctype="multipart/form-data" id='form-crear-premio'>
        @csrf    
        <div class="form-group">
                <label for="titulo">Título*</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>
            <!-- fecha -->
            <div class="form-group">
                <label for="fecha">Fecha*</label>
                <input type="date" class="form-control" name="fecha">
            </div>  
            <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea class="form-control" name="descripcion" rows="3" required></textarea>
            </div>
            <!-- url -->
            <div class="form-group">
                <label for="url">URL*</label>
                <input type="text" class="form-control" name="url">
            </div>
            <div class="form-group">
                <label for="imagen">Imagen*</label>
                <input type="file" class="form-control-file" name="imagen">
            </div>

            <button type="submit" class="btn btn-primary" required>Crear</button>
        </form>
            


    </main>


@endsection