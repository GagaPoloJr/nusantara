<?php
use Modules\Group\Http\Controllers\GroupController;
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
    Route::resource('group',GroupController::class);
});

Route::prefix('group/datatable')->group(function() {
    Route::get('/all', [GroupController::class,'all'])->name('group.datatable.all');
    Route::get('{id}/member', [GroupController::class,'member']);
    Route::get('{id}/notmember', [GroupController::class,'notMember']);
    Route::get('{id}/access', [GroupController::class,'haveAccess']);
    Route::get('{id}/notaccess', [GroupController::class,'nothaveAccess']);
});

Route::prefix('group/user')->group(function() {
    Route::post('/create', [GroupController::class,'groupUserCreate'])->name('group.user.create');
    Route::post('/store', [GroupController::class,'groupUserStore'])->name('group.user.store');
    Route::post('/delete', [GroupController::class,'groupUserDestroy'])->name('group.user.destroy');
});

Route::prefix('group/access')->group(function() {
    Route::post('/create', [GroupController::class,'groupAccessCreate'])->name('group.access.create');
    Route::post('/store', [GroupController::class,'groupAccessStore'])->name('group.access.store');
    Route::post('/delete', [GroupController::class,'groupAccessDestroy'])->name('group.access.destroy');
});

Route::prefix('group/config')->group(function() {
    Route::post('/visible', [GroupController::class,'groupConfigVisible'])->name('group.conf.visible');
    Route::post('/isadmin', [GroupController::class,'groupConfigIsadmin'])->name('group.conf.isadmin');
});
