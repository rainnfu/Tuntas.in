<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">

    <div class="min-h-screen flex flex-col md:flex-row">
        
        <div class="w-full md:w-5/12 flex flex-col justify-center px-8 md:px-16 py-12 bg-white z-10 relative shadow-none md:shadow-2xl h-screen overflow-y-auto">
            
            <div class="w-full max-w-md mx-auto">
                <div class="mb-10">
                    <h1 class="text-3xl font-black text-blue-600 tracking-tighter">
                        Tuntas<span class="text-gray-800">.in</span>
                    </h1>
                    <p class="text-gray-500 mt-2 text-sm">Masuk untuk melanjutkan progres tim.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200 outline-none text-gray-800 font-medium" 
                               placeholder="nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-blue-600 hover:underline font-semibold" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition duration-200 outline-none text-gray-800 font-medium"
                               placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600 group-hover:text-gray-800 transition">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-300">
                        Masuk Sekarang
                    </button>

                    <div class="text-center mt-6 text-sm text-gray-500">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar Gratis</a>
                    </div>
                </form>

                <div class="mt-10 pt-6 border-t border-gray-100 text-xs text-gray-400 text-center">
                    &copy; {{ date('Y') }} Tuntas.in Project.
                </div>
            </div>
        </div>

        <div class="hidden md:block md:w-7/12 bg-blue-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center opacity-40 mix-blend-multiply" 
                 style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
            </div>
            
            <div class="relative z-10 flex flex-col justify-center h-full px-16 text-white">
                <h2 class="text-5xl font-black mb-6 leading-tight tracking-tight">
                    Kelola Proyek <br> Tanpa Drama.
                </h2>
                <p class="text-lg text-blue-100 max-w-lg leading-relaxed font-light">
                    Satu platform untuk mengatur tugas, tenggat waktu, dan kolaborasi tim. Terintegrasi langsung dengan WhatsApp Anda.
                </p>
            </div>

            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-400 rounded-full opacity-50 blur-3xl animate-pulse"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500 rounded-full opacity-50 blur-3xl"></div>
        </div>

    </div>
</body>
</html>