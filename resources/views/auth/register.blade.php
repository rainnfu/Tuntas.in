<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - {{ config('app.name', 'Tuntas.in') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-hero { font-family: 'Inter', sans-serif; }

        /* Animations */
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

        /* Sage Focus */
        .sage-input:focus {
            box-shadow: 0 0 0 4px rgba(163, 177, 138, 0.3);
            border-color: #588157;
        }
    </style>
</head>
<body class="bg-[#DAD7CD] text-[#344E41] antialiased overflow-hidden selection:bg-[#A3B18A] selection:text-white">

    <div class="min-h-screen flex">
        
        <div class="w-full lg:w-5/12 flex flex-col justify-center px-8 sm:px-12 lg:px-16 bg-[#FDFCF8] relative z-20 shadow-2xl h-screen overflow-y-auto custom-scrollbar">
            
            <div class="w-full max-w-md mx-auto fade-in-up py-10" style="animation-delay: 0.1s">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-[#588157] flex items-center justify-center text-white shadow-lg transform -rotate-3">
                        <i class="fas fa-check-double text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-[#344E41]">Tuntas<span class="text-[#588157]">.in</span></span>
                </div>
                
                <div class="mb-8">
                    <h2 class="text-3xl font-hero font-black text-[#344E41] tracking-tight leading-tight mb-2">
                        Start Your <br> Origin Story. 🚀
                    </h2>
                    <p class="text-[#5F6F65] text-sm font-medium">
                        Bergabunglah dengan ribuan tim produktif lainnya.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="group">
                        <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-2 ml-1">Nama Lengkap</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.02]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="far fa-id-card"></i>
                            </div>
                            <input type="text" name="name" :value="old('name')" required autofocus 
                                   class="sage-input w-full pl-11 pr-4 py-3 bg-white border border-[#A3B18A]/50 rounded-xl focus:bg-white outline-none font-bold text-[#344E41] placeholder-[#A3B18A]/50 shadow-sm"
                                   placeholder="Tony Stark">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-2 ml-1">Email</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.02]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="far fa-envelope"></i>
                            </div>
                            <input type="email" name="email" :value="old('email')" required 
                                   class="sage-input w-full pl-11 pr-4 py-3 bg-white border border-[#A3B18A]/50 rounded-xl focus:bg-white outline-none font-bold text-[#344E41] placeholder-[#A3B18A]/50 shadow-sm"
                                   placeholder="ironman@avengers.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-2 ml-1">WhatsApp (Notifikasi)</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.02]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </div>
                            <input type="text" name="whatsapp_number" :value="old('whatsapp_number')" required 
                                   class="sage-input w-full pl-11 pr-4 py-3 bg-white border border-[#A3B18A]/50 rounded-xl focus:bg-white outline-none font-bold text-[#344E41] placeholder-[#A3B18A]/50 shadow-sm"
                                   placeholder="628123456789">
                        </div>
                        <p class="text-[10px] text-[#A3B18A] mt-1 ml-1">*Gunakan kode negara (62). Kami akan mengirim notifikasi tugas ke sini.</p>
                        <x-input-error :messages="$errors->get('whatsapp_number')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-2 ml-1">Password</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.02]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" name="password" required autocomplete="new-password"
                                   class="sage-input w-full pl-11 pr-4 py-3 bg-white border border-[#A3B18A]/50 rounded-xl focus:bg-white outline-none font-bold text-[#344E41] placeholder-dots shadow-sm"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-2 ml-1">Konfirmasi Password</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.02]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <input type="password" name="password_confirmation" required 
                                   class="sage-input w-full pl-11 pr-4 py-3 bg-white border border-[#A3B18A]/50 rounded-xl focus:bg-white outline-none font-bold text-[#344E41] placeholder-dots shadow-sm"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="group w-full py-4 px-6 bg-[#344E41] hover:bg-[#588157] text-white font-black rounded-2xl shadow-lg shadow-[#344E41]/20 transform transition-all duration-300 hover:-translate-y-1 focus:ring-4 focus:ring-[#A3B18A] flex items-center justify-center gap-3 text-base">
                            <span>Create Account</span>
                            <i class="fas fa-user-plus group-hover:scale-110 transition-transform"></i>
                        </button>
                    </div>

                    <div class="text-center pb-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-[#A3B18A] hover:text-[#588157] transition-colors">
                            Sudah punya akun? <span class="underline decoration-2 underline-offset-4 text-[#344E41]">Masuk di sini.</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="hidden lg:block lg:w-7/12 bg-[#344E41] relative overflow-hidden">
            
            <div class="absolute inset-0 bg-cover bg-center animate-ken-burns opacity-50 mix-blend-luminosity" 
                 style="background-image: url('https://images.unsplash.com/photo-1481026469463-66327c86e544?q=80&w=2608&auto=format&fit=crop');">
            </div>
            
            <div class="absolute inset-0 bg-gradient-to-bl from-[#344E41] via-[#344E41]/80 to-[#588157]/40"></div>

            <div class="relative z-10 h-full flex flex-col justify-center px-16 lg:px-24">
                <div class="font-hero text-[#DAD7CD] fade-in-up" style="animation-delay: 0.3s">
                    
                    <div class="text-[#A3B18A] text-lg font-bold uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                        <span class="w-8 h-0.5 bg-[#A3B18A]"></span> Philosophy
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-black leading-tight tracking-tighter mb-8 drop-shadow-lg">
                        "Every great story <br>
                        happens when <br>
                        someone decides <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#A3B18A] to-white">
                            not to give up.
                        </span>"
                    </h1>

                    <div class="flex items-center gap-4 mt-8 border-l-4 border-[#A3B18A] pl-6">
                        <div>
                            <p class="text-xl font-bold text-white">Spiderman</p>
                            <p class="text-sm font-medium text-[#A3B18A] uppercase tracking-widest">Into the Spider-Verse</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>