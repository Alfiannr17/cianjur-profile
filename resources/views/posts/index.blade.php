@extends('layouts.app')

@section('content')

    @php
        $highlightPosts = $posts->take(3); 
    @endphp

    @if($highlightPosts->count() > 0)
        <div x-data="{ 
                activeSlide: 0, 
                slides: {{ $highlightPosts->count() }},
                timer: null,
                startAutoSlide() {
                    this.timer = setInterval(() => {
                        this.next();
                    }, 6000); // Ganti slide tiap 6 detik
                },
                stopAutoSlide() {
                    clearInterval(this.timer);
                },
                next() {
                    this.activeSlide = (this.activeSlide === this.slides - 1) ? 0 : this.activeSlide + 1;
                },
                prev() {
                    this.activeSlide = (this.activeSlide === 0) ? this.slides - 1 : this.activeSlide - 1;
                }
             }" 
             x-init="startAutoSlide()"
             @mouseenter="stopAutoSlide()" 
             @mouseleave="startAutoSlide()"
             class="relative w-full h-[98vh] bg-gray-900 overflow-hidden group">

            @foreach($highlightPosts as $index => $post)
                @php 
                    $image = $post->thumbnail ? asset('storage/'.$post->thumbnail) : 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?q=80&w=2070&auto=format&fit=crop';
                @endphp

                <div x-show="activeSlide === {{ $index }}"
                     x-transition:enter="transition transform duration-1000 ease-in-out"
                     x-transition:enter-start="opacity-0 scale-110"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition transform duration-1000 ease-in-out absolute inset-0"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute inset-0 w-full h-full"
                     style="display: none;">
                    
                    {{-- Background Image --}}
                    <img src="{{ $image }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-60">
                    
                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/30"></div>

                    <div class="absolute bottom-0 left-0 w-full  p-8 md:p-20 z-10">
                        <div class="container mx-auto">
                            

                            <h2 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 leading-tight max-w-4xl drop-shadow-2xl">
                                {{ $post->title }}
                            </h2>

                            <div class="flex items-center gap-6 text-gray-300 text-sm md:text-base font-medium mb-8">
                                <span class="flex items-center gap-2">
                                    <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    {{ \Carbon\Carbon::parse($post->published_at)->format('d F Y') }}
                                </span>
                            </div>

                            <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full border border-white text-white font-bold hover:bg-white hover:text-black transition shadow-lg">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="absolute bottom-10 right-10 md:bottom-20 md:right-20 z-20 flex gap-4">
                <button @click="prev()" class="w-12 h-12 md:w-14 md:h-14 rounded-full border-2 border-white/30 text-white flex items-center justify-center hover:bg-white hover:text-black hover:border-white transition duration-300 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button @click="next()" class="w-12 h-12 md:w-14 md:h-14 rounded-full border-2 border-white/30 text-white flex items-center justify-center hover:bg-white hover:text-black hover:border-white transition duration-300 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </div>
    @endif

       
    </section>

    <div class="pt-24 pb-30 bg-white">
        <div class="container mx-auto px-6">
            
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-[11px] font-bold tracking-[0.2em] uppercase mb-3">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-green-600 transition">BERANDA</a>
                <span class="text-gray-300">-</span>
                <span class="text-green-600">BERITA</span>
            </div>

            {{-- Judul Utama --}}
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3 tracking-tight">
                Kabar Cianjur Terkini
            </h1>

            {{-- Deskripsi --}}
            <p class="text-gray-500 text-lg leading-relaxed max-w-2xl">
                Dapatkan informasi terbaru seputar pariwisata, budaya, dan event di Cianjur.
            </p>

        </div>
    </div>
        

    <section class="pb-24 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="group block h-full">
                    
                    <div class="bg-white rounded-[2rem] p-8 h-full border border-gray-100 shadow-sm hover:shadow-xl hover:border-green-100 hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                        
                        <div class="absolute top-0 left-0 w-1 h-0 bg-green-500 transition-all duration-500 group-hover:h-full"></div>

                        <div>
                          
                            <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                                <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-widest">
                                    {{ $post->category }}
                                </span>
                                <span class="text-gray-400 text-xs font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}
                                </span>
                            </div>

                            @if($post->thumbnail)
                                <div class="mb-6 rounded-2xl overflow-hidden h-48 w-full">
                                    <img src="{{ asset('storage/'.$post->thumbnail) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                </div>
                            @endif

                            {{-- Judul --}}
                            <h3 class="text-xl font-extrabold text-gray-900 mb-4 leading-tight group-hover:text-green-600 transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h3>

                            {{-- Cuplikan --}}
                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                        </div>

                        {{-- Tombol Baca --}}
                        <div class="flex items-center text-sm font-bold text-gray-900 group-hover:text-green-600 transition-colors mt-auto">
                            <span>Baca Selengkapnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </div>

                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-16 text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

@endsection