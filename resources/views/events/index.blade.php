@extends('layouts.app')

@section('content')

   
    @if($upcomingEvents->count() > 0)
        <div x-data="{ 
                activeSlide: 0, 
                slides: {{ $upcomingEvents->count() }},
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
             class="relative w-full h-[98vh] overflow-hidden bg-gray-900">

            @foreach($upcomingEvents as $index => $event)
                @php 
                    $poster = $event->poster ? asset('storage/'.$event->poster) : 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2070&auto=format&fit=crop';
                @endphp

                <div x-show="activeSlide === {{ $index }}"
                     x-transition:enter="transition transform duration-1000 ease-in-out"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition transform duration-1000 ease-in-out absolute inset-0"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute inset-0 w-full h-full"
                     style="display: none;"> 
                    
                    <img src="{{ $poster }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-black/10"></div>

                    <div class="absolute bottom-0 left-0 w-full p-8 md:p-20 text-white z-10">
                        <div class="container mx-auto">
                            
                            <div class="mb-4 animate-fade-in-up">
                                <span class="bg-yellow-400 text-black text-xs font-extrabold px-3 py-1 rounded-full uppercase tracking-widest">
                                    {{ $event->status == 'ongoing' ? 'Sedang Berlangsung' : 'Akan Datang' }}
                                </span>
                            </div>

                            <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-4 leading-tight max-w-4xl drop-shadow-lg">
                                {{ $event->title }}
                            </h2>

                            <div class="flex flex-col md:flex-row gap-4 md:gap-8 text-gray-200 text-lg md:text-xl font-medium">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $event->location }}
                                 
                                </span>
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d F Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="absolute bottom-10 right-10 md:bottom-20 md:right-20 z-20 flex gap-4">
                <button @click="prev()" class="w-12 h-12 md:w-14 md:h-14 rounded-full border-2 border-white/30 text-white flex items-center justify-center hover:bg-white hover:text-black hover:border-white transition duration-300 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next()" class="w-12 h-12 md:w-14 md:h-14 rounded-full border-2 border-white/30 text-white flex items-center justify-center hover:bg-white hover:text-black hover:border-white transition duration-300 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
                @foreach($upcomingEvents as $index => $event)
                    <button @click="activeSlide = {{ $index }}" 
                            :class="activeSlide === {{ $index }} ? 'bg-yellow-400 w-8' : 'bg-white/50 w-2'"
                            class="h-2 rounded-full transition-all duration-300"></button>
                @endforeach
            </div>

        </div>
    @else
        <div class="relative w-full h-[60vh] bg-gray-900 flex items-center justify-center overflow-hidden">
            <img src="https://images.unsplash.com/photo-1533174072545-e8d4aa97edf9?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40">
            <div class="relative z-10 text-center text-white p-6">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Event & Festival</h1>
                <p class="text-xl text-gray-300">Nantikan keseruan selanjutnya di Cianjur</p>
            </div>
        </div>
    @endif



        
    <div class="pt-24 ">
        <div class="container mx-auto px-6">
            
            <div class="flex items-center gap-2 text-[11px] font-bold tracking-[0.2em] uppercase mb-3">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-green-600 transition">BERANDA</a>
                <span class="text-gray-300">-</span>
                <span class="text-green-600">EVENT & FESTIVAL</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3 tracking-tight">
                Event & Festival Cianjur Terkini
            </h1>

            <p class="text-gray-500 text-lg leading-relaxed max-w-2xl">
                Dapatkan informasi terbaru seputar pariwisata, budaya, dan event di Cianjur.
            </p>

        </div>
    </div>
    
    <section class="py-24 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-6xl space-y-16">
            
            @if($upcomingEvents->count() > 0)
                <div class="grid grid-cols-1 gap-12">
                    @foreach($upcomingEvents as $index => $event)
                        @php 
                            $gradient = match($index % 4) {
                                0 => 'from-blue-500 to-cyan-400',
                                1 => 'from-purple-500 to-pink-500',
                                2 => 'from-orange-400 to-yellow-400',
                                3 => 'from-green-500 to-emerald-400',
                            };
                            $poster = $event->poster ? asset('storage/'.$event->poster) : 'https://via.placeholder.com/800x400';
                        @endphp

                        <div class="bg-white rounded-3xl shadow-sm overflow-hidden hover:shadow-md transition duration-500 group">
                          
                            <div class="h-14 bg-gradient-to-r {{ $gradient }} flex items-center px-8 justify-between">
                                <span class="text-white text-xs font-bold tracking-[0.2em] uppercase flex items-center gap-2">
                                    <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                    {{ $event->status == 'ongoing' ? 'Live Now' : 'Upcoming Event' }}
                                </span>
                                <span class="text-white/80 text-xs font-bold">#CianjurSeru</span>
                            </div>

                            <div class="p-0 md:p-8 grid grid-cols-1 lg:grid-cols-12 gap-0 md:gap-10 items-center">
                               
                                <div class="lg:col-span-5 h-72 md:h-80 w-full md:rounded-3xl overflow-hidden relative">
                                    <img src="{{ $poster }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                </div>

                                <div class="lg:col-span-7 p-8 lg:p-0 space-y-6">
                                    <div class="flex items-center gap-4 text-gray-500 text-sm font-bold">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ \Carbon\Carbon::parse($event->start_date)->isoFormat('dddd, D MMMM Y') }}
                                        </span>
                                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }} WIB
                                        </span>
                                    </div>

                                    <h3 class="text-3xl font-extrabold text-gray-900 leading-tight">
                                        {{ $event->title }}
                                    </h3>
                                    
                                    <p class="text-gray-600 line-clamp-3 leading-relaxed">
                                        {{ Str::limit($event->description, 200) }}
                                    </p>

                                    <div class="pt-4">
                                        <a href="{{ route('events.show', $event->slug) }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-full border border-gray-900 text-gray-900 font-bold  transition hover:bg-gray-900 hover:text-white transform group-hover:-translate-y-1">
                                            Lihat Detail
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($pastEvents->count() > 0)
                <div class="pt-16 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-400 mb-8">Dokumentasi Event Selesai</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($pastEvents as $event)
                            <a href="{{ route('events.show', $event->slug) }}" class="group block opacity-70 hover:opacity-100 transition">
                                <div class="aspect-square rounded-2xl overflow-hidden bg-gray-200 mb-3 relative">
                                    <img src="{{ $event->poster ? asset('storage/'.$event->poster) : '' }}" class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition duration-500">
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent"></div>
                                </div>
                                <h4 class="font-bold text-gray-800 text-sm group-hover:text-green-600 truncate">{{ $event->title }}</h4>
                                <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection