<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Video;
use App\Models\Revista;

class AdminController extends Controller
{
    public function gestionVideos(){
        $videos = Video::all();
        return view("admin.gestion-videos", compact("videos"));
    }
    
    public function editarVideos($id){
        $video = Video::find($id);
        return view("admin.editar-videos", compact("video"));
    }
    
    public function actualizarVideo(Request $request, $id){
        $video = Video::find($id);
        $video->titulo = $request->titulo;
        $video->descripcion = $request->descripcion;
        $video->url = $request->url;
        $video->save();
        return redirect()->route("gestion-videos");
    }
    
    public function gestionRevistas(){
        $revistas = Revista::all();
        return view("admin.gestion-revistas", compact("revistas"));
    }
    
    public function editarRevistas($id){
        $revista = Revista::find($id);
        return view("admin.editar-revistas", compact("revista"));
    }
    
    public function actualizarRevista(Request $request, $id){
        $revista = Revista::find($id);
        $revista->titulo = $request->titulo;
        $revista->descripcion = $request->descripcion;
        $revista->url = $request->url;
        $revista->save();
        return redirect()->route("gestion-revistas");
    }
    
    public function eliminarRevista($id){
        $revista = Revista::find($id);
        $revista->delete();
        return redirect()->route("gestion-revistas");
    }
    
    public function eliminarVideo($id){
        $video = Video::find($id);
        $video->delete();
        return redirect()->route("gestion-videos");
    }
    
    public function colaboradores(){
        return view("admin.colaboradores");
    }
    
    public function revistas(){
        return view("admin.revistas");
    }
    
    public function mentorizacion(){
        $showLoginButton = true;
        return view("mentorizacion", compact('showLoginButton'));
    }
}


?>

