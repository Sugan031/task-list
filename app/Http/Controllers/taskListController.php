<?php

namespace App\Http\Controllers;

use App\Models\taskList;
use Illuminate\Http\Request;

class taskListController extends Controller
{
    private $model;
    public function __construct(taskList $model) {
        $this->model = $model;
    }

    public function index(){
           
    }
}
