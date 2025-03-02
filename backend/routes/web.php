<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'login'])->name('login');



Route::middleware(['auth', 'role:admin'])->group(function () {

    //permission routes
    Route::get('/permission',[PermissionController::class,'index'])->name('permission.index');
    Route::get('/permission/create',[PermissionController::class,'create'])->name('permission.create');
    Route::post('/permission/store',[PermissionController::class,'store'])->name('permission.store');
    Route::get('/permission/edit/{id}',[PermissionController::class,'edit'])->name('permission.edit');
    Route::post('/permission/update/{id}',[PermissionController::class,'update'])->name('permission.update');
    Route::delete('/permission/delete/{id}',[PermissionController::class,'destroy'])->name('permission.delete');
    
    
    //role routes
    
    Route::get('/role',[RoleController::class,'index'])->name('role.index');
    Route::get('/role/create',[RoleController::class,'create'])->name('role.create');
    Route::post('/role/store',[RoleController::class,'store'])->name('role.store');
    Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
    Route::post('/role/update/{id}',[RoleController::class,'update'])->name('role.update');
    Route::delete('/role/delete/{id}',[RoleController::class,'destroy'])->name('role.delete');
});
