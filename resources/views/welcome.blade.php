<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} - Kelola Proyek Tanpa Drama</title>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>body { font-family: 'Outfit', sans-serif; }</style>
    </head>
    <body class="antialiased bg-[#F2F4F3] text-[#344E41]">
        
        <nav class="flex items-center justify-between px-8 py-6 max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#344E41] flex items-center justify-center text-white shadow-lg transform -rotate-3">
                    <i class="fas fa-layer-group"></i>
                </div>
                <span class="text-2xl font-black tracking-tight">Tuntas<span class="text-[#588157]">.in</span></span>
            </div>
            
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-bold text-[#344E41] hover:text-[#588157] transition flex items-center gap-2">
                            <span>Dashboard</span>
                        </a>

                        <span class="text-[#A3B18A] text-xs">|</span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-xl border border-[#A3B18A] text-[#588157] text-sm font-bold hover:bg-[#588157] hover:text-white transition shadow-sm bg-white">
                                Ganti Akun
                            </button>
                        </form>

                    @else
                        <a href="{{ route('login') }}" class="font-bold text-[#344E41] hover:text-[#588157] hidden sm:block">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-[#344E41] hover:bg-[#588157] text-white px-6 py-2.5 rounded-xl font-bold shadow-lg transition transform hover:-translate-y-0.5">
                            Daftar Gratis
                        </a>
                    @endauth
                @endif
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-6 py-20 lg:py-32 flex flex-col lg:flex-row items-center gap-16">
            
            <div class="lg:w-1/2 space-y-8 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 bg-[#A3B18A]/20 px-4 py-2 rounded-full text-[#588157] font-bold text-xs uppercase tracking-widest border border-[#588157]/20">
                    <span class="w-2 h-2 rounded-full bg-[#588157] animate-pulse"></span> v1.0 Release
                </div>
                
                <h1 class="text-5xl lg:text-7xl font-black leading-tight tracking-tight text-[#344E41]">
                    Kelola Proyek <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#588157] to-[#A3B18A]">Tanpa Drama.</span>
                </h1>
                
                <p class="text-lg text-[#5F6F65] leading-relaxed max-w-lg">
                    Platform manajemen tugas yang simpel, cepat, dan terintegrasi langsung dengan WhatsApp Anda. Ucapkan selamat tinggal pada deadline yang terlewat.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="flex items-center justify-center gap-3 bg-[#344E41] hover:bg-[#2A3E34] text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl shadow-[#344E41]/20 transition transform hover:-translate-y-1">
                            Buka Dashboard
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="flex items-center justify-center gap-3 bg-[#344E41] hover:bg-[#2A3E34] text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl shadow-[#344E41]/20 transition transform hover:-translate-y-1">
                            Mulai Sekarang
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @endauth
                    
                    <a href="#features" class="flex items-center justify-center gap-3 bg-white border border-[#DAD7CD] hover:border-[#588157] text-[#344E41] px-8 py-4 rounded-2xl font-bold text-lg transition hover:bg-[#F2F4F3]">
                        <i class="fab fa-whatsapp text-[#588157] text-xl"></i> Lihat Integrasi
                    </a>
                </div>

                <div class="pt-8 flex items-center gap-4 text-sm font-medium text-[#A3B18A]">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-[#F2F4F3] bg-gray-300"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#F2F4F3] bg-gray-400"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#F2F4F3] bg-gray-500"></div>
                    </div>
                    <p>Bergabung dengan 100+ Tim Produktif</p>
                </div>
            </div>

            <div class="lg:w-1/2 relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#588157]/20 rounded-full blur-[100px] -z-10"></div>
                
                <div class="relative bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl p-6 shadow-2xl transform rotate-3 hover:rotate-0 transition duration-700">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="h-2 w-20 bg-gray-200 rounded-full"></div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-1/2 bg-[#F2F4F3] rounded-xl p-3 space-y-3">
                            <div class="h-3 w-16 bg-gray-300 rounded mb-2"></div>
                            <div class="bg-white p-3 rounded-lg shadow-sm">
                                <div class="h-2 w-full bg-gray-100 rounded mb-2"></div>
                                <div class="h-2 w-2/3 bg-gray-100 rounded"></div>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm border-l-4 border-[#588157]">
                                <div class="flex justify-between mb-2">
                                    <div class="h-2 w-10 bg-green-100 rounded"></div>
                                </div>
                                <div class="h-2 w-full bg-gray-100 rounded mb-2"></div>
                                <div class="flex -space-x-1 mt-2">
                                    <div class="w-5 h-5 rounded-full bg-blue-200 border border-white"></div>
                                    <div class="w-5 h-5 rounded-full bg-purple-200 border border-white"></div>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 bg-[#F2F4F3] rounded-xl p-3">
                            <div class="h-3 w-16 bg-gray-300 rounded mb-2"></div>
                            <div class="bg-white p-3 rounded-lg shadow-sm opacity-50">
                                <div class="h-2 w-full bg-gray-100 rounded mb-2"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute -left-10 bottom-10 bg-white p-4 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Notification</p>
                            <p class="text-xs font-bold text-[#344E41]">Tugas Baru Ditugaskan!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>