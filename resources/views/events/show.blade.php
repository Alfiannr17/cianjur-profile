@extends('layouts.app')

@section('content')

@php
    $posterUrl = $event->poster 
        ? asset('storage/'.$event->poster) 
        : 'https://via.placeholder.com/1200x600';
@endphp


<div class="absolute top-0 left-0 w-full h-[65vh] overflow-hidden z-0">
    <img src="{{ $posterUrl }}" 
         alt="{{ $event->title }}"
         class="w-full h-full object-cover brightness-110">

    <div class="absolute inset-0 bg-gradient-to-t from-white via-white/97 to-transparent"></div>
</div>

<div class="pt-40 pb-10 relative z-10 bg-transparent">
    <div class="container mx-auto px-6">

        

        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6 max-w-5xl drop-shadow-sm">
            {{ $event->title }}
        </h1>

        <div class="flex flex-wrap gap-6 text-gray-700 text-sm font-bold items-center">

            <div class="flex items-center gap-2 px-4 py-2 rounded-full">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span>{{ $event->location ?? 'Cianjur' }}</span>
            </div>

            <div class="flex items-center gap-2  px-4 py-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
</svg>

                <span>{{ \Carbon\Carbon::parse($event->start_date)->isoFormat('dddd, D MMMM Y') }}</span>
            </div>

        </div>
    </div>
</div>

<div class="bg-white pt-12 pb-24 relative z-10">
    <div class="container mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">

            <div class="lg:col-span-8">

                <div class="rounded-3xl overflow-hidden mb-10 shadow-lg group">
                    <img src="{{ $posterUrl }}" 
                         class="w-full h-auto object-cover transition duration-700 group-hover:scale-105"
                         alt="{{ $event->title }}">
                </div>

                <div class="prose prose-lg prose-yellow max-w-none text-gray-700 leading-relaxed mb-12 font-medium">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tentang Event</h3>
                    {!! nl2br(e($event->description)) !!}
                </div>

            </div>

            <aside class="lg:col-span-4 space-y-8">
                <div class="sticky top-32 space-y-8">

                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h3 class="text-xl font-extrabold text-gray-900 mb-6 border-b pb-4 border-gray-200">
                            Detail Event
                        </h3>

                        <div class="flex justify-between mb-4">
                            <span class="text-sm font-bold text-gray-600">Waktu</span>
                            <span class="font-bold text-gray-900">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }} WIB
                            </span>
                        </div>

                        <div class="flex justify-between mb-8">
                            <span class="text-sm font-bold text-gray-600">Tempat</span>
                            <span class="font-bold text-gray-900 text-right max-w-[160px]">
                                {{ $event->location }}
                            </span>
                        </div>

                        <a href="{{ route('events.index') }}"
                           class="block w-full text-center border border-gray-900 hover:bg-gray-900 hover:text-white text-black font-bold py-4 rounded-2xl transition">
                            Kembali ke Kalender
                        </a>
                    </div>

                    <div class="bg-blue-50 rounded-3xl p-6 border border-blue-100 text-center relative overflow-hidden">
                        <div class="absolute bottom-0 left-0 w-20 h-20 bg-blue-200 rounded-tr-full opacity-50"></div>

                        <h4 class="text-blue-900 font-bold mb-2 relative z-10">Ajak Teman Kamu!</h4>
                        <p class="text-xs text-blue-800/70 mb-4 font-medium relative z-10">
                            Bagikan event ini ke teman-temanmu.
                        </p>

                        <div class="flex justify-center gap-3 relative z-10">
                            <button class="w-10 h-10 bg-white rounded-full shadow-sm">FB</button>
                            <button class="w-10 h-10 bg-white rounded-full shadow-sm">WA</button>
                        </div>
                    </div>

                </div>
            </aside>

        </div>
    </div>
</div>

@endsection
