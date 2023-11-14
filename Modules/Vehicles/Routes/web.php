<?php
use Modules\Vehicles\Http\Controllers\VehiclesController;

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

Route::middleware('auth')->group(function () {
    Route::resource('vehicles', VehiclesController::class)->except('show');

    Route::prefix('vehicles/form')->group(function () {
        Route::get('', [VehiclesController::class, 'formIndex'])->name('form.index');
        Route::get('/create', [VehiclesController::class, 'formCreate'])->name('form.create');
        Route::post('', [VehiclesController::class, 'formStore'])->name('form.store');
        Route::get('/{id}/edit', [VehiclesController::class, 'formEdit'])->name('form.edit');
        Route::put('/{id}', [VehiclesController::class, 'formUpdate'])->name('form.update');
        Route::delete('/{id}', [VehiclesController::class, 'formDestroy'])->name('form.destroy');

    });

    Route::prefix('vehicles/checklist')->group(function () {
        Route::get('', [VehiclesController::class, 'checklistIndex'])->name('checklist.index');
        Route::get('/create', [VehiclesController::class, 'checklistCreate'])->name('checklist.create');
        Route::post('/create', [VehiclesController::class, 'checklistStore'])->name('checklist.store');
        Route::post('/update', [VehiclesController::class, 'checklistUpdate'])->name('checklist.update');

        Route::post('/search', [VehiclesController::class, 'searchVehicles'])->name('search.vehicles');
        Route::get('/{code}', [VehiclesController::class, 'getFormChecklist'])->name('checklist.vehicles');



        // Route::get('/create', [VehiclesController::class,'formCreate'])->name('form.create');
        // Route::post('', [VehiclesController::class,'formStore'])->name('form.store');   
        // Route::get('/{id}/edit', [VehiclesController::class,'formEdit'])->name('form.edit');
        // Route::put('/{id}', [VehiclesController::class,'formUpdate'])->name('form.update');
        // Route::delete('/{id}', [VehiclesController::class,'formDestroy'])->name('form.destroy');
    });
});

Route::prefix('vehicles/datatable')->group(function () {
    Route::get('/all', [VehiclesController::class, 'all'])->name('vehicles.datatable.all');
    Route::get('/form-all', [VehiclesController::class, 'formAll'])->name('form.datatable.all');
});