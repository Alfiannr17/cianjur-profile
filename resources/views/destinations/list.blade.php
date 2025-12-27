@extends('layouts.app')

@section('content')

    
    @php
        
        $sliderItems = $destinations->take(5);
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
                    
                    
                    <img src="{{ $image }}" alt="{{ $item->name }}" class="w-full h-full object-cover opacity-80">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/30"></div>

                    <div class="absolute bottom-0 left-0 w-full p-8 md:p-20 z-10">
                        <div class="container mx-auto">
                            

                            <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-4 leading-tight max-w-4xl drop-shadow-2xl">
                                {{ $item->name }}
                            </h2>

                            <div class="flex items-center gap-6 text-gray-200 text-lg font-medium mb-8">
                                <span class="flex items-center gap-2">
                                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    {{ $item->kode_kecamatan }} Cianjur, Jawa Barat
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

    

    

    <div class="pt-24 pb-24">
        <div class="container mx-auto px-6">
            
            <div class="flex items-center gap-2 text-[11px] font-bold tracking-[0.2em] uppercase mb-3">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-green-600 transition">BERANDA</a>
                <span class="text-gray-300">-</span>
                <a href="{{ route('destinations.index') }}" class="text-gray-400 hover:text-green-600 transition">DESTINASI</a>
                <span class="text-gray-300">-</span>
                <span class="text-green-600">WISATA {{ request('category') ? request('category') : 'Temukan Surga Tersembunyi' }}</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3 tracking-tight">
                Destinasi Wisata Terbaik di Cianjur
            </h1>

            <p class="text-gray-500 text-lg leading-relaxed max-w-2xl">
                Jelajahi berbagai destinasi wisata menarik di Cianjur, mulai dari alam, budaya, hingga kuliner yang menggugah selera.
            </p>

        </div>
    </div>

    <section class="pb-24 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-5xl space-y-12">
            
            @forelse($destinations as $index => $dest)
                @php 
                    $gradient = match($index % 4) {
                        0 => 'from-yellow-400 to-green-500', 
                        1 => 'from-blue-500 to-indigo-600',   
                        2 => 'from-orange-500 to-red-500',    
                        3 => 'from-purple-500 to-pink-500',   
                    };

                    $img = $dest->images->first()->image_path ?? null;
                    $url = $img ? asset('storage/'.$img) : 'https://via.placeholder.com/800x600';
                @endphp

                <div class="bg-white rounded-3xl shadow-md overflow-hidden transform hover:-translate-y-1 transition duration-500">
                    
                    <div class="h-16 bg-gradient-to-r {{ $gradient }} flex items-center px-8 md:px-12">
                        <div class="flex items-center text-white gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 opacity-80">
                                <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-bold tracking-widest uppercase text-xs md:text-sm">
                                {{ $dest->name }}
                            </span>
                        </div>
                    </div>

                    <div class="p-8 md:p-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        
                        <div class="h-56 md:h-64 lg:h-72 w-full overflow-hidden rounded-2xl shadow-sm border border-gray-100">
                            <img src="{{ $url }}" alt="{{ $dest->name }}" class="w-full h-full object-cover transform hover:scale-110 transition duration-700">
                        </div>

                        <div class="space-y-5">
                            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 leading-tight">
                                {{ $dest->name }} 
                                <span class="block text-gray-400 font-medium text-lg mt-1">Wisata {{ $dest->category }}</span>
                            </h2>
                            
                            <p class="text-gray-500 leading-relaxed text-base line-clamp-3">
                                {{ Str::limit(strip_tags($dest->description), 150) }}
                            </p>

                            <div class="pt-2">
                                <a href="{{ route('destinations.show', $dest->slug) }}" 
                                   class="inline-block px-8 py-3 rounded-full border border-gray-900 font-bold text-gray-900 hover:bg-gray-900 hover:text-white transition-all duration-300 text-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            @empty
                
                <div class="text-center py-20 bg-white rounded-3xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <h3 class="text-lg font-bold text-gray-900">Belum ada destinasi</h3>
                    <p class="text-gray-500 mt-2 text-sm">Coba pilih kategori lain atau kembali nanti.</p>
                </div>

            @endforelse

            <div class="mt-16 flex justify-center">
                {{ $destinations->links() }}
            </div>

        </div>
    </section>

@endsections