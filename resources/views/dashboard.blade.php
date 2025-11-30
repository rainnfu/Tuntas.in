<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Proyek') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Buat Proyek
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($projects as $project)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition relative group">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-xl mb-2">{{ $project->name }}</h3>
                                
                                @if($project->owner_id === Auth::id())
                                    <div class="flex space-x-2">
                                        <a href="{{ route('projects.edit', $project) }}" class="text-gray-400 hover:text-blue-500">
                                            ✏️
                                        </a>
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini? Semua tugas akan hilang permanen.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 mb-4 h-12 overflow-hidden">{{ Str::limit($project->description, 80) }}</p>
                            
                            <div class="flex justify-between items-center text-sm text-gray-500 mt-4 border-t pt-2">
                                <span class="flex items-center gap-1">
                                    👤 {{ $project->owner_id === Auth::id() ? 'Anda' : $project->owner->name }}
                                </span>
                                <a href="{{ route('projects.show', $project) }}" class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold hover:bg-blue-200">
                                    Buka Papan &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>