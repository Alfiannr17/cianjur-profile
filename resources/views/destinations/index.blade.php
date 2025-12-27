@extends('layouts.app')

@section('content')

    
    @php
        $sliderItems = $groupedDestinations->map(function($items) {
            return $items->first();
        })->values();
    @endphp

    @if($sliderItems->count() > 0)
        <div x-data="{ 
                activeSlide: 0, 
                slides: {{ $sliderItems->count() }},
                timer: null,
                startAutoSlide() {
                    this.timer = setInterval(() => {
                        this.next();
                    }, 5000); 
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

            @foreach($sliderItems as $index => $item)
                @php 
                    $image = $item->images->first() ? asset('storage/'.$item->images->first()->image_path) : 'https://images.unsplash.com/photo-1596423736768-46cb5b263c9b?q=80&w=2070&auto=format&fit=crop';
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
                    
                    <img src="{{ $image }}" alt="{{ $item->name }}" class="w-full h-full object-cover opacity-70">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/30"></div>

                    <div class="absolute bottom-0 left-0 w-full  p-8 md:p-20 z-10">
                        <div class="container mx-auto">
                            

                            <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-4 leading-tight max-w-4xl drop-shadow-2xl">
                                {{ $item->name }}
                            </h2>

                            <div class="flex items-center gap-6 text-gray-200 text-lg font-medium mb-8">
                                <span class="flex items-center gap-2">
                                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    Cianjur, Jawa Barat
                                </span>
                                <span class="flex items-center gap-2">
                                    -
                                </span>
                                <span class="flex items-center gap-2">
                                    Wisata {{ $item->category }}
                                </span>
                            </div>

                            <a href="{{ route('destinations.show', $item->slug) }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full border border-white text-white font-bold hover:bg-white hover:text-black transition shadow-lg">
                                Jelajahi Sekarang
                                
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

    
    <div class="py-24 min-h-screen space-y-24 container mx-auto px-6">
        
        <div class=" pb-12 ">
            <div class="container mx-auto">
                
                <div class="flex items-center gap-2 text-[11px] font-bold tracking-[0.2em] uppercase mb-3">
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-green-600 transition">BERANDA</a>
                    <span class="text-gray-300">-</span>
                    <span class="text-green-600">DESTINASI</span>
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3 tracking-tight">
                    Destinasi Wisata Terbaik di Cianjur
                </h1>

                {{-- Deskripsi --}}
                <p class="text-gray-500 text-lg leading-relaxed max-w-2xl">
                    Jelajahi berbagai destinasi wisata menarik di Cianjur, mulai dari alam, budaya, hingga kuliner yang menggugah selera.
                </p>

            </div>
        </div>

        @foreach($groupedDestinations as $category => $items)
            @if($items->count() > 0)
                
                {{-- Container Grid --}}
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center border-b border-gray-100 pb-20 last:border-0 last:pb-0">
                    
                    <div class="lg:col-span-5 space-y-8">
                        <div>
                            
                            <h2 class="text-5xl font-extrabold text-gray-900 leading-tight">
                                {{ $category }}
                            </h2>
                        </div>
                        
                        <p class="text-gray-600 leading-relaxed text-lg">
                            {{ $descriptions[$category] ?? 'Nikmati keindahan wisata '.$category.' terbaik di Cianjur. Destinasi pilihan yang menawarkan pengalaman tak terlupakan.' }}
                        </p>
                        
                        <a href="{{ route('destinations.index', ['category' => $category]) }}" 
                           class="group inline-flex items-center gap-3 px-8 py-4 border border-gray-900 rounded-full hover:bg-gray-900 text-gray-900 font-semibold hover:text-white transition-all duration-300 hover:shadow-green-200">
                           <span>Lihat Semua {{ $category }}</span>
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                           </svg>
                        </a>
                    </div>

                    <div class="lg:col-span-4 h-[400px]">
                        @php $first = $items->first(); @endphp
                        <a href="{{ route('destinations.show', $first->slug) }}" class="group relative block w-full h-full rounded-[2.5rem] overflow-hidden shadow-2xl transition-transform hover:-translate-y-2">
                            <img src="{{ $first->images->first() ? asset('storage/'.$first->images->first()->image_path) : 'https://via.placeholder.com/600x800' }}" 
                                 class="w-full h-full object-cover transition duration-1000 group-hover:scale-110" alt="{{ $first->name }}">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition"></div>
                            <div class="absolute bottom-0 left-0 w-full p-8 text-white">
                                <h3 class="text-2xl font-bold leading-tight mb-2">{{ $first->name }}</h3>
                                <div class="h-1 w-12 bg-yellow-400 rounded-full group-hover:w-20 transition-all duration-500"></div>
                            </div>
                        </a>
                    </div>

                    <div class="lg:col-span-3 h-[400px]">
                        @if($items->count() > 1)
                            @php $second = $items->skip(1)->first(); @endphp
                            <a href="{{ route('destinations.show', $second->slug) }}" class="group relative block w-full h-full rounded-[2.5rem] overflow-hidden shadow-xl transition-transform hover:-translate-y-2">
                                <img src="{{ $second->images->first() ? asset('storage/'.$second->images->first()->image_path) : 'https://via.placeholder.com/400x300' }}" 
                                     class="w-full h-full object-cover transition duration-1000 group-hover:scale-110 filter grayscale group-hover:grayscale-0" alt="{{ $second->name }}">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition"></div>
                                <div class="absolute bottom-0 left-0 w-full p-6 text-white">
                                    <h3 class="text-lg font-bold leading-tight">{{ $second->name }}</h3>
                                </div>
                            </a>
                        @else
                            <div class="w-full h-full rounded-3xl bg-gray-50 border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span class="text-xs font-bold uppercase tracking-widest opacity-50">Segera Hadir</span>
                            </div>
                        @endif
                    </div>

                </section>
            @endif
        @endforeach

    </div>
@endsection