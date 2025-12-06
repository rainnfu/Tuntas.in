<section class="bg-white">
    <header class="mb-8">
        <h2 class="text-xl font-bold text-[#344E41] flex items-center gap-2">
            <i class="fas fa-id-card text-[#588157]"></i> Informasi Dasar
        </h2>
        <p class="mt-1 text-sm text-[#5F6F65]">
            Perbarui nama, email, dan pilih karakter avatar Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div x-data="{ selected: '{{ Auth::user()->avatar ?? '' }}' }" class="bg-[#F2F4F3] p-6 rounded-2xl border border-[#DAD7CD]">
            <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-4">
                Pilih Karakter (Pilih 1 dari 5)
            </label>
            
            <div class="grid grid-cols-5 gap-4 justify-items-center">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="relative cursor-pointer group" @click="selected = '{{ $i }}.jpg'">
                        <img src="{{ asset('assets/avatars/' . $i . '.jpg') }}" 
                             class="w-14 h-14 rounded-full object-cover transition-all duration-300 transform border-2"
                             :class="selected == '{{ $i }}.jpg' 
                                ? 'border-[#344E41] scale-110 shadow-md ring-2 ring-[#588157] ring-offset-2' 
                                : 'border-transparent opacity-60 hover:opacity-100 hover:scale-105 hover:border-[#A3B18A]'">
                        
                        <div x-show="selected == '{{ $i }}.jpg'" class="absolute -top-1 -right-1 bg-[#588157] text-white w-5 h-5 rounded-full flex items-center justify-center text-[10px] shadow-sm animate-bounce">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                @endfor
            </div>
            <input type="hidden" name="avatar_option" :value="selected">
        </div>

        <div>
            <label for="name" class="block text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2">Nama Lengkap</label>
            <input id="name" name="name" type="text" 
                   class="w-full rounded-xl border border-[#DAD7CD] bg-white text-[#344E41] py-3 px-4 shadow-sm placeholder-[#A3B18A]/50 focus:ring-[#588157] focus:border-[#588157]" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Nama Anda" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2">Email</label>
            <input id="email" name="email" type="email" 
                   class="w-full rounded-xl border border-[#DAD7CD] bg-white text-[#344E41] py-3 px-4 shadow-sm placeholder-[#A3B18A]/50 focus:ring-[#588157] focus:border-[#588157]" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="email@contoh.com" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-[#344E41]">
                        {{ __('Email Anda belum diverifikasi.') }}
                        <button form="send-verification" class="underline text-sm text-[#588157] hover:text-[#344E41] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A3B18A]">
                            {{ __('Klik di sini untuk kirim ulang.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Link verifikasi baru telah dikirim.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-[#DAD7CD]/50">
            <button type="submit" class="bg-[#344E41] hover:bg-[#2A3E34] text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-[#344E41]/20 transition transform hover:-translate-y-0.5">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-[#588157] font-bold flex items-center gap-1">
                    <i class="fas fa-check-circle"></i> Berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>