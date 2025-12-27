@extends('layouts.app')

@section('content')

    <section class="relative h-screen bg-gray-900 overflow-hidden" id="beranda">
        
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover">
            <source src="{{ asset('videos/hero-1.mp4') }}" type="video/mp4">
        </video>

        
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/30"></div>


        <div class="relative z-10 container mx-auto px-6 h-full flex flex-col justify-end pb-24 md:pb-32">
            
                
                <div class="flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12">
                    
                    <div class="text-center md:text-left flex-1 space-y-4">
                        

                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white tracking-tight leading-none drop-shadow-xl">
                            SENSATIONAL <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-green-400 filter drop-shadow-lg">
                                CIANJUR
                            </span>
                        </h1>
                        
                        <p class="text-gray-200 text-lg font-medium max-w-2xl leading-relaxed drop-shadow-md">
                            Temukan surga tersembunyi, kekayaan budaya, dan pesona alam yang memukau di tanah Pasundan.
                        </p>
                    </div>

                    <div class="shrink-0 w-full md:w-auto">
                        <a href="#destinasi" class="group relative flex items-center justify-center gap-4 bg-green-600 hover:bg-green-500 text-white text-lg font-bold py-2 px-6 rounded-full transition-all duration-300 shadow-[0_0_40px_rgba(22,163,74,0.6)] hover:shadow-[0_0_60px_rgba(22,163,74,0.8)] hover:-translate-y-2 overflow-hidden border border-green-400/50">
                            
                            
                            <span class="relative z-10  text-sm">Mulai Jelajahi</span>
                            
                            <div class="relative z-10 bg-white/20 p-2 rounded-full group-hover:bg-white group-hover:text-green-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:rotate-45 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

    </section>


    <section id="destinasi" class="min-h-screen flex items-center py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                
                <div class="lg:w-1/3 space-y-8 relative z-10">
                    <div>
                        <span class="text-green-600 font-bold tracking-[0.2em] uppercase text-sm block mb-2">Mau Kemana?</span>
                        <h2 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-[1.1]">
                            Pilih Gaya <br> Liburanmu.
                        </h2>
                    </div>
                    
                    <p class="text-gray-500 text-lg leading-relaxed">
                        Cianjur menawarkan ragam wisata yang memukau. Dari kesejukan pegunungan, jejak sejarah yang mendalam, hingga cita rasa kuliner legendaris. 
                        <br><br>
                        Temukan kategori wisata yang paling pas dengan kepribadianmu.
                    </p>

                    <a href="{{ route('destinations.index') }}" class="group inline-flex items-center gap-3 px-8 py-4 rounded-full border-2 border-gray-900 text-gray-900 font-bold hover:bg-gray-900 hover:text-white transition-all duration-300">
                        <span>Lihat Semua Destinasi</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>

                <div class="lg:w-2/3 w-full">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto md:h-[500px]">
                        
                        @foreach($destinationCategories as $cat)
                        @php 
                            $img = $cat->images->first()->image_path ?? null;
                            $url = $img ? asset('storage/'.$img) : 'https://via.placeholder.com/400x800';
                            
                            $color = match($cat->category) {
                                'Alam' => 'bg-green-500',
                                'Sejarah' => 'bg-yellow-500',
                                'Kuliner' => 'bg-orange-500',
                                default => 'bg-blue-500'
                            };
                        @endphp

                        <a href="{{ route('destinations.index', ['category' => $cat->category]) }}" class="group relative block w-full h-96 md:h-full rounded-[2rem] overflow-hidden shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
                            
                            <img src="{{ $url }}" alt="{{ $cat->category }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>

                            <div class="absolute bottom-0 left-0 w-full p-8 flex flex-col items-start">
                                <span class="{{ $color }} text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 backdrop-blur-sm bg-opacity-90">
                                    {{ $cat->category }}
                                </span>
                                <h3 class="text-white text-2xl font-bold mb-4 group-hover:text-green-400 transition-colors">
                                    Wisata {{ $cat->category }}
                                </h3>
                                
                                <div class="inline-flex items-center text-white text-sm font-bold border border-white/30  px-4 py-2 rounded-full backdrop-blur-md hover:bg-white hover:text-black transition-all">
                                    Jelajahi
                                </div>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Kabar Cianjur</h2>
                    <p class="text-gray-500 mt-2">Update berita dan informasi terkini</p>
                </div>
                <a href="{{ route('posts.index') }}" class="hidden md:flex items-center text-green-600 font-bold hover:text-green-800 transition">
                    Lihat Berita <span class="ml-2">&rarr;</span>
                </a>
            </div>

            <div class="flex overflow-x-auto space-x-6 pb-8 snap-x no-scrollbar">
                @foreach($latestPosts as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="flex-shrink-0 w-80 md:w-96 snap-center group">
                    <div class="bg-white rounded-3xl p-8 h-full border border-gray-100 shadow-sm  hover:shadow-lg hover:-translate-y-1 transition duration-300 flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1 h-0 bg-green-400 transition-all duration-300 group-hover:h-full"></div>
                        <div>
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                                <span class="text-green-600 text-[10px] font-bold uppercase tracking-widest">{{ $post->category }}</span>
                                <span class="text-gray-400 text-[10px] font-medium">{{ $post->created_at->format('d M Y') }}</span>
                            </div>

                            @if($post->thumbnail)
                                <div class="mb-6 rounded-2xl overflow-hidden h-48 w-full">
                                    <img src="{{ asset('storage/'.$post->thumbnail) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                </div>
                            @endif
                            <h3 class="text-xl font-extrabold text-gray-900 mb-3 leading-tight group-hover:text-green-700 transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>
                        </div>
                        <div class="flex items-center text-sm font-bold text-gray-900 group-hover:text-green-600 transition-colors mt-auto">
                            <span>Baca</span>
                            <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Event & Aktivitas</h2>
                    <p class="text-gray-500 mt-2">Jangan lewatkan keseruan di Cianjur</p>
                </div>
                <a href="{{ route('events.index') }}" class="hidden md:flex items-center text-green-600 font-bold hover:text-green-800 transition">
                    Lihat Agenda <span class="ml-2">&rarr;</span>
                </a>
            </div>

            <div class="flex overflow-x-auto space-x-6 pb-8 snap-x no-scrollbar">
                
                @forelse($events as $event)
                    <a href="{{ route('events.show', $event->slug) }}" class="flex-shrink-0 w-72 snap-center group cursor-pointer block">
                        <div class="relative rounded-[2rem] overflow-hidden aspect-[3/4] shadow-md hover:shadow-xl transition-all duration-300">
                            
                            @php
                                $poster = $event->poster ? asset('storage/'.$event->poster) : 'https://via.placeholder.com/600x800?text=No+Poster';
                            @endphp
                            <img src="{{ $poster }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            
                            <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/90 via-black/50 to-transparent pt-20">
                                
                                @if($event->status == 'ongoing')
                                    <span class="bg-green-500 text-white text-[10px] font-bold px-2 py-1 rounded-full mb-2 inline-block uppercase tracking-wide animate-pulse">
                                        Sedang Berlangsung
                                    </span>
                                @else
                                    <span class="bg-yellow-400 text-black text-[10px] font-bold px-2 py-1 rounded-full mb-2 inline-block uppercase tracking-wide">
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                    </span>
                                @endif

                                <h3 class="text-white font-bold text-xl leading-tight mb-1 group-hover:text-yellow-400 transition-colors">
                                    {{ $event->title }}
                                </h3>
                                
                                <p class="text-gray-300 text-xs flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $event->location }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="w-full py-10 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 font-medium">Belum ada event mendatang.</p>
                    </div>
                @endforelse

            </div>
            
            <div class="mt-4 text-center md:hidden">
                <a href="{{ route('events.index') }}" class="text-sm font-bold text-green-600">Lihat Semua Event &rarr;</a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-green-900 text-white relative overflow-hidden">
        
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://thegorbalsla.com/wp-content/uploads/2019/01/Motif-Batik-Cianjur.jpg');"></div>
        
        <div class="container mx-auto px-6 relative z-10 flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-yellow-400/20 rounded-[2.5rem] blur-lg"></div>
                    <img src="https://th.bing.com/th/id/R.ddb15b04db3a663441712e021bf729d0?rik=A9CvxsbEWPQaDQ&riu=http%3a%2f%2fassets.kompasiana.com%2fitems%2falbum%2f2022%2f10%2f11%2f20210418-093208-6344c72e4addee6536033b02.jpg%3ft%3do%26v%3d1200&ehk=aLGsSCJ%2b%2b4yyEeADRu1Isupoar0Q1HUgFwY4ANJo2Uk%3d&risl=&pid=ImgRaw&r=0" alt="Masjid Agung Cianjur" class="relative rounded-[2.5rem] shadow-2xl border-4 border-yellow-400/30 transform rotate-2 hover:rotate-0 transition duration-500">
                </div>
            </div>
            <div class="md:w-1/2">
                <span class="text-yellow-400 font-bold tracking-widest uppercase mb-2 block">Tentang Kota Kami</span>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Cianjur: Gerbang <br>Pasundan</h2>
                <p class="text-gray-300 text-lg leading-relaxed mb-8">
                    Kabupaten Cianjur dikenal dengan filosofi <strong>Ngaos, Mamaos, Maenpo</strong>. 
                    Menyimpan sejuta pesona alam mulai dari pegunungan sejuk di Cipanas hingga pantai eksotis di Selatan.
                    Pusat penghasil beras Pandanwangi terbaik di Indonesia.
                </p>
                
                <div class="grid grid-cols-3 gap-4 mb-10">
                    <div class="text-center bg-green-800/50 p-4 rounded-2xl border border-green-700/50">
                        <span class="block text-3xl font-bold text-yellow-400">75+</span>
                        <span class="text-xs text-gray-300 font-medium">Wisata Alam</span>
                    </div>
                    <div class="text-center bg-green-800/50 p-4 rounded-2xl border border-green-700/50">
                        <span class="block text-3xl font-bold text-yellow-400">32</span>
                        <span class="text-xs text-gray-300 font-medium">Kecamatan</span>
                    </div>
                    <div class="text-center bg-green-800/50 p-4 rounded-2xl border border-green-700/50">
                        <span class="block text-3xl font-bold text-yellow-400">100%</span>
                        <span class="text-xs text-gray-300 font-medium">Keindahan</span>
                    </div>
                </div>

                <a href="#" class="inline-block bg-yellow-400 text-green-900 px-8 py-4 rounded-full font-bold hover:bg-white hover:text-black transition shadow-lg hover:shadow-yellow-400/50">Selengkapnya Tentang Cianjur</a>
            </div>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

@endsection