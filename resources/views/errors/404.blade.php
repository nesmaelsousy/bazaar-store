@extends('master')
@section('content')
    <main class="pt-20">
        <section class="min-h-[calc(100vh-80px)] bg-[#F7EEE9] flex items-center justify-center px-6">
            <div class="text-center max-w-lg mx-auto">
                {{-- رقم 404 كبير --}}
                <h1 class="text-8xl md:text-9xl font-bold text-[#835837] mb-2">
                    404
                </h1>

                {{-- خط زخرفي --}}
                <div class="w-24 h-1 bg-[#c8a98d] mx-auto rounded-full mb-6"></div>

                {{-- عنوان --}}
                <h2 class="text-2xl md:text-3xl font-semibold text-[#835837] mb-3">
                    Page Not Found
                </h2>

                {{-- وصف --}}
                <p class="text-[#9A7F73] text-base leading-relaxed mb-8">
                    Oops! The page you're looking for doesn't exist or has been moved.
                </p>

                {{-- زر العودة للرئيسية --}}
                <a href="{{ route('frontend.index') }}"
                    class="inline-flex items-center gap-2 px-8 py-3 bg-[#835837] text-white rounded-lg hover:bg-[#6b4529] transition duration-300 shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Home
                </a>
            </div>
        </section>
    </main>
@endsection