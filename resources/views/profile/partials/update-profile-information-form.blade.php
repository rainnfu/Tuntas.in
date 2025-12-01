<section>
    <header>
        <h2 class="text-lg font-bold text-[#344E41]">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-[#5F6F65]">
            {{ __("Perbarui detail akun dan pilih karakter Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div x-data="{ selected: '{{ Auth::user()->avatar ?? '' }}' }">
            <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-3">
                Pilih Avatar
            </label>
            
            <div class="grid grid-cols-4 sm:grid-cols-8 gap-4 mb-4">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="relative cursor-pointer group" 
                         @click="selected = '{{ $i }}'">
                        
                        <img src="{{ asset('assets/avatars/' . $i . '.jpg') }}" 
                             class="w-12 h-12 rounded-full object-cover transition-all duration-200 transform hover:scale-110"
                             :class="selected == '{{ $i }}.jpg' ? 'ring-4 ring-[#588157] scale-110 shadow-lg' : 'opacity-70 hover:opacity-100 ring-2 ring-transparent hover:ring-[#A3B18A]'">
                        
                        <div x-show="selected == '{{ $i }}'" 
                             class="absolute -top-1 -right-1 bg-[#588157] text-white rounded-full w-4 h-4 flex items-center justify-center text-[10px] shadow-sm animate-bounce">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                @endfor
            </div>

            <input type="hidden" name="avatar_option" :value="selected">
            
            <p class="text-xs text-[#A3B18A]" x-show="selected">
                Avatar terpilih: <span x-text="selected" class="font-bold"></span>
            </p>
        </div>

        <div class="group">
            <x-input-label for="name" class="text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2" :value="__('Nama Lengkap')" />
            <x-text-input id="name" name="name" type="text" 
                          class="sage-input block w-full rounded-xl border-gray-200 bg-[#F2F4F3] focus:bg-white text-[#344E41]" 
                          :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="group">
            <x-input-label for="email" class="text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" 
                          class="sage-input block w-full rounded-xl border-gray-200 bg-[#F2F4F3] focus:bg-white text-[#344E41]" 
                          :value="old('email', $user->email)" required autocomplete="username" />
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

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-[#344E41] hover:bg-[#588157] text-white px-6 py-2 rounded-xl font-bold shadow-md transition transform hover:-translate-y-0.5">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-[#588157] font-bold flex items-center gap-1">
                    <i class="fas fa-check-circle"></i> {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>