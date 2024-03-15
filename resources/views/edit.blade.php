@extends('layout.app')
@section('name',$user['name'])
@section('content')
    @include('form',['task'=>$task])
@endsection