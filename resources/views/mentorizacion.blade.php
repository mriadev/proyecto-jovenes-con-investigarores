@extends('layouts.plantilla')

@section('title', 'Inicio')

@section('content')


<!-- formulario de contacto -->

<!-- Si no está logueado -->
<main id="main-mentorizacion">

@guest

<h3>¿Quieres ser mentor?</h3>
<h5>Si quieres ser mentor, rellena el siguiente formulario y nos pondremos en contacto contigo.</h5>
<form method="POST" action="{{ route('mentorizacion') }}">
    @csrf <!-- token para evitar ataques maliciosos a la web -->

    <div class="form-group">
        <label for="perfil">Entidad:</label>
        <select name="entidad" id="entidad" class="form-control">
            <option value="Instituto">Instituto</option>
            <option value="Universidad">Universidad</option>
            <option value="Empresa">Empresa</option>
        </select>
    </div>

    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="tel">Teléfono:</label>
        <input type="text" name="tel" id="tel" class="form-control">
    </div>

    <!-- twiter, instagram, linkedin -->

    <div class="form-group">
        <label for="mensaje">Mensaje:</label>
        <textarea name="mensaje" id="mensaje" class="form-control" rows="5"></textarea>
    </div>
    <br/>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<!-- si existe la variable mensaje -->

    @if (isset($mensaje))
    <div class="alert alert-success mt-3">
        {{ $mensaje }}
    </div>
    @endif


<!-- Si está logueado -->

@else

    if(session('perfil') == 'mentor')

    @enif


@endguest

</main>




@endsection