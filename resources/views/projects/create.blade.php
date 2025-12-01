<x-app-layout>
    <div class="min-h-screen bg-[#F2F4F3] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-sans">
        
        <div class="bg-white w-full max-w-5xl rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">
            
            <div class="w-full md:w-2/5 bg-[#344E41] relative p-12 flex flex-col justify-between text-[#DAD7CD] overflow-hidden">
                
                <div class="absolute top-0 left-0 w-full h-full opacity-10" 
                     style="background-image: radial-gradient(#588157 1px, transparent 1px); background-size: 20px 20px;"></div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-[#588157] rounded-full blur-3xl opacity-40"></div>

                <div class="relative z-10">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#A3B18A] hover:text-white transition mb-8">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                    <h2 class="text-4xl font-serif font-bold text-white leading-tight mb-4">
                        Mulai Sesuatu <br> yang Besar.
                    </h2>
                    <p class="text-[#A3B18A] font-light leading-relaxed">
                        Setiap gedung pencakar langit dimulai dari satu cetak biru. Definisikan visi proyek Anda di sini.
                    </p>
                </div>

                <div class="relative z-10 mt-12">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-[#588157]/20 flex items-center justify-center border border-[#588157]/50 text-white">
                            <i class="fas fa-seedling text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">Fase Inisiasi</p>
                            <p class="text-xs text-[#A3B18A]">Langkah 1 dari Kesuksesan</p>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-[#588157]/30 rounded-full overflow-hidden">
                        <div class="h-full w-1/4 bg-[#A3B18A]"></div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-3/5 p-12 bg-white flex flex-col justify-center">
                
                <form method="POST" action="{{ route('projects.store') }}" class="space-y-8">
                    @csrf

                    <div class="group">
                        <label for="name" class="block text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2 ml-1">Nama Proyek</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="fas fa-heading"></i>
                            </div>
                            <input type="text" name="name" id="name" :value="old('name')" required autofocus
                                   class="block w-full pl-11 pr-4 py-4 bg-[#F2F4F3] border-transparent focus:border-[#588157] rounded-xl focus:bg-white focus:ring-0 text-[#344E41] font-bold text-lg placeholder-[#A3B18A]/50 transition-all shadow-inner"
                                   placeholder="Misal: Redesign Website 2025">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="group">
                        <label for="description" class="block text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2 ml-1">Deskripsi Singkat</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                            <div class="absolute top-4 left-4 pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="fas fa-align-left"></i>
                            </div>
                            <textarea name="description" id="description" rows="3"
                                      class="block w-full pl-11 pr-4 py-4 bg-[#F2F4F3] border-transparent focus:border-[#588157] rounded-xl focus:bg-white focus:ring-0 text-[#344E41] text-sm placeholder-[#A3B18A]/50 transition-all shadow-inner resize-none"
                                      placeholder="Apa tujuan utama proyek ini?">{{ old('description') }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="group">
                        <label for="deadline" class="block text-xs font-bold text-[#344E41] uppercase tracking-wider mb-2 ml-1">Target Deadline</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#A3B18A] group-focus-within:text-[#588157]">
                                <i class="far fa-clock"></i>
                            </div>
                            <input type="datetime-local" name="deadline" id="deadline"
                                   value="{{ old('deadline') }}"
                                   class="block w-full pl-11 pr-4 py-4 bg-[#F2F4F3] border-transparent focus:border-[#588157] rounded-xl focus:bg-white focus:ring-0 text-[#344E41] font-bold text-sm placeholder-[#A3B18A]/50 transition-all shadow-inner cursor-pointer">
                        </div>
                        <p class="text-[10px] text-[#A3B18A] mt-2 ml-1 flex items-center gap-1">
                            <i class="fas fa-info-circle"></i> Opsional. Masukkan jam untuk presisi.
                        </p>
                        <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-4">
                        <a href="{{ route('dashboard') }}" class="text-sm font-bold text-[#A3B18A] hover:text-[#344E41] transition px-4 py-2">
                            Batal
                        </a>
                        <button type="submit" 
                                class="group bg-[#344E41] hover:bg-[#2A3E34] text-white px-8 py-3.5 rounded-xl font-bold shadow-lg shadow-[#344E41]/30 transform transition-all hover:-translate-y-1 flex items-center gap-2">
                            <span>Buat Proyek</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>