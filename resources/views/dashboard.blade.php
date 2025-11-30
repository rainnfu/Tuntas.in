<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pb-10">
        
        <div class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
                            Halo, <span class="text-blue-600">{{ Auth::user()->name }}</span>! 👋
                        </h1>
                        <p class="text-gray-500 mt-1">Mari tuntasin tugas-tugasmu hari ini.</p>
                    </div>
                    <div class="flex gap-3">
                        <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-semibold border border-blue-100 shadow-sm">
                            <i class="far fa-calendar-alt mr-2"></i> {{ now()->format('d M Y') }}
                        </span>
                        <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-bold shadow-md transition-all transform hover:scale-105 flex items-center">
                            <i class="fas fa-plus mr-2"></i> Buat Proyek
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex justify-between items-center animate-pulse">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Total Proyek</p>
                        <h3 class="text-2xl font-black text-gray-800">{{ $projects->count() }}</h3>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-xl">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Milik Saya</p>
                        <h3 class="text-2xl font-black text-gray-800">{{ Auth::user()->ownedProjects->count() }}</h3>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Kolaborasi</p>
                        <h3 class="text-2xl font-black text-gray-800">{{ Auth::user()->projects->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Proyek Aktif</h2>
                <div class="text-sm text-gray-500">Menampilkan {{ $projects->count() }} hasil</div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($projects as $project)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 group flex flex-col h-full">
                        
                        <div class="p-6 pb-4">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                    {{ substr($project->name, 0, 1) }}
                                </div>
                                
                                @if($project->owner_id === Auth::id())
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                                        <a href="{{ route('projects.edit', $project) }}" class="text-gray-400 hover:text-blue-500 p-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 p-1">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('projects.show', $project) }}" class="block group-hover:text-blue-600 transition-colors">
                                <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-1">{{ $project->name }}</h3>
                            </a>
                            <p class="text-gray-500 text-sm line-clamp-2 h-10">{{ $project->description }}</p>
                        </div>

                        <div class="mt-auto p-6 pt-0">
                            <div class="w-full bg-gray-100 rounded-full h-2 mb-4 overflow-hidden">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ rand(10, 90) }}%"></div>
                            </div>

                            <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                                <div class="flex items-center gap-2">
                                    @if($project->owner_id === Auth::id())
                                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-bold">Owner</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full font-bold">Member</span>
                                    @endif
                                </div>

                                <a href="{{ route('projects.show', $project) }}" class="text-sm font-semibold text-blue-600 hover:underline">
                                    Buka Papan <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
                        <div class="w-20 h-20 bg-blue-50 text-blue-300 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Belum ada proyek</h3>
                        <p class="text-gray-500 mb-6">Mulai atur tugasmu dengan membuat proyek baru.</p>
                        <a href="{{ route('projects.create') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold shadow-lg transition">
                            <i class="fas fa-plus mr-2"></i> Buat Proyek Pertama
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>