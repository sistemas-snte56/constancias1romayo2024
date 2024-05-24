<?php

use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\MaestroController;
use App\Models\Buscador;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function(){
    return redirect('/buscar');
});

Route::resource('/buscar', BuscadorController::class)->names('consulta');
Route::get('/generar-pdf/{codigo_id}', [BuscadorController::class, 'generarPDF'])->name('generar.pdf');

// Route::get('maestros/import', [MaestroController::class, 'importMaestros'])->name('maestro.import');
// Route::post('maestros/import', [MaestroController::class, 'importMaestrosExcelData'])->name('maestro.import');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/inicio', function () {
            return view('inicio');
        })->name('inicio');
        Route::get('/maestros/import', [MaestroController::class, 'importMaestros'])->name('maestro.import');
        Route::post('maestros/import', [MaestroController::class, 'importMaestrosExcelData'])->name('maestro.import');
        Route::resource('/maestros', MaestroController::class)->names('maestro'); 
});

