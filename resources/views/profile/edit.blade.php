<x-app-layout>
    <div class="min-h-screen bg-[#F2F4F3] py-12 px-4 sm:px-6 lg:px-8 font-sans text-[#344E41]">
        
        <div class="max-w-7xl mx-auto mb-10">
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-[#A3B18A] hover:text-[#588157] uppercase tracking-widest transition">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
            </div>
            <h1 class="text-4xl font-serif font-bold text-[#344E41]">Pengaturan Profil</h1>
            <p class="text-[#5F6F65] mt-2">Kelola identitas dan keamanan akun Anda.</p>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1">
                <div class="bg-[#344E41] rounded-[2rem] p-8 text-white shadow-2xl relative overflow-hidden sticky top-24">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-[#588157] rounded-full blur-3xl opacity-20 -mr-10 -mt-10"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-[#A3B18A] rounded-full blur-3xl opacity-20 -ml-10 -mb-10"></div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="relative mb-6 group">
                            <img src="{{ Auth::user()->avatar_url }}" 
                                 class="w-32 h-32 rounded-full object-cover border-4 border-[#588157] shadow-lg bg-white"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=A3B18A&color=fff';">
                            <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 rounded-full border-4 border-[#344E41]"></div>
                        </div>
                        
                        <h2 class="text-2xl font-bold mb-1">{{ Auth::user()->name }}</h2>
                        <p class="text-[#A3B18A] text-sm font-medium tracking-wide mb-6">{{ Auth::user()->email }}</p>

                        <div class="w-full border-t border-white/10 my-6"></div>

                        <div class="w-full space-y-4 text-left">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-[#A3B18A]">Status</span>
                                <span class="font-bold bg-[#588157]/30 px-3 py-1 rounded-full text-xs text-white">AKTIF</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-[#A3B18A]">Bergabung</span>
                                <span class="font-bold text-white">{{ Auth::user()->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-[#DAD7CD]/50">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-[#DAD7CD]/50">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="bg-red-50 p-8 rounded-[2rem] border border-red-100">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>