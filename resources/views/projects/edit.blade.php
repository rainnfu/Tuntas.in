<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Proyek: {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('projects.update', $project) }}">
                        @csrf
                        @method('PUT') <div class="mb-4">
                            <x-input-label for="name" :value="__('Nama Proyek')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$project->name" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi Singkat')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ $project->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <x-input-label for="deadline" :value="__('Target Selesai (Deadline)')" />
                            <input type="datetime-local" id="deadline" name="deadline" 
                                value="{{ old('deadline', $project->deadline ? $project->deadline->format('Y-m-d\TH:i') : '') }}"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-2">
                            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:underline">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>