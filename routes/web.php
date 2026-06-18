<?php

use Illuminate\Support\Facades\Route;
// Siempre importar todas las tablas que vayamos utilizando de Models y en Controllers
use App\Models\Paciente; 
use App\Models\Sala;
use App\Models\Hospitalizacion;
use App\Models\Diagnostico;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\HospitalizacionController;
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// todo los metodos de pacientes 
 
Route::get('/pacientes',[PacienteController::class,'index'])->name('pacientes');
Route::post('/pacientes/guardar/', [PacienteController::class, 'store']);
Route::get('/pacientes/eliminar/{id}', [PacienteController::class, 'destroy']);
Route::post('/pacientes/actualizar/{id}', [PacienteController::class, 'update']);


//---------------------------------------------
//metodos de todos hospitalizacion 

Route::get('/hospitalizacion', [HospitalizacionController::class, 'index'])->name('hospitalizacion');
Route::post('hospitalizacion/guardar', [HospitalizacionController::class, 'store']);
Route::get('hospitalizacion/eliminar/{id}', [HospitalizacionController::class, 'destroy']);
Route::post('/hospitalizacion/actualizar/{id}', [HospitalizacionController::class, 'update']);


//---------------------------------------------------------------------
// metodos salas 
Route::get('/salas', [SalaController::class, 'index'])->name('salas');
Route::post('/salas/guardar/', [SalaController::class, 'store'] );
Route::get('salas/eliminar/{id}', [SalaController::class, 'destroy'] );
Route::post('/salas/actualizar/{id}', [SalaController::class, 'update']);

//---------------------------------------------
//metodos de todos los diagnosticos
Route::get('/tipodiagnostico', [DiagnosticoController::class, 'index'])->name('tipodiagnostico');
Route::post('/tipodiagnostico/guardar/', [DiagnosticoController::class, 'store']);
Route::get('/tipodiagnostico/eliminar/{id}', [DiagnosticoController::class, 'destroy']);        
Route::post('/tipodiagnostico/actualizar/{id}', [DiagnosticoController::class, 'update']);


//----------------------------------------------------------------------------------
//consultas
//pacientes activos en salas
//Route::get('consultaSala',[HospitalizacionController::class, 'pacientes_por_sala']);
//Route::get('consultaHospitalizados',[HospitalizacionController::class,'pacientes_hospitalizados']);
Route::get('consultaHospitalizados', [HospitalizacionController::class,'pacientes_con_dias'] );
Route::get('consultaSala',[HospitalizacionController::class, 'pacientes_alfabetico']);