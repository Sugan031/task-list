<?php

use App\Http\Controllers\taskListController;
use App\Http\Controllers\userController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Requests\taskListRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\taskList;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
// */ 
Route::get("/login", [userController::class,"index"])->name("user.index")->withoutMiddleware(LoginMiddleware::class);
Route::get('/', function () {
        return redirect('/login');
})->withoutMiddleware(LoginMiddleware::class);

Route::get("/register", [userController::class,"registerView"])->name("user.register")->withoutMiddleware(LoginMiddleware::class);
Route::post("/register/create", [userController::class,"register"])->name("user.create")->withoutMiddleware(LoginMiddleware::class);
Route::post('/login/signin', [userController::class,'login'])->name('user.signin')->withoutMiddleware(LoginMiddleware::class);
    
Route::Middleware('isLogin')->group(function () {
    Route::get('/tasks', [taskListController::class, 'index'])->name('task.index');
    Route::get('/tasks/filter/{completed}', [taskListController::class, 'filter'])->name('task.filter');
    Route::get('/tasks/create', [taskListController::class, 'createView'])->name('task.create');
    Route::get('/tasks/{task}/edit', [taskListController::class, 'edit'])->name('task.edit');
    Route::get('/tasks/{task}',[taskListController::class,'show'])->name('task.show');
    Route::post('/tasks', [taskListController::class, 'create'])->name('task.store');
    Route::put('/tasks/{task}', [taskListController::class, 'update'])->name('task.update');
    Route::delete('/tasks/{task}', [taskListController::class, 'delete'])->name('task.destroy');
    Route::put('/tasks/{task}/toggle-complete', [taskListController::class, 'toggle'])->name('task.toggle');
    Route::get('/logout', [userController::class,'logout'])->name('user.logout');
    Route::get('/profile/{id}', [userController::class,'profile'])->name('user.profile');
    Route::put('/profile/{id}/edit',[userController::class,'edit'])->name('user.edit');
    Route::put('/profile/delete/{id}', [userController::class,'delete'])->name('user.delete');
});