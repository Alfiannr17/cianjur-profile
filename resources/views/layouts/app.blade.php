<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cianjur Visit - Jelajahi Keindahan Cianjur</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

 
    
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>

    <title>Cianjur Visit</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    

</head>
<body class=" antialiased text-gray-800 bg-gray-50">

    <header x-data="{ mobileMenuOpen: false }" class="fixed top-6 left-0 right-0 z-50 px-4 md:px-8 flex justify-center">

    <nav class="bg-white backdrop-blur-md border border-white/20 rounded-full shadow-lg shadow-black/5 py-3 px-6 w-full max-w-6xl flex items-center justify-between transition-all duration-300 relative">
        
        <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group">
            <img src="{{ asset('images/logo-cianjurvisit.png') }}" alt="CianjurVisit" class="h-8 md:h-10 w-auto object-contain group-hover:scale-105 transition duration-300">
            <div class="h-5 w-px bg-gray-300 "></div>
            <img src="{{ asset('images/logo-kedua.png') }}" alt="LogoKedua" class="h-6 md:h-8 w-auto object-contain  group-hover:scale-105 transition duration-300">
        </a>    

        <ul class="hidden lg:flex items-center gap-8 text-[12px] font-bold tracking-widest text-gray-600 uppercase">
            <li>
                <a href="{{ route('destinations.index') }}" class="hover:text-green-600 transition duration-300 relative group">
                    Destinasi
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('events.index') }}" class="hover:text-green-600 transition duration-300 relative group">
                    Event
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}" class="hover:text-green-600 transition duration-300 relative group">
                    Berita
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="#contact" class="hover:text-green-600 transition duration-300 relative group">
                    Kontak
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </li>
        </ul>

        <div class="flex items-center gap-3 md:gap-5 shrink-0">
            
            <div class="hidden md:flex items-center gap-2 text-xs font-bold text-gray-600 bg-gray-100/50 px-3 py-1.5 rounded-full border border-gray-200/50">
                <div class="w-4 h-4 rounded-full overflow-hidden shadow-sm">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg" alt="ID" class="w-full h-full object-cover">
                </div>
                <span>ID</span>
            </div>

            <a href="/admin/login" class="hidden md:flex group  transition-all duration-300   ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-500 group-hover:text-green-600 transition overflow-hidden">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
            </a>
            
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-600 hover:text-black transition focus:outline-none">
                <div class="w-6 h-6 relative flex items-center justify-center">
                    <span :class="{'rotate-45 translate-y-0': mobileMenuOpen, '-translate-y-1.5': !mobileMenuOpen}" class="absolute w-full h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
                    <span :class="{'opacity-0': mobileMenuOpen}" class="absolute w-full h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
                    <span :class="{'-rotate-45 translate-y-0': mobileMenuOpen, 'translate-y-1.5': !mobileMenuOpen}" class="absolute w-full h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
                </div>
            </button>

        </div>
    </nav>

    <div 
        x-show="mobileMenuOpen" 
        @click.away="mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-[-10px] scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-[-10px] scale-95"
        class="absolute top-20 left-4 right-4 md:left-auto md:right-8 md:w-80 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 overflow-hidden lg:hidden z-40"
        style="display: none;"
    >
        <div class="p-2 space-y-1">
            <a href="{{ route('destinations.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl hover:bg-green-50 hover:text-green-700 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                Destinasi Wisata
            </a>
            <a href="{{ route('events.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl hover:bg-green-50 hover:text-green-700 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                Event & Festival
            </a>
            <a href="{{ route('posts.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl hover:bg-green-50 hover:text-green-700 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                Berita Terbaru
            </a>
            <a href="#contact" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl hover:bg-green-50 hover:text-green-700 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                Hubungi Kami
            </a>
        </div>
        
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs font-semibold text-gray-400">Admin Area</span>
            <a href="/admin/login" class="text-xs font-bold text-green-600 hover:underline">
                Login Masuk &rarr;
            </a>
        </div>
    </div>

</header>

    <main>
        @yield('content')
    </main>


    <section id="contact" class="min-h-screen flex items-center py-20 bg-green-900 relative overflow-hidden">
        
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://thegorbalsla.com/wp-content/uploads/2019/01/Motif-Batik-Cianjur.jpg');"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class=" container mx-auto relative z-10 flex flex-col md:flex-row items-center gap-12">
                
                <div class="space-y-8 text-white md:w-1/2">
                    <div>
                        <span class="text-yellow-400 font-bold tracking-[0.2em] uppercase text-xs block mb-2">Layanan Pengunjung</span>
                        <h2 class="text-4xl md:text-5xl font-extrabold leading-tight">Butuh Bantuan atau Punya Masukan?</h2>
                        <p class="text-gray-400 mt-4 text-lg leading-relaxed">
                            Kami siap mendengar pengalaman Anda. Sampaikan kritik, saran, atau pengaduan untuk pariwisata Cianjur yang lebih baik.
                        </p>
                    </div>

                    <div class="space-y-6 pt-4">
                        <div class="flex items-start gap-4">
                            <div class="bg-green-800/50 p-3 rounded-full shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Kantor Dinas Pariwisata</h4>
                                <p class="text-gray-400">Jl. Slamet Riyadi No.10, Cianjur, Jawa Barat</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-green-800/50 p-3 rounded-full shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Email Resmi</h4>
                                <p class="text-gray-400">disparbud@cianjurkab.go.id</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-green-800/50 p-3 rounded-full shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Call Center</h4>
                                <p class="text-gray-400">(0263) 123456</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-green-800/50 rounded-3xl p-8 md:p-10 shadow-sm relative md:w-1/2">
                    <h3 class="text-2xl font-extrabold text-yellow-400 mb-6">Formulir Pengaduan</h3>
                    
                    <form action="{{ route('complaint.store') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                                <label class="block text-sm font-bold text-white mb-2">Nama Lengkap</label>
                                <input type="text" name="name" required class="w-full text-white border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition" placeholder="Nama Lengkap Anda">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-white mb-2">Alamat Email</label>
                            <input type="email" name="email" required class="w-full text-white border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition" placeholder="email@contoh.com">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-white mb-2">Pesan / Pengaduan</label>
                            <textarea name="message" rows="4" required class="w-full text-white border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition resize-none" placeholder="Tuliskan pengalaman atau keluhan Anda disini..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-600 text-white font-bold py-4 rounded-xl  hover:-translate-y-1 transition duration-300">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>


