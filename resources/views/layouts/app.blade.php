<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tuntas.in') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Mengubah font default seluruh body */
            body { font-family: 'Outfit', sans-serif; }
            
            /* Custom Scrollbar Sidebar (Hijau Sage Halus) */
            .sidebar-scroll::-webkit-scrollbar { width: 5px; }
            .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #A3B18A; border-radius: 10px; }
            .sidebar-scroll::-webkit-scrollbar-track { background-color: transparent; }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#DAD7CD]" x-data="{ sidebarOpen: false }">
        
        <div class="min-h-screen flex flex-col md:flex-row">
            
            <aside class="w-full md:w-72 bg-[#344E41] border-r border-[#588157]/30 md:h-screen md:fixed md:top-0 md:left-0 z-30 flex flex-col transition-all duration-300 shadow-2xl"
                   :class="sidebarOpen ? 'block fixed inset-0 z-50' : 'hidden md:flex'">
                
                <div class="h-20 flex items-center px-8 border-b border-[#588157]/30 justify-between md:justify-start bg-[#344E41]">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-[#DAD7CD] tracking-tight flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#588157] flex items-center justify-center text-white shadow-lg shadow-[#588157]/20">
                            <i class="fas fa-layer-group text-sm"></i>
                        </div>
                        Tuntas<span class="text-[#A3B18A]">.in</span>
                    </a>
                    <button @click="sidebarOpen = false" class="md:hidden text-[#A3B18A]">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto sidebar-scroll">
                    <p class="px-4 text-[10px] font-bold text-[#A3B18A] uppercase tracking-[0.2em] mb-4 opacity-70">Workspace</p>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-[#588157] text-white shadow-lg shadow-[#588157]/20' : 'text-[#DAD7CD] hover:bg-[#588157]/20 hover:text-white' }}">
                        <i class="fas fa-grid-2 w-5 text-center text-lg {{ request()->routeIs('dashboard') ? 'text-white' : 'text-[#A3B18A] group-hover:text-white' }}"></i>
                        <span class="font-semibold text-sm">Dashboard</span>
                    </a>

                    <a href="{{ route('projects.create') }}" 
                       class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('projects.create') ? 'bg-[#588157] text-white shadow-lg shadow-[#588157]/20' : 'text-[#DAD7CD] hover:bg-[#588157]/20 hover:text-white' }}">
                        <i class="fas fa-plus-square w-5 text-center text-lg {{ request()->routeIs('projects.create') ? 'text-white' : 'text-[#A3B18A] group-hover:text-white' }}"></i>
                        <span class="font-semibold text-sm">Buat Proyek</span>
                    </a>

                    <div class="my-8 border-t border-[#588157]/30 mx-4"></div>

                    <p class="px-4 text-[10px] font-bold text-[#A3B18A] uppercase tracking-[0.2em] mb-4 opacity-70">Settings</p>
                    
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('profile.edit') ? 'bg-[#588157] text-white shadow-lg shadow-[#588157]/20' : 'text-[#DAD7CD] hover:bg-[#588157]/20 hover:text-white' }}">
                        <i class="fas fa-sliders-h w-5 text-center text-lg {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-[#A3B18A] group-hover:text-white' }}"></i>
                        <span class="font-semibold text-sm">Profil Saya</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-4 px-4 py-3.5 rounded-xl text-[#DAD7CD] hover:bg-red-500/10 hover:text-red-400 transition-all duration-200 group">
                            <i class="fas fa-power-off w-5 text-center text-lg text-[#A3B18A] group-hover:text-red-400"></i>
                            <span class="font-semibold text-sm">Keluar</span>
                        </button>
                    </form>
                </nav>

                <div class="p-6 bg-[#2d4438]">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <img src="{{ Auth::user()->avatar_url }}" class="w-10 h-10 rounded-xl object-cover border-2 border-[#588157]">
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-[#344E41]"></div>
                        </div>
                        <div class="overflow-hidden">
                            <h4 class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</h4>
                            <p class="text-[10px] text-[#A3B18A] truncate uppercase tracking-wider font-bold">Online</p>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="flex-1 md:ml-72 min-h-screen flex flex-col bg-[#F5F5F0]"> <div class="bg-[#344E41] text-white border-b border-[#588157]/30 p-4 md:hidden flex justify-between items-center sticky top-0 z-20 shadow-md">
                    <div class="font-bold flex items-center gap-2">
                        <i class="fas fa-layer-group"></i> Tuntas.in
                    </div>
                    <button @click="sidebarOpen = true" class="text-[#A3B18A] focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>

                <main class="flex-1 p-4 sm:p-8 lg:p-12">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>