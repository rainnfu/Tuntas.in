<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - {{ config('app.name', 'Tuntas.in') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-hero { font-family: 'Inter', sans-serif; }

        /* Animasi */
        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0; transform: translateY(30px);
        }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

        @keyframes kenBurns {
            0% { transform: scale(1); }
            100% { transform: scale(1.15); }
        }
        .animate-ken-burns { animation: kenBurns 25s infinite alternate ease-in-out; }

        .sage-input:focus {
            box-shadow: 0 0 0 4px rgba(163, 177, 138, 0.3);
            border-color: #588157;
        }
    </style>
</head>
<body class="bg-[#DAD7CD] text-[#344E41] antialiased overflow-hidden selection:bg-[#A3B18A] selection:text-white">

    <div class="min-h-screen flex">
        
        <div class="w-full lg:w-5/12 flex flex-col justify-center px-8 sm:px-12 lg:px-20 bg-[#FDFCF8] relative z-20 shadow-2xl h-screen">
            
            <div class="w-full max-w-md mx-auto fade-in-up" style="animation-delay: 0.1s">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#A3B18A] hover:text-[#588157] transition-colors mb-8 group">
                    <i class="fas fa-arrow-left transform group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Login
                </a>

                <div class="mb-6">
                    <div class="w-12 h-12 rounded-xl bg-[#A3B18A]/20 flex items-center justify-center text-[#588157] mb-4">
                        <i class="fas fa-key text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-hero font-black text-[#344E41] tracking-tight leading-tight mb-3">
                        Lupa Password? <br> No Panic. 🧘‍♂️
                    </h2>
                    <p class="text-[#5F6F65] text-sm leading-relaxed">
                        Tenang saja. Masukkan email yang Anda gunakan saat mendaftar, dan kami akan mengirimkan "kunci cadangan" untuk Anda.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div class="group">
                        <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-2 ml-1">Email Terdaftar</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.02]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="far fa-envelope"></i>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                                   class="sage-input w-full pl-11 pr-4 py-3.5 bg-white border border-[#A3B18A]/50 rounded-2xl focus:bg-white outline-none font-bold text-[#344E41] placeholder-[#A3B18A]/50 shadow-sm"
                                   placeholder="email@kamu.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <button type="submit" class="group w-full py-4 px-6 bg-[#344E41] hover:bg-[#588157] text-white font-black rounded-2xl shadow-lg shadow-[#344E41]/20 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl focus:ring-4 focus:ring-[#A3B18A] flex items-center justify-center gap-3">
                        <span>Kirim Link Reset</span>
                        <i class="fas fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                    </button>
                </form>
            </div>
            
            <div class="absolute bottom-6 text-[10px] text-[#A3B18A] font-bold tracking-widest uppercase opacity-50">
                Tuntas.in &copy; Recovery System
            </div>
        </div>

        <div class="hidden lg:block lg:w-7/12 bg-[#344E41] relative overflow-hidden">
            
            <div class="absolute inset-0 bg-cover bg-center animate-ken-burns opacity-60 mix-blend-overlay" 
                 style="background-image: url('https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?q=80&w=2613&auto=format&fit=crop');">
            </div>
            
            <div class="absolute inset-0 bg-gradient-to-t from-[#344E41] via-[#344E41]/50 to-[#588157]/20"></div>

            <div class="relative z-10 h-full flex flex-col justify-end px-16 lg:px-24 pb-20">
                <div class="font-hero text-[#DAD7CD] fade-in-up" style="animation-delay: 0.3s">
                    
                    <div class="text-[#A3B18A] text-lg font-bold uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                        <span class="w-8 h-0.5 bg-[#A3B18A]"></span> Reset & Rise
                    </div>

                    <h1 class="text-6xl font-black leading-tight tracking-tighter mb-8 drop-shadow-lg">
                        "That's all it is, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#A3B18A] to-white">
                            Miles.
                        </span><br>
                        A leap of faith."
                    </h1>

                    <div class="flex items-center gap-4 mt-8 border-l-4 border-[#A3B18A] pl-6">
                        <div>
                            <p class="text-xl font-bold text-white">Peter B. Parker</p>
                            <p class="text-sm font-medium text-[#A3B18A] uppercase tracking-widest">Spider-Man: Into the Spider-Verse</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>