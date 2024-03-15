<?php

namespace App\Http\Controllers;

use App\Http\Requests\taskListRequest;
use App\Models\taskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;


class taskListController extends Controller {
    private $model;
    public function __construct(taskList $model) {
        $this->model = $model;
      
    }

    public function index(Request $request) {
        $user = $request->session()->get('user');
        $id = $user['id'];
        $tasks = $this->model->showValues($id);
        return view('index', ['tasks' => $tasks,'user'=> $user]);
    }
    public function createView(Request $request){
        $user = $request->session()->get('user');
        return view('create',['user'=>$user]);

    }

    public function filter(Request $request,$completed) {
        $user = $request->session()->get('user');
        $id = $user['id'];
        $tasks = $this->model->filterValues($id,$completed);
        return view('index', ['tasks' => $tasks,'user'=> $user]);
    }
    public function create(taskListRequest $request) {
        $tasklist = $this->model->storeValues($request->validated());

        return redirect()->route('task.index', ['task' => $tasklist])->with('success', 'Task created successfully');
    }

    public function show(Request $request,taskList $task) {
        $user = $request->session()->get('user');
        return view('show', ['task' => $task,'user'=> $user]);
    }

    public function edit(taskList $task,Request $request) {
        $user = $request->session()->get('user');
        return view('edit', ['task' => $task,'user'=>$user]);
    }

    public function update(taskListRequest $request, taskList $task) {
        $task->updateValues($request->validated());

        return redirect()->route('task.show', ['task' => $task->id])->with('success', 'Task updated successfully');
    }

    public function toggle(taskList $task) {
        $task->toggleComplete();
        return redirect()->back();
    }

    public function delete(taskList $task) {

        $task->deleteValues();

        return redirect()->route('task.index')->with('success', 'Task deleted successfully');
    }

}
