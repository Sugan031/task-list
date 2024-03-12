<?php

use App\Http\Controllers\taskListController;
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
*/
    Route::get("/login", function () {
        return view("user.login");
    });

    Route::get('/', function () {
        return redirect('/tasks');
    }
);
    Route::get('/tasks', [taskListController::class,'index'])->name('task.index');
    
    Route::view('/tasks/create','create')->name('task.create');


    Route::get('/tasks/{task}/edit',[taskListController::class,'edit'])->name('task.edit');

    Route::get('/tasks/{task}',[taskListController::class,'show'])->name('task.show');

    Route::post('/tasks',[taskListController::class,'create'])->name('task.store');

    Route::put('/tasks/{task}',[taskListController::class,'update'])->name('task.update');

    Route::delete('/tasks/{task}',[taskListController::class,'delete'])->name('task.destroy');

    Route::put('tasks/{task}/toggle-complete',[taskListController::class,'toggle'])->name('task.toggle');