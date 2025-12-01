<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Buat Proyek Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <nav class="flex mb-4 text-sm text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">Buat Proyek</span>
            </nav>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                
                <div class="bg-blue-600 p-6 sm:p-10 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold">Mulai Sesuatu yang Hebat</h3>
                        <p class="text-blue-100 mt-2 text-sm">Buat ruang kerja baru untuk mengatur tugas dan kolaborasi tim Anda.</p>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white opacity-10 rounded-full blur-2xl"></div>
                </div>

                <div class="p-6 sm:p-10">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="name" class="text-gray-700 font-bold mb-2 flex items-center gap-2">
                                <i class="fas fa-heading text-blue-500"></i> {{ __('Nama Proyek') }}
                            </x-input-label>
                            
                            <x-text-input id="name" class="block mt-1 w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" 
                                          type="text" name="name" :value="old('name')" required autofocus placeholder="Contoh: Website Company Profile" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="description" class="text-gray-700 font-bold mb-2 flex items-center gap-2">
                                <i class="fas fa-align-left text-blue-500"></i> {{ __('Deskripsi Singkat') }} <span class="text-gray-400 font-normal text-xs">(Opsional)</span>
                            </x-input-label>
                            
                            <textarea id="description" name="description" rows="3"
                                      class="block mt-1 w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm resize-none"
                                      placeholder="Jelaskan tujuan proyek ini...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-8">
                            <x-input-label for="deadline" class="text-gray-700 font-bold mb-2 flex items-center gap-2">
                                <i class="far fa-calendar-alt text-blue-500"></i> {{ __('Target Selesai (Deadline)') }} <span class="text-gray-400 font-normal text-xs">(Opsional)</span>
                            </x-input-label>
                            
                            <div class="relative max-w-xs">
                                <input type="date" id="deadline" name="deadline" 
                                       class="block mt-1 w-full pl-10 px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm text-gray-600"
                                       value="{{ old('deadline') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-day text-gray-400"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Kami akan memberikan indikator warna jika proyek melewati tanggal ini.</p>
                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-6">
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform transition hover:-translate-y-0.5 focus:ring-4 focus:ring-blue-200">
                                <i class="fas fa-save mr-2"></i> Simpan Proyek
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>