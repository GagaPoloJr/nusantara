<?php
use Modules\User\Http\Controllers\UserController;
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
    Route::resource('user',UserController::class);
});

Route::prefix('user/datatable')->group(function() {
    Route::get('/all',          [UserController::class,'all'])->name('user.datatable.all');
    Route::get('{id}/group/member',   [UserController::class,'memberGroup']);
    Route::get('{id}/group/notmember',[UserController::class,'notMemberGroup']);
    Route::get('{id}/company/member',   [UserController::class,'memberCompany']);
    Route::get('{id}/company/notmember',[UserController::class,'notMemberCompany']);
    Route::get('{id}/access',   [UserController::class,'access']);
    Route::get('{id}/notaccess',[UserController::class,'notAccess']);
});

Route::prefix('user/company')->group(function() {
    Route::post('/create',  [UserController::class,'userCompanyCreate'])->name('user.company.create');
    Route::post('/store',   [UserController::class,'userCompanyStore'])->name('user.company.store');
    Route::post('/delete',  [UserController::class,'userCompanyDestroy'])->name('user.company.destroy');
});

Route::prefix('user/group')->group(function() {
    Route::post('/create',  [UserController::class,'userGroupCreate'])->name('user.group.create');
    Route::post('/store',   [UserController::class,'userGroupStore'])->name('user.group.store');
    Route::post('/delete',  [UserController::class,'userGroupDestroy'])->name('user.group.destroy');
});

Route::prefix('user/access')->group(function() {
    Route::post('/create',  [UserController::class,'userAccessCreate'])->name('user.access.create');
    Route::post('/store',   [UserController::class,'userAccessStore'])->name('user.access.store');
    Route::post('/delete',  [UserController::class,'userAccessDestroy'])->name('user.access.destroy');
});

Route::prefix('user/config')->group(function() {
    Route::post('/cross', [UserController::class,'userConfigCrossCompany'])->name('user.conf.cross');
});
