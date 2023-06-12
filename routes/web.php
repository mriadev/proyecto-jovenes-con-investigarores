<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\PremioController;
use App\Models\Colaborador;
use App\Models\User;
use App\Models\Video;
use App\Models\Premio;

// Session

// if (!session()->has('perfil')){
//     session(['perfil' => 'invitado']);
//     session(['showLoginButton' => true]);
// }


Route::get("/", [InicioController::class, "index"])->name("index");

// Auth
Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "loginPost"])->name("login");
Route::get("/register", [AuthController::class, "register"])->name("register");
Route::post("/register", [AuthController::class, "registerPost"])->name("register");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

//Usuarios
Route::get("/gestion-usuarios", [UsuarioController::class, "index"])->name("gestion-usuarios");
Route::get("/quienes-somos", [UsuarioController::class, "quienesSomos"])->name("quienes-somos");
Route::post("/quienes-somos", [UsuarioController::class, "quienesSomosPost"])->name("quienes-somos-post");
Route::get("/mentorizacion", [UsuarioController::class, "mentorizacion"])->name("mentorizacion");
Route::post("/mentorizacion", [UsuarioController::class, "mentorizacionPost"])->name("mentorizacion-post");
Route::get("/proyectos-intercentros", [UsuarioController::class, "proyectosIntercentros"])->name("proyectos-intercentros");
Route::get("/eventos", [UsuarioController::class, "eventos"])->name("eventos");
Route::get("/revistas", [UsuarioController::class, "revistas"])->name("revistas");
Route::get("/gestion-usuarios/crear", [UsuarioController::class, "crearUsuario"])->name("crear-usuario");
Route::post("/gestion-usuarios/crear", [UsuarioController::class, "crearUsuarioPost"])->name("crear-usuario-post");


// Vídeos 
Route::get("/gestion-videos", [VideoController::class, "gestionVideos"])->name("gestion-videos");
Route::get("/gestion-videos/editar/{id}", [VideoController::class, "editarVideos"])->name("editar-videos");

// Premios
Route::get("/gestion-premios", [PremioController::class, "gestionPremios"])->name("gestion-premios");
Route::get("/gestion-premios/crear", [PremioController::class, "crearPremio"])->name("crear-premio");
Route::post("/gestion-premios/crear", [PremioController::class, "crearPremioPost"])->name("crear-premio-post");
Route::get("/gestion-premios/destacar/{id}", [PremioController::class, "destacarPremio"])->name("destacar-premio");
Route::get("/gestion-premios/quitar-destacado/{id}", [PremioController::class, "quitarPremioDestacado"])->name("quitar-premio-destacado");
Route::get("/gestion-premios/editar/{id}", [PremioController::class, "editarPremio"])->name("editar-premio");
Route::post("/gestion-premios/editar/{id}", [PremioController::class, "editarPremioPost"])->name("editar-premio-post");
Route::match(['GET', 'POST'], '/gestion-premios/eliminar/{id}', [PremioController::class, "eliminarPremio"])->name("eliminar-premio");
//Premios virginia
Route::get("/mostrar-premios", [PremioController::class, "mostrarPremios"])->name("mostrar-premios");

// Colaborador
Route::get("/gestion-colaboradores", [UsuarioController::class, "buscarUsuarioPost"])->name("buscar-usuario");
Route::get("/panel-colaboradores", [ColaboradorController::class, "index"])->name("panel-colaboradores");
Route::get("/gestion-colaboradores", [ColaboradorController::class, "gestionColaboradores"])->name("gestion-colaboradores");
Route::get("/gestion-colaboradores/crear", [ColaboradorController::class, "crearColaborador"])->name("crear-colaborador");
Route::post("/gestion-colaboradores/crear", [ColaboradorController::class, "crearColaboradorPost"])->name("crear-colaborador-post");
Route::match(['GET', 'POST'], '/crear-colaborador/{id}/{tipoColaborador}', [ColaboradorController::class, 'crearColaborador'])->name('crear-colaborador');
Route::match(['GET', 'POST'], '/eliminar-colaborador/{id}', [ColaboradorController::class, 'eliminarColaboradorPost'])->name('eliminar-colaborador-post');

// Mentor
// Route::get("/mentorizacion", [MentorController::class, "mentorizacion"])->name("mentorizacion");
// Route::post("/mentorizacion", [MentorController::class, "registrarMentor"])->name("registrar-mentor");

//Ajax
Route::get("/obtener-usuarios-ajax", [UsuarioController::class, "obtenerUsuariosAjax"])->name("obtener-usuarios-ajax");
Route::post("/obtener-usuarios-ajax", [UsuarioController::class, "obtenerUsuariosAjax"])->name("obtener-usuarios-ajax");
Route::get("/obtener-premios-ajax", [PremioController::class, "obtenerPremiosAjax"])->name("obtener-premios-ajax");
Route::post("/obtener-premios-ajax", [PremioController::class, "obtenerPremiosAjax"])->name("obtener-premios-ajax");