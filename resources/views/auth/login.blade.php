<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - {{ config('app.name', 'Tuntas.in') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-hero { font-family: 'Inter', sans-serif; }

        /* Smooth Animations */
        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0; transform: translateY(30px);
        }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

        /* Background Zoom Effect */
        @keyframes kenBurns {
            0% { transform: scale(1); }
            100% { transform: scale(1.15); }
        }
        .animate-ken-burns {
            animation: kenBurns 25s infinite alternate ease-in-out;
        }

        /* Sage Theme Focus */
        .sage-input:focus {
            box-shadow: 0 0 0 4px rgba(163, 177, 138, 0.3);
            border-color: #588157;
        }
        .sage-checkbox:checked {
            background-color: #588157;
            border-color: #588157;
        }

        /* Spider Floating Animation */
        .float-spider { animation: floatSpider 5s ease-in-out infinite; }
        @keyframes floatSpider {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }
        
        /* Web/Net Decoration Animation */
        .web-spin { animation: webSpin 60s linear infinite; }
        @keyframes webSpin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>
</head>
<body class="bg-[#DAD7CD] text-[#344E41] antialiased overflow-hidden selection:bg-[#A3B18A] selection:text-white">

    <div class="min-h-screen flex">
        
        <div class="w-full lg:w-5/12 flex flex-col justify-center px-8 sm:px-12 lg:px-20 bg-[#FDFCF8] relative z-20 shadow-2xl h-screen overflow-y-auto">
            
            <div class="w-full max-w-md mx-auto fade-in-up" style="animation-delay: 0.1s">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-[#588157] flex items-center justify-center text-white shadow-lg shadow-[#588157]/30 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                        <i class="fas fa-check-double text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-[#344E41]">Tuntas<span class="text-[#588157]">.in</span></span>
                </div>
                
                <div class="mb-8">
                    <h2 class="text-3xl font-hero font-black text-[#344E41] tracking-tight leading-tight mb-2">
                        Welcome back, <br> MC. 🕷️
                    </h2>
                    <p class="text-[#5F6F65] text-sm font-medium">
                        Setiap tugas besar dimulai dari satu langkah kecil.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div class="group">
                        <label for="email" class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-2 ml-1">Identity</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.02]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="far fa-user-circle"></i>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                                   class="sage-input w-full pl-11 pr-4 py-3.5 bg-white border border-[#A3B18A]/50 rounded-2xl focus:bg-white outline-none font-bold text-[#344E41] placeholder-[#A3B18A]/50 shadow-sm transition-all"
                                   placeholder="peterparker@dailybugle.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="group">
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label for="password" class="block text-xs font-bold text-[#588157] uppercase tracking-wider">Secret Key</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#A3B18A] hover:text-[#588157] transition-colors">
                                    Lupa?
                                </a>
                            @endif
                        </div>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.02]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="fas fa-fingerprint"></i>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                   class="sage-input w-full pl-11 pr-4 py-3.5 bg-white border border-[#A3B18A]/50 rounded-2xl focus:bg-white outline-none font-bold text-[#344E41] placeholder-dots shadow-sm transition-all"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="pt-4 space-y-4">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group select-none">
                            <div class="relative">
                                <input id="remember_me" type="checkbox" class="sage-checkbox peer sr-only" name="remember">
                                <div class="w-5 h-5 border-2 border-[#A3B18A] rounded-lg peer-checked:bg-[#588157] peer-checked:border-[#588157] transition-all bg-white"></div>
                                <i class="fas fa-check text-white text-[10px] absolute top-1 left-1 opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="ms-3 text-sm font-bold text-[#5F6F65] group-hover:text-[#344E41] transition-colors">Ingat saya</span>
                        </label>

                        <button type="submit" class="group w-full py-4 px-6 bg-[#344E41] hover:bg-[#588157] text-white font-black rounded-2xl shadow-lg shadow-[#344E41]/20 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl focus:ring-4 focus:ring-[#A3B18A] flex items-center justify-center gap-3 text-base">
                            <span>Assemble Team</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>

                    <div class="text-center pt-2">
                        <a href="{{ route('register') }}" class="text-sm font-bold text-[#A3B18A] hover:text-[#588157] transition-colors">
                            Belum punya akses? <span class="underline decoration-2 underline-offset-4 text-[#344E41]">Daftar sekarang.</span>
                        </a>
                    </div>
                </form>
            </div>
            
            <div class="absolute bottom-6 text-[10px] text-[#A3B18A] font-bold tracking-widest uppercase opacity-50 fade-in-up" style="animation-delay: 0.5s">
                Tuntas.in &copy; {{ date('Y') }}
            </div>
        </div>

        <div class="hidden lg:block lg:w-7/12 bg-[#344E41] relative overflow-hidden">
            
            <div class="absolute inset-0 bg-cover bg-center animate-ken-burns opacity-50 mix-blend-luminosity" 
                 style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2670&auto=format&fit=crop');">
            </div>
            
            <div class="absolute inset-0 bg-gradient-to-br from-[#344E41] via-[#344E41]/80 to-[#588157]/40"></div>

            <div class="relative z-10 h-full flex flex-col justify-center px-16 lg:px-24">
                
                <div class="absolute top-24 right-24 text-[#A3B18A]/20 text-9xl float-spider">
                    <i class="fas fa-spider"></i>
                </div>

                <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] border-[2px] border-dashed border-[#A3B18A]/10 rounded-full web-spin"></div>
                <div class="absolute -bottom-40 -left-40 w-[400px] h-[400px] border-[1px] border-[#A3B18A]/20 rounded-full web-spin" style="animation-duration: 40s;"></div>

                <div class="font-hero text-[#DAD7CD] fade-in-up" style="animation-delay: 0.3s">
                    
                    <div class="text-[#A3B18A] text-lg font-bold uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                        <span class="w-8 h-0.5 bg-[#A3B18A]"></span> Project Motto
                    </div>

                    <h1 class="text-6xl lg:text-7xl font-black leading-tight tracking-tighter mb-8 drop-shadow-lg">
                        With great <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#A3B18A] to-white">
                            power
                        </span>,<br>
                        comes great <br>
                        <span class="underline decoration-[#588157] decoration-4 underline-offset-8">responsibility.</span>
                    </h1>

                    <div class="flex items-center gap-4 mt-8 border-l-4 border-[#A3B18A] pl-6">
                        <div>
                            <p class="text-xl font-bold text-white">Uncle Ben</p>
                            <p class="text-sm font-medium text-[#A3B18A] uppercase tracking-widest">Spider-Man (2002)</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</body>
</html>