@extends('user.userLayout.app')
@section('styles')
  <style>
    .error-message {
      color: red;
      font-size: 0.8rem;
    }
  </style>
@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
@if (session()->has('success'))
   <div class="mt-4 "> <p class="border-solid bg-lime-500 text-lime-500">{{session('success')}}</p></div>
@endif
<div class="mt-6">
            <a href="{{route('task.index')}}" class="text-blue-500 hover:text-blue-700">← Back to task list</a>
</div>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">User Profile</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and account settings.</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{$user['name']}}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 flex items-center">
                            <span class="mr-2">{{$user['email']}}</span>
                            <button class="text-blue-500 hover:text-blue-700" onclick="edittoggle()">Edit</button>
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Update password</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 flex items-center">
                            <button class="text-blue-500 hover:text-blue-700" onclick="passwordToggle()">Change Password</button>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Delete account</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 flex items-center">
                            <button class="text-red-500 hover:text-red-700" onclick="deleteToggle()">Delete Account</button>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        <!-- edit model -->
        <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{route('user.edit',['id'=>$user['id']])}}" method="post" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                @csrf
               @method('put')
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Profile</h3>
                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="email" name="email" id="email" value="{{ $user['email'] }}" autocomplete="email" required class="mt-1 border-solid border-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password" id="password"  required class="mt-1 border-solid border-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @if (session()->has('error'))
                                <p class="error-message">{{ session('error') }}</p>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save Changes
                            </button>
                            <!-- <input type="submit" name="" id=""> -->
                            <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- password model -->
<div id="passwordModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{route('user.edit',['id'=>$user['id']])}}" method="post" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                @csrf
               @method('put')
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Profile</h3>
                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Old password</label>
                            <input type="password" name="password" id="old_password" value="" autocomplete="email" required class="mt-1 border-solid border-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @if (session()->has('pass_error'))
                                <p class="error-message">{{ session('pass_error') }}</p>
                            @endif
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="new_password" id="password"  required class="mt-1 border-solid border-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @if (session()->has('mismatch_error'))
                                <p class="error-message">{{ session('mismatch_error') }}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"  required class="mt-1 border-solid border-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @if (session()->has('mismatch_error'))
                                <p class="error-message">{{ session('mismatch_error') }}</p>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit"  class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save Changes
                            </button>
                            <!-- <input type="submit" name="" id=""> -->
                            <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE MODEL -->
<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{route('user.delete',['id'=>$user['id']])}}" method="post" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                @csrf
               @method('put')
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Delete Profile</h3>
                        <!-- password Input -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">password</label>
                            <input type="password" name="password" id="old_password" value="" autocomplete="email" required class="mt-1 border-solid border-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @if (session()->has('delete_error'))
                                <p class="error-message">{{ session('delete_error') }}</p>
                            @endif
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit" onclick="confirmDelete()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save Changes
                            </button>
                            <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection