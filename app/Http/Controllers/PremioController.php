<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use Illuminate\Http\Request;

class PremioController extends Controller
{
    public function obtenerPremiosAjax()
    {
        $premios = Premio::all();
        return response()->json($premios);
    }

    public function destacarPremio(Request $request)
    {
        $premio = Premio::find($request->id);
        //poner destacado a true
        $premio->destacado = true;
        $premio->save();
        return redirect()->route('gestion-premios')->with('success', 'El premio se ha destacado correctamente.');
    }

    public function quitarPremioDestacado(Request $request)
    {
        $premio = Premio::find($request->id);
        //poner destacado a false
        $premio->destacado = false;
        $premio->save();
        return redirect()->route('gestion-premios')->with('success', 'El premio se ha quitado de destacados correctamente.');
    }

    public function crearPremio(Request $request)
    {
        return view('admin.crear-premio');
    }

    public function eliminarPremio(Request $request)
    {
        $premio = Premio::find($request->id);
        //poner activo a false
        $premio->delete();
        return redirect()->route('gestion-premios')->with('success', 'El premio se ha eliminado correctamente.');
    }

    // public function actualizarPremio(Request $request)
    // {
    //     $premio = Premio::find($request->id);

    //     $nombre = $request->input('nombre');
    //     $url = $request->input('url');

    //     // Verificar si la URL es válida
    //     $url_pattern = '/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+/';
    //     if (!preg_match($url_pattern, $url)) {
    //         return redirect()->back()->with('error', 'La URL del Premio es inválida.');
    //     }

    //     // Actualizar los datos del Premio
    //     $premio->nombre = $nombre;
    //     $premio->url = $url;
    //     $premio->save();

    //     return redirect()->route('gestion-premios')->with('success', 'El premio se ha actualizado correctamente.');
    // }


    // public function editarPremios($id)
    // {
    //     //Busca el Premio con el id que se le pasa por parámetro
    //     $Premio = Premio::find($id);

    //     //Pasa el Premio a la vista
    //     return view('admin/editar-premios')->with('premios', $premio);
    // }


    public function gestionPremios()
    {
        $premio = Premio::all();
        return view('admin/gestion-premios')->with('premios', $premio);
    }
}

?>