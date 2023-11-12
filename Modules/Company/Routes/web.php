<?php
use Modules\Company\Http\Controllers\CompanyController;
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

Route::middleware('auth')->group(function(){
    Route::resource('company',CompanyController::class);
});

Route::prefix('company/datatable')->group(function() {
    Route::get('/all', [CompanyController::class,'all'])->name('datatable.company.all');
    Route::get('{id}/member', [CompanyController::class,'member']);
    Route::get('{id}/notmember', [CompanyController::class,'notMember']);
});

Route::prefix('company/user')->group(function() {
    Route::post('/create', [CompanyController::class,'companyUserCreate'])->name('company.user.create');
    Route::post('/store', [CompanyController::class,'companyUserStore'])->name('company.user.store');
    Route::post('/delete', [CompanyController::class,'companyUserDestroy'])->name('company.user.destroy');
});

