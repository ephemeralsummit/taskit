<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware("auth")->group(function() {
    // user only
    Route::get('/dashboard', function() {
        $my_task = App\Models\Task::where(
            'user_id',
            auth()->user()->id
        )->get();
        $id = App\Models\User::where(
            'id',
            auth()->user()->id
        )->get();
        return view('dashboard', [
            'my_task' => $my_task,
            'id' => $id,
        ]);
    });

    Route::get('/profile/{id}', function($id) {
        $user = \App\Models\User::find($id);
        return view('profile', [
            'user' => $user,
        ]);
    });
    Route::post('/dashboard', [TaskController::class, 'dashboardstore']);
    Route::delete('/dashboard/{id}', [TaskController::class, 'ddestroy'])->name('tasks.delete');
    Route::put('/tasks/{id}', [TaskController::class, 'inlineUpdate'])->name('tasks.inlineUpdate');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin only
    Route::resource('/tasks', TaskController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
});
