@extends('master')

@section('content')
<main class="min-h-screen flex items-center justify-center px-6">
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-8xl font-bold text-stone-700">403</h1>

        <p class="mt-6 text-xl text-stone-600">
            You are not allowed to access this page.
        </p>

        <a href="{{ url('/') }}"
           class="inline-block mt-8 px-6 py-3 bg-[#9e7b6b] text-white rounded-lg hover:opacity-90 transition">
            Return home
        </a>

        <div class="mt-16 pt-8 border-t border-stone-200/60 text-center text-stone-400 text-sm">
            <p>If you believe this is a mistake, please contact support.</p>
        </div>

    </div>
</main>
@endsection