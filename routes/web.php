<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controller\TmAreaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/areas',[App\Http\Controllers\TmAreasController::class, 'index']);
Route::get('/prueba',[App\Http\Controllers\TmAreasController::class, 'index'])->name('index');
Route::get('/form/areas',[App\Http\Controllers\TmAreasController::class, 'index'])->name('index');
Route::get('/form/departament',[App\Http\Controllers\TmDepartamentsController::class, 'index'])->name('index');
Route::get('/payroll/tiposrol',[App\Http\Controllers\TmTiposrolController::class, 'index'])->name('index');
Route::get('/payroll/assign-rubros',[App\Http\Controllers\TmTiposrolRubrosController::class, 'index'])->name('index');
Route::get('/payroll/planilla',[App\Http\Controllers\TdPlanillaController::class, 'index'])->name('index');
Route::get('/payroll/rolpago',[App\Http\Controllers\TdRolPagoController::class, 'index'])->name('index');
Route::get('/setting/generalities',[App\Http\Controllers\TmCatalogogeneralController::class, 'index'])->name('index');
Route::get('/form/charges',[App\Http\Controllers\TmCargociaController::class, 'index'])->name('index');
Route::get('/empresa',[App\Http\Controllers\TmCompaniaController::class, 'index'])->name('index');
Route::get('/form/periods',[App\Http\Controllers\TmPeriodosrolController::class, 'index'])->name('index');
Route::get('/form/rubros',[App\Http\Controllers\TmRubrosrolController::class, 'index'])->name('index');
Route::get('/form/rubros-add',[App\Http\Controllers\TmRubrosrolController::class, 'addrubros'])->name('addrubros');
Route::get('/form/rubros-edit/{id}',[App\Http\Controllers\TmRubrosrolController::class, 'editrubros'])->name('editrubros');
Route::get('/file/staff',[App\Http\Controllers\TmPersonasController::class, 'index'])->name('index');
Route::get('/file/staff-add',[App\Http\Controllers\TmPersonasController::class, 'addperson'])->name('addperson');
Route::get('/file/staff-edit/{id}',[App\Http\Controllers\TmPersonasController::class, 'editperson'])->name('editperson');
Route::get('/file/contracts',[App\Http\Controllers\TmContratosController::class, 'index'])->name('index');




/*Route::view('viewmodal','livewire.vcarea');*/

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


Route::post('/areas',[App\Http\Controllers\TmAreaController::class, 'store']);
