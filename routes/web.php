<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PsicologoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DiarioController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AdminController;

// ─── Públicas ────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/cadastro',[AuthController::class, 'register'])->name('register.post');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// Psicólogos ── ATENÇÃO: rotas fixas ANTES de {id}
Route::get('/psicologos',                 [PsicologoController::class, 'index'])->name('psicologos.index');
Route::get('/psicologos/cadastro',        [PsicologoController::class, 'create'])->name('psicologos.create');
Route::post('/psicologos/cadastro',       [PsicologoController::class, 'store'])->name('psicologos.store');
Route::get('/psicologos/validar-crp',     [PsicologoController::class, 'validarCrp'])->name('psicologos.validar-crp');
Route::get('/psicologos/{id}',            [PsicologoController::class, 'show'])->name('psicologos.show')->where('id', '[0-9]+');

// Exercícios e Materiais (público)
Route::get('/exercicios',       [ExercicioController::class, 'index'])->name('exercicios.index');
Route::get('/materiais',        [MaterialController::class, 'index'])->name('materiais.index');
Route::get('/materiais/{id}',   [MaterialController::class, 'show'])->name('materiais.show')->where('id', '[0-9]+');

// ─── Autenticado (usuário) ────────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Perfil
    Route::get('/perfil',          [UsuarioController::class, 'show'])->name('usuario.perfil');
    Route::get('/perfil/editar',   [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::put('/perfil',          [UsuarioController::class, 'update'])->name('usuario.update');
    Route::delete('/perfil',       [UsuarioController::class, 'destroy'])->name('usuario.destroy');

    // Diário Emocional
    Route::get('/diario',              [DiarioController::class, 'index'])->name('diario.index');
    Route::post('/diario',             [DiarioController::class, 'store'])->name('diario.store');
    Route::get('/diario/{id}/editar',  [DiarioController::class, 'edit'])->name('diario.edit');
    Route::put('/diario/{id}',         [DiarioController::class, 'update'])->name('diario.update');
    Route::delete('/diario/{id}',      [DiarioController::class, 'destroy'])->name('diario.destroy');
});

// ─── Admin ───────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/',                          [AdminController::class, 'dashboard'])->name('dashboard');

    // Usuários
    Route::get('/usuarios',                  [AdminController::class, 'usuarios'])->name('usuarios.index');
    Route::get('/usuarios/{id}',             [AdminController::class, 'showUsuario'])->name('usuarios.show');
    Route::get('/usuarios/{id}/editar',      [AdminController::class, 'editUsuario'])->name('usuarios.edit');
    Route::put('/usuarios/{id}',             [AdminController::class, 'updateUsuario'])->name('usuarios.update');
    Route::delete('/usuarios/{id}',          [AdminController::class, 'destroyUsuario'])->name('usuarios.destroy');

    // Psicólogos
    Route::get('/psicologos',                [AdminController::class, 'psicologos'])->name('psicologos.index');
    Route::get('/psicologos/{id}',           [AdminController::class, 'showPsicologo'])->name('psicologos.show');
    Route::get('/psicologos/{id}/editar',    [AdminController::class, 'editPsicologo'])->name('psicologos.edit');
    Route::put('/psicologos/{id}',           [AdminController::class, 'updatePsicologo'])->name('psicologos.update');
    Route::delete('/psicologos/{id}',        [AdminController::class, 'destroyPsicologo'])->name('psicologos.destroy');
    Route::post('/psicologos/{id}/aprovar',  [AdminController::class, 'aprovarPsicologo'])->name('psicologos.aprovar');

    // Exercícios
    Route::get('/exercicios',                [AdminController::class, 'exercicios'])->name('exercicios.index');
    Route::get('/exercicios/criar',          [AdminController::class, 'createExercicio'])->name('exercicios.create');
    Route::post('/exercicios',               [AdminController::class, 'storeExercicio'])->name('exercicios.store');
    Route::get('/exercicios/{id}/editar',    [AdminController::class, 'editExercicio'])->name('exercicios.edit');
    Route::put('/exercicios/{id}',           [AdminController::class, 'updateExercicio'])->name('exercicios.update');
    Route::delete('/exercicios/{id}',        [AdminController::class, 'destroyExercicio'])->name('exercicios.destroy');

    // Materiais
    Route::get('/materiais',                 [AdminController::class, 'materiais'])->name('materiais.index');
    Route::get('/materiais/criar',           [AdminController::class, 'createMaterial'])->name('materiais.create');
    Route::post('/materiais',                [AdminController::class, 'storeMaterial'])->name('materiais.store');
    Route::get('/materiais/{id}/editar',     [AdminController::class, 'editMaterial'])->name('materiais.edit');
    Route::put('/materiais/{id}',            [AdminController::class, 'updateMaterial'])->name('materiais.update');
    Route::delete('/materiais/{id}',         [AdminController::class, 'destroyMaterial'])->name('materiais.destroy');
});
