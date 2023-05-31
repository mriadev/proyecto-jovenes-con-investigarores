<nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Twelfth navbar example">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
          <ul class="navbar-nav">
           
        <li class="{{ Request::is('/') ? 'active' : '' }}">
            <a href="{{ URL::to('/') }}">Inicio</a>
        </li>

        @auth
            @if (session('perfil') == 'admin')
                <li class="{{ Route::is('gestion-videos*') ? 'active' : '' }}">
                    <a href="{{ route('gestion-videos') }}">Gestión de vídeos</a>
                </li>
                <li class="{{ Route::is('gestion-premios*') ? 'active' : '' }}">
                    <a href="{{ route('gestion-premios') }}">Gestión de premios</a>
                </li>
            @endif
        @endauth

        <li class="{{ Route::is('quienes-somos') ? 'active' : '' }}">
            <a href="{{ route('quienes-somos') }}">Quiénes somos</a>
        </li>

        <li class="{{ Route::is('https://jovenesconinvestigadores.wordpress.com/') ? 'active' : '' }}">
            <a href="https://jovenesconinvestigadores.wordpress.com/">Jóvenes
                con Investigadores</a>
        </li>

        <li class="{{ Route::is('mentorizacion') ? 'active' : '' }}">
            <a href="{{ route('mentorizacion') }}">Mentorizacion</a>
        </li>

        <li class="{{ Route::is('proyectos-intercentros') ? 'active' : '' }}">
            <a href="{{ route('proyectos-intercentros') }}">Proyectos Intercentros</a>
        </li>

        <li class="{{ Route::is('panel-colaboradores') ? 'active' : '' }}">
            <a href="{{ route('panel-colaboradores') }}">Panel de colaboradores</a>
        </li>

        @auth
            @if (session('perfil') == 'admin')
                <li class="{{ Route::is('gestion-colaboradores') ? 'active' : '' }}">
                    <a href="{{ route('gestion-colaboradores') }}">Gestión de colaboradores</a>
                </li>
            @endif
        @endauth

        <li class="{{ Route::is('eventos') ? 'active' : '' }}">
            <a href="{{ route('eventos') }}">Eventos</a>
        </li>

        <li class="{{ Route::is('revistas') ? 'active' : '' }}">
            <a href="{{ route('revistas') }}">Revistas</a>
        </li>

        @if (session('perfil') == 'admin')
            <li class="{{ Route::is('gestion-videos*') ? 'active' : '' }}">
                <a href="{{ route('gestion-videos') }}">Gestión de revistas</a>
            </li>
        @endif

        <li class="{{ Request::url() === 'https://profundizaiesmartinrivero.blogspot.com/' ? 'active' : '' }}">
            <a href="https://profundizaiesmartinrivero.blogspot.com/">Blog</a>
        </li>

        @if (session('perfil') == 'admin')
            <li class="{{ Route::is('gestion-usuarios*') ? 'active' : '' }}">
                <a href="{{ route('gestion-usuarios') }}">Gestión de usuarios</a>
            </li>
        @endif
          </ul>
        </div>
      </div>
    </nav>

