<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UtilController::class, 'loadWelcome'])->name('welcome');

Route::get('/hello/{message}', function ($message) {
    return '<h1>Hello '.$message.'</h1>';
});
//rota de homepage
Route::get('/homepage', [UtilController::class, 'loadHomepage'])->name('home');
//rota fallback
Route::fallback(function(){
    return view('utils.fallback');
});

/**************
 * Users routes
***************/
//all users
Route::get('/users', [UserController::class, 'allUsers'])->name('users.all');
//add users
Route::get('/addusers', [UserController::class, 'addUsers'])->name('users.add');
//rota de registar users
Route::post('/store-users', [UserController::class, 'storeUser'])->name('users.store');
//rota de actualizar users
Route::put('/update-user', [UserController::class, 'updateUser'])->name('users.update');
//Rota para apagar users
Route::get('/delete-users/{id}',[UserController::class, 'deleteUsers'] )->name('users.delete');
//rota para ver /editar users
Route::get('/edit-users/{id}',[UserController::class, 'editUsers'] )->name('users.edit');

/**************
 * Tasks routes
***************/
//all tasks
Route::get('/tasks', [TaskController::class, 'allTasks'])->name('tasks.all');
//add tasks
Route::get('/addtasks', [TaskController::class, 'addTasks'])->name('tasks.add');
//rota para ver /editar tasks
Route::get('/edit-tasks/{id}',[TaskController::class, 'editTasks'] )->name('tasks.edit');
//rota de registar tasks
Route::post('/store-tasks', [TaskController::class, 'storeTask'])->name('tasks.store');

/**************
 * Gifts routes
***************/
//rota todas as prendas
Route::get('/gifts', [GiftController::class, 'allGifts'])->name('gifts.all');
//rota criar prenda
Route::post('/gifts/create', [GiftController::class, 'createGift'])->name('gifts.create');
//rota ver prenda por id
Route::get('/gifts/edit/{id}', [GiftController::class, 'editGift'])->name('gifts.edit');
//rota atualizar prenda
Route::put('/gifts/update', [GiftController::class, 'updateGift'])->name('gifts.update');
//rota apagar prenda
Route::get('/gifts/delete/{id}', [GiftController::class, 'deleteGift'])->name('gifts.delete');
