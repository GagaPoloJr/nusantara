<?php

use App\Http\Controllers\DashboardController;
use App\Jobs\ProcessNotification;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

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
require __DIR__ . '/auth.php';

view()->composer('template.partials.sidebar', function ($view) {
    $menus = Menu::with('subMenus')->get()->whereNotIn('deleted',true);
    $menu_vehicles = [
        ['name' => 'Registrasi Kendaraan', 'link' => 'vehicles'],
        ['name' => 'Form Check', 'link' => 'vehicles/form'],
        ['name' => 'Checklist Kendaraan', 'link' => 'vehicles/checklist'],
    ];
    $view->with(['menus' =>$menus, 'menu_vehicles' => $menu_vehicles]);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/notification/{id}', [DashboardController::class, 'updateNotification']);
    Route::get('/wabot', [ProcessNotification::class, 'waBot']);
});

Route::prefix('download')->group(function () {
    Route::get('/manualbook', [DashboardController::class, 'manualBook'])->name('download.manualbook');
});

Route::prefix('profile')->group(function () {
    Route::post('/update', [DashboardController::class, 'updateProfile'])->name('update.profile');
});

Route::get('/viewer', function () {
    return view('viewer', [
        'file' => 'public/reports/Report.mrt',
        'jsonfile' => 'public/reports/data.json',
    ]);
});

