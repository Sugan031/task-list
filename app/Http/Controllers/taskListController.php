<?php

namespace App\Http\Controllers;

use App\Http\Requests\taskListRequest;
use App\Models\taskList;

class taskListController extends Controller {
    private $model;
    public function __construct(taskList $model) {
        $this->model = $model;
    }

    public function index() {
        $tasks = $this->model->showValues();
        return view('index', ['tasks' => $tasks]);
    }

    public function create(taskListRequest $request) {

        $tasklist = $this->model->storeValues($request->validated());

        return redirect()->route('task.show', ['task' => $tasklist])->with('success', 'Task created successfully');
    }

    public function show(taskList $task) {
        return view('show', ['task' => $task]);
    }

    public function edit(taskList $task) {
        return view('edit', ['task' => $task]);
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
