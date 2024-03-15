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
    <div class="bg-white p-8 rounded shadow-md w-96">
    @if (session()->has('success'))
    <div class="mt-4 "> <p class="border-solid bg-lime-500 text-lime-500">{{ session('success')}}</p></div>
    @endif

    @if (session()->has('error'))
   <div class="mt-4 "> <p class="border-solid bg-lime-500 text-lime-500">{{session('error')}}</p></div>
    @endif
        <h2 class="text-2xl font-semibold mb-6">Login</h2>

        <form action="{{route('user.signin')}}" method="post">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        value="{{old('email')}}"  @class(['border-red-500' => $errors->has('email')])>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                @class(['border-red-500' => $errors->has('password')])>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                Login
            </button>
        </form>

        <div class="mt-6">
            <p class="text-sm text-gray-600">Don't have an account? <a href="{{route('user.register')}}" class="text-blue-500 hover:underline">Sign up here.</a></p>
        </div>
    </div>
@endsection