<section class="py-20 bg-white border-t border-gray-100">
    <div class="container mx-auto px-6">
        
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Galeri Foto</h2>
                <p class="text-gray-500 mt-2">Dokumentasi kegiatan dan keindahan Cianjur</p>
            </div>
        </div>

        <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
            
            @isset($galleries) 


            @forelse($galleries as $gal)
                <div class="break-inside-avoid mb-4">
                    <div class="group relative rounded-2xl overflow-hidden cursor-pointer">
                        
                        {{-- Tampilkan Gambar --}}
                        {{-- Pastikan nama kolom di database adalah file_path --}}
                        <img src="{{ asset('storage/' . $gal->file_path) }}" 
                             class="w-full h-auto object-cover transform transition duration-700 group-hover:scale-110" 
                             alt="{{ $gal->title ?? 'Galeri Foto' }}">

                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-300"></div>
                        
                        @if($gal->title)
                        <div class="absolute bottom-0 left-0 p-4 opacity-0 group-hover:opacity-100 transition duration-300">
                            <span class="bg-white/90 text-gray-900 text-xs font-bold px-2 py-1 rounded shadow">
                                {{ $gal->title }}
                            </span>
                        </div>
                        @endif

                    </div>
                </div>
            @empty
                <div class="col-span-full w-full text-center py-20 bg-gray-50 rounded-2xl">
                    {{-- Debugging Text: Biar tau kalau masuk sini --}}
                    <p class="text-red-500 font-bold">Data Galeri Kosong / Variabel Tidak Terbaca.</p>
                </div>
            @endforelse

            @endisset

        </div>

    </div>
</section>

    <footer class="bg-[#1a202c] text-white pt-20 pb-10 mt-0 border-t border-gray-800">
        <div class="container mx-auto px-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-16">
                
                <div class="lg:col-span-2 space-y-6">
                    <a href="{{ route('home') }}" class="inline-block">
                       
                        <img src="{{ asset('images/logo-cianjurvisit.png') }}" alt="Cianjur Visit" class="h-24 w-auto object-contain">
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                        Platform resmi pariwisata Kabupaten Cianjur. Temukan keindahan alam, kekayaan budaya, dan pengalaman tak terlupakan di tanah Pasundan.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-6 text-white tracking-wide">Destinasi</h4>
                    <ul class="space-y-4 text-gray-400 text-sm font-medium">
                        <li><a href="{{ route('destinations.index', ['category' => 'Alam']) }}" class="hover:text-green-400 transition duration-300">Wisata Alam</a></li>
                        <li><a href="{{ route('destinations.index', ['category' => 'Sejarah']) }}" class="hover:text-green-400 transition duration-300">Wisata Sejarah</a></li>
                        <li><a href="{{ route('destinations.index', ['category' => 'Kuliner']) }}" class="hover:text-green-400 transition duration-300">Wisata Kuliner Khas</a></li>
                        
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-6 text-white tracking-wide">Informasi</h4>
                    <ul class="space-y-4 text-gray-400 text-sm font-medium">
                        <li><a href="{{ route('events.index') }}" class="hover:text-green-400 transition duration-300">Kalender Event</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-green-400 transition duration-300">Berita Terbaru</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-green-400 transition duration-300">Tentang Kami</a></li>
                        <li><a href="#contact" class="hover:text-green-400 transition duration-300">Pusat Bantuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-6 text-white tracking-wide">Ikuti Kami</h4>
                    <ul class="space-y-4 text-gray-400 text-sm font-medium">
                        <li>
                            <a href="#" class="flex items-center gap-3 hover:text-green-400 transition duration-300">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Facebook
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 hover:text-green-400 transition duration-300">
                                <span class="w-2 h-2 bg-pink-500 rounded-full"></span> Instagram
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 hover:text-green-400 transition duration-300">
                                <span class="w-2 h-2 bg-red-500 rounded-full"></span> YouTube
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 hover:text-green-400 transition duration-300">
                                <span class="w-2 h-2 bg-black border border-gray-600 rounded-full"></span> TikTok
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Dinas Pariwisata Cianjur. All rights reserved.
                </p>
                
                <div class="flex items-center gap-6">
                    <a href="#" class="text-gray-500 hover:text-white text-xs transition">Privacy Policy</a>
                    <a href="#" class="text-gray-500 hover:text-white text-xs transition">Terms of Service</a>
                </div>
            </div>

        </div>
    </footer>

</body>
</html>