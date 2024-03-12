@extends('layout.app')

@section('title',$task->title)

@section('content')
<div class="mb-4">
<a href="{{route('task.index')}}"
    class="font-medium text-grey-700 underline decoration-pink-500">← Go back to the task list</a>
</div>


<p class="mb-4 text-slate-700">{{$task->description}}</p>

@if ($task->long_description)
    <p class="mb-4 text-slate-700">{{$task->long_description}}</p>
@endif

<p class="mb-4 text-sm text-slate-500"> created {{$task->created_at->diffForHumans()}} • updated {{$task->updated_at->diffForHumans()}}</p>

<p>
    @if ($task->completed)
       <span class="font-medium text-green-500">Completed</span>
    @else
    <span class="font-medium text-red-500">Not Completed</span>
    @endif
</p>

<div class="flex gap-2">
    <a href="{{ route('task.edit',['task'=>$task])}}"
    class="btn">EDIT</a>

    <form action="{{route('task.toggle',['task'=>$task])}}" method="post">
    @csrf
    @method('put')
    <button type="input"  class="btn">
        Mark as {{$task->completed ? 'not completed' :'completed'}}
    </button>
    </form>

    <form action="{{ route('task.destroy',['task'=>$task]) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit"  class="btn" onclick="return confirm('Are you sure you want to delete this task?')">DELETE</button>
    </form>
</div>
<script>
    // function confirmDelete() {
    //         return window.confirm('Are you sure you want to delete this task?');
    //     }
</script>
@endsection