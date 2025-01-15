<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\Auth\RegisterAdminController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


// Rota de login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Rota para mostrar o formulário de criação de consulta
Route::get('/consultas/create', [ConsultaController::class, 'create'])->name('consultas.create');

// Rota para buscar médicos com base na especialidade
Route::get('/medicos/por-especialidade/{especialidadeId}', [ConsultaController::class, 'buscarMedicosPorEspecialidade'])->name('medicos.buscarPorEspecialidade');

// Rota para salvar a consulta
Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');

// Rota para buscar paciente
Route::get('/consulta/buscar-paciente/{idPaciente}', [ConsultaController::class, 'buscarPaciente'])->name('consulta.buscarPaciente');

// ADMINISTRATIVO
Route::get('/administrativo/create', [AdministrativoController::class, 'create'])->name('administrativo.create');
Route::post('/administrativo', [AdministrativoController::class, 'store'])->name('administrativo.store');

// Página inicial (landing page)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');  // Removi a rota duplicada

// Rota de login
// Não precisa de outra rota para '/welcome', pois já existe a rota de 'welcome' acima

// Médicos (roteamento de criação, listagem, etc.)
Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos.index');  // Nomeando a rota
Route::get('/medicos/criar', [MedicoController::class, 'criar'])->name('medicos.criar');
Route::get('/medicos/listar', [MedicoController::class, 'listar'])->name('medicos.listar');
Route::post('medicos', [MedicoController::class, 'store'])->name('medicos.store');

// Rota de cadastro de administrador
Route::get('/registerAdmin', [RegisterAdminController::class, 'showForm'])->name('registerAdmin');
Route::post('/registerAdmin', [RegisterAdminController::class, 'register'])->name('registerAdmin.store');

// Autenticação com middleware 'verified' (para usuários autenticados)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Redireciona os usuários autenticados
    Route::get('/', function () {
        session()->flash('msg', 'Você já está logado!');
        return view('welcome');
    })->name('welcome');
});

// Autenticação com middleware 'auth' (para usuários autenticados)
Route::middleware('auth')->group(function () {
    // Rota para a agenda do médico
    Route::get('/medicos/agenda', [MedicoController::class, 'agenda'])->name('medicos.agenda');
});

// Rota para a página de realização da consulta, passando o ID da consulta
Route::get('/consulta/{consulta}/realizar', [ConsultaController::class, 'realizar'])->name('consulta.realizar');

Route::post('/consulta/{consulta}/realizar', [ConsultaController::class, 'realizarConsulta'])->name('consulta.realizar.post');


