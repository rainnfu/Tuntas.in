<section class="bg-white">
    <header class="mb-8">
        <h2 class="text-xl font-bold text-[#344E41] flex items-center gap-2">
            <i class="fas fa-lock text-[#588157]"></i> Keamanan Akun
        </h2>
        <p class="mt-1 text-sm text-[#5F6F65]">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2">Password Saat Ini</label>
            <input id="current_password" name="current_password" type="password" 
                   class="w-full rounded-xl border border-[#DAD7CD] bg-white text-[#344E41] py-3 px-4 shadow-sm placeholder-[#A3B18A]/50 focus:ring-[#588157] focus:border-[#588157]" 
                   autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2">Password Baru</label>
            <input id="password" name="password" type="password" 
                   class="w-full rounded-xl border border-[#DAD7CD] bg-white text-[#344E41] py-3 px-4 shadow-sm placeholder-[#A3B18A]/50 focus:ring-[#588157] focus:border-[#588157]" 
                   autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" 
                   class="w-full rounded-xl border border-[#DAD7CD] bg-white text-[#344E41] py-3 px-4 shadow-sm placeholder-[#A3B18A]/50 focus:ring-[#588157] focus:border-[#588157]" 
                   autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-[#DAD7CD]/50">
            <button type="submit" class="bg-[#A3B18A] hover:bg-[#588157] text-white px-8 py-3 rounded-xl font-bold shadow-md transition transform hover:-translate-y-0.5">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-[#588157] font-bold flex items-center gap-1">
                    <i class="fas fa-check-circle"></i> Password diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>