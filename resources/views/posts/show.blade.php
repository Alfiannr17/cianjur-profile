@extends('layouts.app')

@section('content')
    <div class="pt-32 pb-10 bg-white border-b border-gray-100">
        <div class="container mx-auto px-6">
            
            <span class="bg-green-100 text-green-700 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-wider mb-6 inline-block">
                {{ $post->category ?? 'Berita' }}
            </span>

            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6 max-w-5xl">
                {{ $post->title }}
            </h1>

            <div class="flex gap-4 text-gray-500 text-sm font-medium items-center">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 9v7.5" />
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($post->published_at)->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-white pt-12 pb-24">
        <div class="container mx-auto px-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                
                <div class="lg:col-span-8">
                    
                    @if($post->thumbnail)
                        <div class="rounded-3xl overflow-hidden mb-10 shadow-lg border border-gray-100">
                            <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
                        </div>
                    @endif

                    <article class="prose prose-lg prose-green max-w-none text-gray-700 leading-relaxed">
                        {!! $post->content !!}
                    </article>

                    <div class="mt-12 pt-8 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <span class="font-bold text-gray-900">Bagikan artikel ini:</span>
                        <div class="flex gap-3">
                            <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:opacity-90 transition shadow-sm hover:scale-110 transform duration-200">FB</button>
                            <button class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:opacity-90 transition shadow-sm hover:scale-110 transform duration-200">TW</button>
                            <button class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:opacity-90 transition shadow-sm hover:scale-110 transform duration-200">WA</button>
                        </div>
                    </div>

                </div>

                <aside class="lg:col-span-4 space-y-8">
                    
                    <div class="sticky top-32">
                        
                        <div class="flex items-center justify-between mb-6 pb-2 border-b border-gray-100">
                            <h3 class="text-xl font-extrabold text-gray-900 flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-green-500 rounded-full"></span>
                                Baca Juga
                            </h3>
                            <a href="{{ route('posts.index') }}" class="text-xs font-bold text-green-600 hover:text-green-800 transition">Lihat Semua</a>
                        </div>

                        <div class="flex flex-col gap-4">
                            @foreach($relatedPosts as $related)
                                <a href="{{ route('posts.show', $related->slug) }}" class="group block bg-gray-50 hover:bg-white rounded-2xl p-5 border border-transparent hover:border-green-100 hover:shadow-lg transition-all duration-300">
                                    <div class="flex flex-col gap-2">
                                    
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-green-600 bg-green-50 w-fit px-2 py-0.5 rounded">
                                            {{ $related->category ?? 'Berita' }}
                                        </span>

                                        <h4 class="font-bold text-gray-800 leading-snug group-hover:text-green-700 transition line-clamp-2">
                                            {{ $related->title }}
                                        </h4>

                                        <span class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            {{ \Carbon\Carbon::parse($related->published_at)->diffForHumans() }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                    </div>
                </aside>

            </div>

        </div>
    </div>

@endsection