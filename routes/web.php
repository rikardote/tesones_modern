<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NominasController;
use App\Http\Controllers\TesonesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset (from laravel/ui scaffolding)
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');

// Home / Dashboard
Route::get('/', [TesonesController::class, 'index'])->name('home');

// Tesones (protected by auth middleware in controller)
Route::resource('tesones', TesonesController::class);
Route::get('tesones/{teson}/destroy', [TesonesController::class, 'destroy'])->name('admin.tesones.destroy');
Route::get('tesones/{teson}/borrar', [TesonesController::class, 'borrar'])->name('teson.borrar');
Route::get('tesones/{teson}/imprimir', [TesonesController::class, 'printTeson'])->name('print_teson');

// Cancelaciones sobre tesones
Route::get('cancelar/{teson}', [TesonesController::class, 'cancelar'])->name('cancelar.teson');
Route::post('cancelar/{teson}', [TesonesController::class, 'cancelarStore'])->name('cancelar.teson.store');
Route::get('cancelar/{cancelacion}/edit', [TesonesController::class, 'editarCancelacion'])->name('cancelar.teson.edit');
Route::patch('cancelar/{cancelacion}/update', [TesonesController::class, 'updateCancelacion'])->name('cancelar.teson.update');
Route::get('cancelar/{cancelacion}/destroy', [TesonesController::class, 'borrarCancelacion'])->name('cancelar.destroy');

// Admin: todos los tesones
Route::get('todas', [TesonesController::class, 'todas'])->name('todas.index');

// Nóminas (admin - protected by controller)
Route::resource('info_nominas', NominasController::class);
Route::get('info_nominas/{nomina}/destroy', [NominasController::class, 'destroy'])->name('admin.info_nominas.destroy');

// Usuarios
Route::resource('usuarios', UsersController::class)->only(['index', 'edit']);
Route::patch('usuarios', [UsersController::class, 'update'])->name('usuarios.update');
Route::get('users_all', [UsersController::class, 'usersAll'])->name('admin.users_all.index');
Route::get('usuarios/{user}/borrar', [UsersController::class, 'borrar'])->name('usuario.destroy');
Route::get('usuarios/{user}/password', [UsersController::class, 'editPassword'])->name('usuarios.edit.password');
Route::patch('usuarios/{user}/password', [UsersController::class, 'updatePassword'])->name('usuarios.update.password');
Route::get('users_ver/{user}', [UsersController::class, 'verPorUsuario'])->name('usuario.ver');
Route::get('usuarios/{user}/editar', [UsersController::class, 'editAdmin'])->name('usuarios.edit.admin');
Route::patch('usuarios/{user}/actualizar', [UsersController::class, 'updateAdmin'])->name('usuarios.update.admin');
