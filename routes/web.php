<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RuneController;
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

Route::get('/', function () {
    return view('index');
});
Route::group([
    'prefix' => 'rune',
], function () {
    Route::get('/', [RuneController::class, 'index'])
        ->name('rune.index');
    Route::get('update', [RuneController::class, 'update'])
        ->name('rune.update');
});

Route::group([
    'prefix' => 'equipment',
], function () {
    Route::get('/', [EquipmentController::class, 'index'])
        ->name('equipment.index');
    Route::get('charm', [EquipmentController::class, 'charm'])
        ->name('equipment.charm');
    Route::get('update', [EquipmentController::class, 'update'])
        ->name('equipment.update');
});
