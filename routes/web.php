<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Excel;

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

Route::get('/', function () {
    return redirect()->route('login');
});
// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});
Route::middleware('auth')->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');


    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');
})->name('main_user');
// Crud Start
Route::get('/dataTableView-list', [CrudController::class, 'dataTableView'])->name('crud.tableViewIndex')->middleware('auth');
Route::get('/crud-list', [CrudController::class, 'index'])->name('crud.index')->middleware('auth');
Route::any('/crud-create', [CrudController::class, 'create'])->name('crud.create')->middleware('auth');
Route::any('/crud-store', [CrudController::class, 'store'])->name('crud.store')->middleware('auth');
Route::get('/crud-show/{id}', [CrudController::class, 'show'])->name('crud.show')->middleware('auth');
Route::get('/crud-edit/{id}', [CrudController::class, 'edit'])->name('crud.edit')->middleware('auth');
Route::post('/crud-update', [CrudController::class, 'update'])->name('crud.update')->middleware('auth');
Route::delete('/crud-destroy/{id}', [CrudController::class, 'destroy'])->name('crud.destroy')->middleware('auth');
// End

Route::get('/fileupload', [CrudController::class, 'fileupload'])->name('crud.fileupload')->middleware('auth');
Route::any('/addExcelData', [CrudController::class, 'addExcelData'])->name('crud.addExcelData')->middleware('auth');

Route::get('send/mail', [CrudController::class, 'send_mail'])->name('send_mail');

Route::any('/excel_test', [CrudController::class, 'excel_test']);

Route::any('/test', [CrudController::class, 'test']);