<?php

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


    Route::get('/', function () {
        return redirect('/tasks');
    }
);
    Route::get('/tasks', function (){
        return view('index', [
          'tasks'=> taskList::latest()->paginate(10)
        ]);
    })->name('task.index');
    
    Route::view('/tasks/create','create')->name('task.create');


    Route::get('/tasks/{task}/edit',function(taskList $task) {
        return view('edit', ['task'=> $task]);
    })->name('task.edit');

    Route::get('/tasks/{task}',function(taskList $task) {
        return view('show', ['task'=> $task]);
    })->name('task.show');

    Route::post('/tasks',function(taskListRequest $request) {
    //    $data = $request->validated();

    //     $taskList = new TaskList();
    //     $taskList->title = $data['title'];
    //     $taskList->description = $data['description'];
    //     $taskList->long_description = $data['long_description'];

    //     $taskList->save();

        $taskList = taskList::create($request->validated());

        return redirect()->route('task.show',['task'=>$taskList->id])
        ->with('success','Task created successfully');
    })->name('task.store');

    Route::put('/tasks/{task}',function(taskList $task,taskListRequest $request) {
        // $data = $request->validated();

         $task->update($request->validated());
        // $taskList->title = $data['title'];
        // $taskList->description = $data['description'];
        // $taskList->long_description = $data['long_description'];

        // $taskList->save();

        return redirect()->route('task.show',['task'=>$task->id])
        ->with('success','Task updated successfully');
    })->name('task.update');

    Route::delete('/tasks/{task}',function(TaskList $task) {
        $task->delete();

        return redirect()->route('task.index')
        ->with('success','Task deleted successfully');
    })->name('task.destroy');

    Route::put('tasks/{task}/toggle-complete',function(taskList $task){
       $task->toggleComplete();
        return redirect()->back();
    })->name('task.toggle');
    // Route::get('/xxx', function () {
    //     return 'Hello';
    // })->name('hello');
    // Route::get('/{id}', function ($id) {
    //     return 'One single task';
    // })->name('tasks.show');
    
    // Route::get('/hallo', function () {
    //     return redirect()->route('hello');
    // });
    // // Route::get('/xxx', function () {
    // //     return 'Hello';
    // // })->name('hello');
    
    // Route::get('/greet/{name}', function ($name) {
    //     return 'Hello ' . $name . '!';
    // });
    // // Route::get('/hallo', function () {
    // //     return redirect()->route('hello');
    // // });
    
    // // Route::get('/greet/{name}', function ($name) {
    // //     return 'Hello ' . $name . '!';
    // // });
    
    // Route::fallback(function () {
    //     return 'Still got somewhere!';
    // });
    
    // GET
    // POST 
    // PUT 
    // DELETE 
