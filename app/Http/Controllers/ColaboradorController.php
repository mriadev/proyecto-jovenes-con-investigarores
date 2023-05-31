<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;
use App\Models\User;

class ColaboradorController extends Controller
{
    public function index(){
        
        return view("panel-colaboradores");
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