<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2Todo</title>
    <link rel="icon" type="image/png" href="{{asset('images/6422262.png')}}">

    <script src="https://cdn.tailwindcss.com"></script>
    {{-- blade-formatter-disable--}}
    <style type="text/tailwindcss">
        .btn{
            @apply  rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50
            text-slate-700
        }
        label {
            @apply block uppercase text-slate-700 mb-2
        }
        input,
        textarea {
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
        }
        .error {
            @apply text-red-500 text-sm
        }
  </style>
   {{-- blade-formatter-enable --}}

    @yield('styles')
</head>
<body class="container mx-auto mt-10 mb-10 max-w-lg">
<div class="mb-8 border-solid border-2 border-indigo-500 flex justify-between bg-stone-300">
        <h1 class="text-2xl font-semibold font-mono mb-2 display: inline-block mt-2">2ToDo</h1>
        <div class="mt-3">
        <button id="dropdown-button" type="button" class="inline-flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900" 
                aria-expanded="false"  onclick="toggleDropdown()">
                 <span>@yield('name')</span>
                <svg class="h-5 w-8 text-gray-800"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                    stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />  
                <circle cx="12" cy="7" r="4" /></svg>
        </button>
        <ul id="dropdown-menu" class="absolute z-10 mt-1 max-h-56 w-30 rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" 
            tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3" hidden>
            <li class="text-gray-900 relative cursor-default select-none py-2 pl-2 pr-2" id="listbox-option-0" role="option">
            <div class="flex items-center">
                <span class="font-normal ml-3 block truncate "><a href="{{route('user.profile',['id'=>$user['id']])}}">Profile</a></span>
            </div>
            <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
            </li>
            <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="option">
            <div class="flex items-center">
                <span class="font-normal ml-3 block truncate"><a href="{{route('user.logout')}}" onclick="return confirm('Are you sure do you want to logout?')">Logout</a></span>
            </div>
            <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
            </li>
        </ul>
        </div>
    </div>
   


    <h1 class="text-2xl">@yield('title')</h1>
    <div>
        @if (session()->has('success'))
            <div>{{ session('success')}}</div>
        @endif
        @yield('content')
    </div>

    <script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdown-menu");
        if (dropdownMenu.style.display === "none") {
             dropdownMenu.style.display = "block";
         } else {
            dropdownMenu.style.display = "none";
        }
    }

</script>


</body>
</html>
