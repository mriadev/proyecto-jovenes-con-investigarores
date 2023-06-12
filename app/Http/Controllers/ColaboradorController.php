<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Entidad;

class ColaboradorController extends Controller
{
    public function index(){
        $embajadores = User::where('id_colaborador', '2')->where('activo', '1')->get();
        $mentores = User::where('id_colaborador', '3')->where('activo', '1')->get();
        $institutos = Entidad::where('colaborador_id', '4')->where('activo', '1')->get();
        return view("panel-colaboradores")->with('embajadores', $embajadores)->with('mentores', $mentores)->with('institutos', $institutos);
    }
    
    public function colaboradores()
    {
        return view('admin/colaboradores');
    }

    public function gestionColaboradores()
    {
        return view('admin/gestion-colaboradores');
    }

    public function crearColaborador($id, $tipoColaborador) {

        $usuario = User::find($id);
        $usuario->id_colaborador = $tipoColaborador;
        $usuario->save();

        return redirect()->route('gestion-colaboradores');
    }

    public function eliminarColaboradorPost($id) {
        $usuario = User::find($id);
        $usuario->id_colaborador = null;
        $usuario->save();

        return redirect()->route('gestion-colaboradores');
    }
}