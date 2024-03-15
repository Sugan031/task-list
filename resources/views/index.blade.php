

@extends('layout.app')

@section('title','List of the tasks')
@section('name',$user['name'])
@section('content')
<!-- <div class="flex items-center">
    <input type="text" placeholder="Search..." id="myInput" class="px-3 py-2 rounded-l-md mt-4 border border-gray-300 focus:outline-none focus:ring focus:ring-blue-400">
    </div>-->
<nav class="mt-4 mb-4"> 
    <a href="{{route('task.create')}}"
    class="font-medium text-grey-700 underline decoration-pink-500 ">Add Task!</a>
</nav>
    <nav class="mb-4 mt-4">
        <a href="{{route('task.filter',['completed'=>1])}}" class="btn">Completed</a>
        <a href="{{route('task.filter',['completed'=>0])}}" class="btn">Pending</a>
        <a href="{{route('task.index')}}" class="btn">Reset</a>

    </nav>

    @forelse ($tasks as $task )
        <div>
            <a id="myAnchor" href="{{ route('task.show',['task'=>$task->id]) }}"
            @class(['line-through'=>$task->completed])>{{$task->title}}</a>
        </div>
    @empty
        <div>There are no tasks</div>
    @endforelse

    

    @if ($tasks->count())
        <nav class="mt-4">
        {{$tasks->links()}}
        </nav>
    @endif
    
@endsection
