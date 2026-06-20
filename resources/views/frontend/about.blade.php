@extends('master')
@section('content')
     <main class="pt-20">
         <section class="bg-[#F7EEE9] py-16 text-center">
             <h1 class="text-3xl md:text-4xl font-bold text-[#835837] mb-4">About Bazaar Store</h1>
             <p class="font-semibold text-[#9A7F73] max-w-2xl mx-auto capitalize">Bazaar Store is an online platform aimed at supporting local artisans and preserving handmade heritage.</p>
         </section>
         <section class="py-14">
             <div class="max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-4 text-center gap-4">
                 <div>
                     <h3 class="text-3xl font-bold text-[#835837] mb-1">+5</h3>
                     <p class="text-[#9A7F73] text-sm font-medium">Artisans</p>
                 </div>
                 <div>
                     <h3 class="text-3xl font-bold text-[#835837] mb-1">+500</h3>
                     <p class="text-[#9A7F73] text-sm font-medium">Products</p>
                 </div>
                 <div>
                     <h3 class="text-3xl font-bold text-[#835837] mb-1">8</h3>
                     <p class="text-[#9A7F73] text-sm font-medium">Categories</p>
                 </div>
                 <div>
                     <h3 class="text-3xl font-bold text-[#835837] mb-1">+20</h3>
                     <p class="text-[#9A7F73] text-sm font-medium">Workshops</p>
                 </div>
             </div>
         </section>
         <section class="bg-[#F7EEE9] py-14">
             <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-8 px-4 md:px-6">
                 <div>
                     <h3 class="text-xl font-bold text-[#835837] mb-2">Our Vision</h3>
                     <p class="text-sm font-semibold text-[#9A7F73] leading-relaxed capitalize">We aspire to be the leading platform in the arab world for showcasing and selling authentic handmade products, and to contribute to the continuity of traditional crafts for future generations.</p>
                 </div>
                 <div>
                     <h3 class="text-xl font-bold text-[#835837] mb-2">Our Mission</h3>
                     <p class="text-sm font-semibold text-[#9A7F73] leading-relaxed capitalize">We believe every handmade piece carries a unique story and helps provide job opportunities for artisans and their families. We strive to connect artisans directly with customers.</p>
                 </div>
             </div>
         </section>
         <section class="py-14 text-center">
             <h2 class="text-3xl font-bold text-[#835837] mb-8">Our Values</h2>
             <div class="max-w-5xl grid grid-cols-2 md:grid-cols-4 gap-6 mx-auto px-4">
                 <div>
                     <div class="bg-[#F7EEE9] text-[#835837] text-2xl w-12 h-12 mx-auto flex justify-center items-center rounded-full mb-2"><i class="fa-regular fa-heart"></i></div>
                     <h4 class="font-bold text-[#835837]">Authenticity</h4>
                     <p class="font-medium text-xs text-[#9A7F73] mt-2 capitalize">We ensure 100% authentic handmade products</p>
                 </div>
                 <div>
                     <div class="bg-[#F7EEE9] text-[#835837] text-2xl w-12 h-12 mx-auto flex justify-center items-center rounded-full mb-2"><i class="fa-regular fa-star"></i></div>
                     <h4 class="font-bold text-[#835837]">Quality</h4>
                     <p class="font-medium text-xs text-[#9A7F73] mt-2 capitalize">We carefully select the best artisans and products</p>
                 </div>
                 <div>
                     <div class="bg-[#F7EEE9] text-[#835837] text-2xl w-12 h-12 mx-auto flex justify-center items-center rounded-full mb-2"><i class="fa-regular fa-thumbs-up"></i></div>
                     <h4 class="font-bold text-[#835837]">Support</h4>
                     <p class="font-medium text-xs text-[#9A7F73] mt-2 capitalize">We support local artisans and their communities</p>
                 </div>
                 <div>
                     <div class="bg-[#F7EEE9] text-[#835837] text-2xl w-12 h-12 mx-auto flex justify-center items-center rounded-full mb-2"><i class="fa-regular fa-handshake"></i></div>
                     <h4 class="font-bold text-[#835837]">Trust</h4>
                     <p class="font-medium text-xs text-[#9A7F73] mt-2 capitalize">We build trust relationships with our customers</p>
                 </div>
             </div>
         </section>
         <section class="bg-[#F7EEE9] py-14 text-center mb-14">
             <h2 class="text-3xl font-bold text-[#835837] mb-6">Our Story</h2>
             <p class="font-semibold text-[#9A7F73] max-w-3xl mx-auto leading-relaxed capitalize">The idea of Bazaar Store started from observing the challenges local artisans face in reaching new customers and fairly marketing their products.<br><br>Therefore, we decided to create an online platform that brings together the best artisans and their products in one place, while providing workshops to transfer traditional skills.</p>
         </section>
     </main>

@endsection
@push('scripts')
    <script type="module" src="{{asset('frontend/js/script.js')}}"></script>
@endpush
    