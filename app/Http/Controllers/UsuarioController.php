<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Entidad;
use App\Models\Perfil;
use App\Models\Colaborador;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;





class UsuarioController extends Controller
{

    public function eventos()
    {
        return view("eventos");
    }

    public function proyectosIntercentros()
    {
        $proyectosIntercentros = Proyecto::join('tipos_proyectos', 'proyectos.tipo_proyecto_id', '=', 'tipos_proyectos.id')
            ->where('tipos_proyectos.tipos_proyectos', '=', 'Proyecto Intercentros')
            ->where('proyectos.activo', '=', '1')
            ->get();
        return view("proyectos-intercentros", compact('proyectosIntercentros'));
    }

    public function mentorizacion()
    {
        // proyectos activos donde tipo_proyecto_id sea el id de tipo_proyecto Proyecto PIP y el proyecto esté desactivado
        $proyectosDestacados = Proyecto::join('tipos_proyectos', 'proyectos.tipo_proyecto_id', '=', 'tipos_proyectos.id')
            ->where('tipos_proyectos.tipos_proyectos', '=', 'Proyecto PIP')
            ->where('proyectos.activo', '=', '1')
            ->where('proyectos.destacado', '=', '1')
            ->get();

        $proyectosDisponibles = Proyecto::join('tipos_proyectos', 'proyectos.tipo_proyecto_id', '=', 'tipos_proyectos.id')
            ->where('tipos_proyectos.tipos_proyectos', '=', 'Proyecto PIP')
            ->where('proyectos.activo', '=', '1')
            ->where('proyectos.destacado', '=', '0')
            ->where('proyectos.disponible', '=', '1')
            ->get();
        
        return view("mentorizacion", compact('proyectosDestacados', 'proyectosDisponibles'));

    }

    public function mentorizacionPost(Request $request)
    {
        // si es MENTOR selcciona el proyecto a mentorizar
        if(auth()->user() && (Auth::user()::join('perfiles', 'users.perfil_id', '=', 'perfiles.id')->where('perfiles.perfil','mentor')
        || Auth::user()::join('colaboradores', 'users.id_colaborador', '=', 'colaboradores.id')->where('colaboradores.colaborador','mentor'))){
            // obtener proyecto por el nombre
            $proyecto = Proyecto::where('nombre', '=', $request->input('proyecto'))->first();
            // Si no ha seleccionado un proyecto
            if ($proyecto == null) {
                return redirect()->route('mentorizacion')->with('error', 'Debes seleccionar un proyecto');
            }
            $data = array(
                'nombreCompleto' => $request->input('nombre-completo'),
                'email' => $request->input('email'),
                'proyecto' => $request->input('proyecto')
            );
            try {
                Mail::send('emails.inscripcion-proyecto', $data, function($message) use ($data){ 
                $message->from($data['email'], $data['nombreCompleto']);
                $message->to('maria14998@gmail.com')
                ->subject('Inscripción para Mentorizar Proyecto');
                });
            } catch (\Swift_TransportException $e) {
                return redirect()->route('mentorizacion')->with('error', 'No se ha podido enviar el correo');
            }

            return redirect()->route('mentorizacion')->with('success', 'Correo enviado correctamente');
                


        }else{
            // si es USUARIO rellena el formulario con sus datos
            if ($tipoUsuario == 'usuario') {
            $data = array(
                'tipoUsuario' => $tipoUsuario,
                'nombre' => $request->input('nombre-usuario'),
                'apellidos' => $request->input('apellidos-usuario'),
                'email' => $request->input('email-usuario'),
                'telefono' => $request->input('telefono-usuario'),
                'twitter' => $request->input('twitter-usuario'),
                'instagram' => $request->input('instagram-usuario'),
                'linkedin' => $request->input('linkedin-usuario'),
                'mensaje' => $request->input('mensaje-usuario')
                
            );
            try {
                Mail::send('emails.inscripcion-mentor', $data, function($message) use ($data){ 
                $message->from($data['email'], $data['nombre'].' '.$data['apellidos']);
                $message->to('maria14998@gmail.com')
                ->subject('Inscripción a red FAB-IDI');
                });
                } catch (\Swift_TransportException $e) {
                    $enviado = false;
                    return view("quienes-somos", compact('enviado'));
                }
        }else{
            // si es ENTIDAD rellena el formulario con sus datos
            $data = array(
                'tipoUsuario' => $tipoUsuario,
                'nombre' => $request->input('nombre-entidad'),
                'representante' => $request->input('representante-entidad'),
                'email' => $request->input('email-entidad'),
                'telefono' => $request->input('telefono-entidad'),
                'web' => $request->input('web-entidad'),
                'mensaje' => $request->input('mensaje-entidad')
            );

            try {
                Mail::send('emails.inscripcion-mentor', $data, function($message) use ($data){ 
                $message->from($data['email'], $data['nombre']);
                $message->to('maria14998@gmail.com')
                ->subject('Inscripción a red FAB-IDI');
                });
            } catch (\Swift_TransportException $e) {
                $enviado = false;
                return redirect()->route('quienes-somos', compact('enviado'));
            }
            

        }
        $enviado = true;
        return view("quienes-somos", compact('enviado'));

        }
        return redirect()->route('mentorizacion');
    }

    public function revistas()
    {
        return view("revistas");
    }

    public function quienesSomos()
    {
        return view("quienes-somos");
    }

    public function quienesSomosPost(Request $request){
        // si el tipo de usuario es usuario
        $tipoUsuario = $request->input('tipoUsuario');

        if ($tipoUsuario == 'usuario') {
            $data = array(
                'tipoUsuario' => $tipoUsuario,
                'nombre' => $request->input('nombre-usuario'),
                'apellidos' => $request->input('apellidos-usuario'),
                'email' => $request->input('email-usuario'),
                'telefono' => $request->input('telefono-usuario'),
                'twitter' => $request->input('twitter-usuario'),
                'instagram' => $request->input('instagram-usuario'),
                'linkedin' => $request->input('linkedin-usuario'),
                'mensaje' => $request->input('mensaje-usuario')
                
            );
            try {
                Mail::send('emails.inscripcion-red-fab-idi', $data, function($message) use ($data){ 
                $message->from($data['email'], $data['nombre'].' '.$data['apellidos']);
                $message->to('maria14998@gmail.com')
                ->subject('Inscripción a red FAB-IDI');
                });
                } catch (\Swift_TransportException $e) {
                    $enviado = false;
                    return view("quienes-somos", compact('enviado'));
                }
        }else{
           
            $data = array(
                'tipoUsuario' => $tipoUsuario,
                'nombre' => $request->input('nombre-entidad'),
                'representante' => $request->input('representante-entidad'),
                'email' => $request->input('email-entidad'),
                'telefono' => $request->input('telefono-entidad'),
                'web' => $request->input('web-entidad'),
                'mensaje' => $request->input('mensaje-entidad')
            );

            try {
                Mail::send('emails.inscripcion-red-fab-idi', $data, function($message) use ($data){ 
                $message->from($data['email'], $data['nombre']);
                $message->to('maria14998@gmail.com')
                ->subject('Inscripción a red FAB-IDI');
                });
            } catch (\Swift_TransportException $e) {
                $enviado = false;
                return view("quienes-somos", compact('enviado'));
            }
            

        }
        $enviado = true;
        return view("quienes-somos", compact('enviado'));
        return redirect()->view('quienes-somos');
        
    }
    public function guardarCambiosUsuario()
    {

        $user = User::find($_POST['id-usuario']);
        $user->nombre = $_POST['nombre-usuario'];
        $user->apellidos = $_POST['apellidos-usuario'];
        $user->email = $_POST['email-usuario'];
        $user->telefono = $_POST['telefono-usuario'];
        $user->twitter = $_POST['twitter-usuario'];
        $user->instagram = $_POST['instagram-usuario'];
        $user->linkedin = $_POST['linkedin-usuario'];
        $user->perfil_id = $_POST['select-perfil-usuario'];
        $user->save();

        return redirect()->route('gestion-usuarios');
    }

    public function editarUsuario($id)
    {
        $usuario = User::find($id);

        return view('admin/editar-usuario', compact('usuario'));
    }

    public function eliminarUsuario($id)
    {
        $usuario = User::find($id);
        $usuario->activo = 0;
        $usuario->save();

        return view('admin/gestion-usuarios');
    }

    public function obtenerPerfilesAjax()
    {
        $perfiles = Perfil::all();
        return response()->json($perfiles);
    }

    public function obtenerColaboradoresAjax()
    {
        $colaboradores = Colaborador::all();
        return response()->json($colaboradores);
    }

    public function obtenerUsuariosAjax(Request $request)
    {
        $query = $request->get('query');
        $usuarios = User::where('nombre', 'LIKE', '%' . $query . '%')->get();
        return response()->json($usuarios);
    }

    public function crearUsuarioPost(Request $request)
    {

        $tipoUsuario = $request->input('select-tipo-usuario');

        if ($tipoUsuario == "usuario") {
            $usuario = User::create([
                'nombre' => $request->input('nombre-usuario'),
                'apellidos' => $request->input('apellidos-usuario'),
                'email' => $request->input('email-usuario'),
                'password' => $request->input('password-usuario'),
                'perfil_id' => 1,
                'activo' => 1,
                'telefono' => $request->input('telefono-usuario'),
                'twitter' => $request->input('twitter-usuario'),
                'instagram' => $request->input('instagram-usuario'),
                'linkedin' => $request->input('linkedin-usuario'),
            ]);

            $usuario->save();

            //Falta foto
        } else {
            $entidad = Entidad::create([
                'nombre' => $request->input('nombre-entidad'),
                'representante' => $request->input('representante-entidad'),
                'email' => $request->input('email-entidad'),
                'telefono' => $request->input('telefono-entidad'),
                'web' => $request->input('web-entidad'),
                'imagen' => $request->input('imagen-entidad'),
                'activo' => 1,
            ]);
        }




        return view("admin/gestion-usuarios");
    }

    public function crearUsuario()
    {
        return view("admin/crear-usuario");
    }

    public function index()
    {

        return view("admin/gestion-usuarios");
    }
}