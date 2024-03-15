@extends('user.userLayout.app')
@section('styles')
  <style>
    .error-message {
      color: red;
      font-size: 0.8rem;
    }
  </style>
@endsection
@section('content')
<div class="max-w-md w-full bg-white p-8 shadow-md rounded-md">
        <h2 class="text-2xl font-bold mb-6">Register</h2>
        <form action="{{route('user.create')}}" method="post">
        @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{old('name')}}"  class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                @class(['border-red-500' => $errors->has('name')])>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{old('email')}}"  class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                @class(['border-red-500' => $errors->has('email')])>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                @class(['border-red-500' => $errors->has('password')])>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                @class(['border-red-500' => $errors->has('password_confirmation')])>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">Register</button>
                <a href="{{route('user.index')}}" class="text-sm text-blue-500 hover:text-blue-700">Already have an account?</a>
            </div>
        </form>
    </div>
@endsection