@extends('master')
@section('content')

    <main class="min-h-screen pt-24 flex justify-center items-center mb-20">
        <div class="bg-white rounded-2xl shadow-xl w-full  {{ request()->routeIs('register')?'max-w-4xl': 'max-w-md' }} p-8 text-center">
            <img src="{{ asset('frontend/images/General-Images/logo.png') }}" class="w-28 mx-auto mb-4">
            <div class="flex bg-[#F7EEE9] rounded-lg p-1 mb-6">
                @if(request()->routeIs('password.request') || request()->routeIs('password.reset'))
                <a href="{{ route('login') }}" class="w-full py-1 text-center text-[#835837] font-bold  rounded-lg">
                   backe to login
                </a>
                @else
                <a id="loginTab" href="{{ route('login') }}"
                    class="w-1/2 py-1 rounded-lg text-[#835837]
           {{ request()->routeIs('login') ? 'bg-white' : '' }}">
                    Login
                </a>

                <a href="{{ route('register') }}" id="signupTab"
                    class="w-1/2 py-1 rounded-lg text-[#9A7F73]
           {{ request()->routeIs('register') ? 'bg-white' : '' }}">
                    Sign Up
                </a>
                @endif
            </div>
            {{ $slot }}
        </div>
    </main>
@endsection
    