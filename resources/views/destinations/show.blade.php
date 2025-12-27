@extends('layouts.app')

@section('content')

    @php
        $mainImage = $destination->images->first()->image_path ?? null;
        $mainImageUrl = $mainImage ? asset('storage/'.$mainImage) : 'https://via.placeholder.com/1200x600';
    @endphp

    <div class="absolute top-0 left-0 w-full h-[65vh] overflow-hidden z-0">
       
        <img src="{{ $mainImageUrl }}" alt="{{ $destination->name }}" 
             class="w-full h-full object-cover filter brightness-110">
        
        
        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/98 to-transparent"></div>
    </div>


    <div class="pt-40 pb-10 relative z-10 bg-transparent">
        <div class="container mx-auto px-6">
            
            
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6 max-w-5xl drop-shadow-sm">
                {{ $destination->name }}
            </h1>

            <div class="flex flex-wrap gap-6 text-gray-700 text-sm font-bold items-center">
                <div class="flex items-center gap-2 bg-white/50 backdrop-blur-md px-4 py-2 rounded-full">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>{{ $destination->address ?? 'Cianjur, Jawa Barat' }}</span>
                </div>
            </div>

        </div>
    </div>


    
    <div class="bg-white pt-12 pb-24 relative z-10">
        <div class="container mx-auto px-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                
                <div class="lg:col-span-8">
                    
                    <div class="rounded-3xl overflow-hidden mb-10 shadow-lg group">
                        <img src="{{ $mainImageUrl }}" alt="{{ $destination->name }}" 
                             class="w-full h-auto object-cover transform transition duration-700 group-hover:scale-105">
                    </div>
                    
                    <div class="prose prose-lg prose-green max-w-none text-gray-700 leading-relaxed mb-12 font-medium">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tentang Destinasi</h3>
                        {!! nl2br(e($destination->description)) !!}
                    </div>

                    @if($destination->images->count() > 1)
                        <div class="border-t border-gray-100 pt-10">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="w-2 h-8 bg-green-500 rounded-full"></span>
                                Galeri Foto
                            </h3>
                            
                            <div class="columns-2 md:columns-3 gap-4 space-y-4">
                                @foreach($destination->images as $img)
                                    <div class="break-inside-avoid group relative rounded-2xl overflow-hidden cursor-pointer bg-gray-100 shadow-sm hover:shadow-md transition">
                                        <img src="{{ asset('storage/'.$img->image_path) }}" 
                                             class="w-full h-auto object-cover transition duration-700 group-hover:scale-105"
                                             alt="Gallery">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-300"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <aside class="lg:col-span-4 space-y-8">
                    
                    <div class="sticky top-32 space-y-8">
                        
                        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                            
                            
                            <h3 class="text-xl font-extrabold text-gray-900 mb-6 border-b border-gray-100 pb-4 relative z-10">
                                Informasi Kunjungan
                            </h3>
                            
                            <div class="flex justify-between items-center mb-6 relative z-10">
                                <div class="flex items-center gap-3">
                                    
                                    <span class="text-gray-600 text-sm font-bold">Jam Buka</span>
                                </div>
                                <span class="font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($destination->open_time)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($destination->close_time)->format('H:i') }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center mb-8 relative z-10">
                                <div class="flex items-center gap-3">
                                    
                                    <span class="text-gray-600 text-sm font-bold">Tiket Masuk</span>
                                </div>
                                <span class="font-extrabold text-xl text-green-700">
                                    Rp {{ number_format($destination->ticket_price ?? 0, 0, ',', '.') }}
                                </span>
                            </div>

                           
                            @if($destination->latitude && $destination->longitude)
                                <a href="http://googleusercontent.com/maps.google.com/?q={{ $destination->latitude }},{{ $destination->longitude }}" 
                                   target="_blank"
                                   class="group relative z-10 block w-full text-center border border-gray-900 hover:text-white hover:bg-gray-900 text-gray-900 font-bold py-4 rounded-2xl transition  hover:shadow-green-200 hover:-translate-y-1">
                                    Buka di Google Maps
                                </a>
                            @else
                                <button disabled class="relative z-10 block w-full text-center bg-gray-100 text-gray-400 font-bold py-4 rounded-2xl cursor-not-allowed">
                                    Lokasi Belum Tersedia
                                </button>
                            @endif
                        </div>

                        <div class="bg-yellow-50 rounded-3xl p-6 border border-yellow-100 text-center relative overflow-hidden">
                            <div class="absolute bottom-0 left-0 w-20 h-20 bg-yellow-200 rounded-tr-full opacity-50"></div>
                            
                            <h4 class="text-yellow-800 font-bold mb-2 relative z-10">Ajak Teman Kamu!</h4>
                            <p class="text-xs text-yellow-700/80 mb-4 font-medium leading-relaxed relative z-10">
                                Bagikan keindahan destinasi ini ke media sosialmu.
                            </p>
                            
                            <div class="flex justify-center gap-3 relative z-10">
                                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-600 shadow-sm hover:scale-110 transition">FB</button>
                                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-green-500 shadow-sm hover:scale-110 transition">WA</button>
                            </div>
                        </div>

                    </div>
                </aside>

            </div>

        </div>
    </div>

@endsection