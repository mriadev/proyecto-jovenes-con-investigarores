<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Inscripción para formar parte de la Red FAB-IDI</h1>
<!-- si el tipoUsuario es usuario -->
  @if ($tipoUsuario == 'usuario')
  <h2> Inscripción como USUARIO</h2>
  @else
  <h2> Inscripción como ENTIDAD</h2>
  @endif
  <p> Datos del solicitante:</p>
  <ul>
    <li>Nombre: {{ $nombre }}</li>
  @if ($tipoUsuario == 'usuario')
    <li>Apellidos: {{ $apellidos }}</li>
    <li>Email: {{ $email }}</li>
    <li>Teléfono: {{ $telefono }}</li>
    <li>Redes sociales: 
        <ul>
            <li>Twitter: {{ $twitter }}</li>
            <li>Instagram: {{ $instagram }}</li>
            <li>Linkedin: {{ $linkedin }}</li>
        </ul>
    </li>
  @else
    <li>representante: {{ $representante }}</li>
    <li>Email: {{ $email }}</li>
    <li>Teléfono: {{ $telefono }}</li>
    <li>Web: {{ $web }}</li>
  @endif
    <li>Mensaje: {{ $mensaje }}</li>
  </ul>
</body>
</html>