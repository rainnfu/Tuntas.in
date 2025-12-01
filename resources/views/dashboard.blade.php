<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Dashboard {{ config('app.name') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Selamat datang kembali, <span class="text-blue-600 font-bold">{{ Auth::user()->name }}</span>!
                </p>
            </div>
            <a href="{{ route('projects.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-transform transform hover:scale-105 flex items-center gap-2">
                <i class="fas fa-plus"></i> Buat Proyek
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between animate-fade-in-down">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-100 p-2 rounded-full">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">&times;</button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Proyek</div>
                        <div class="text-2xl font-black text-gray-800">{{ $projects->count() }}</div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 text-xl">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-bold uppercase tracking-wider">Milik Saya</div>
                        <div class="text-2xl font-black text-gray-800">{{ Auth::user()->ownedProjects->count() }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-bold uppercase tracking-wider">Kolaborasi</div>
                        <div class="text-2xl font-black text-gray-800">{{ Auth::user()->projects->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mb-6 px-1">
                <h3 class="text-lg font-bold text-gray-700">Daftar Proyek Aktif</h3>
                <span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-full">{{ $projects->count() }} Projects</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($projects as $project)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-200 flex flex-col h-full relative group transform hover:-translate-y-1">
                        
                        @if($project->owner_id === Auth::id())
                            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1 bg-white p-1 rounded-lg shadow-sm z-10 border border-gray-100">
                                <a href="{{ route('projects.edit', $project) }}" class="text-gray-400 hover:text-blue-500 p-2 rounded-md hover:bg-blue-50 transition" title="Edit Proyek">
                                    <i class="fas fa-pen text-sm"></i>
                                </a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini? Semua tugas akan hilang.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 p-2 rounded-md hover:bg-red-50 transition" title="Hapus Proyek">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div class="p-6 flex-1 cursor-pointer" onclick="window.location='{{ route('projects.show', $project) }}'">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                    {{ substr($project->name, 0, 1) }}
                                </div>
                                <div>
                                    @if($project->owner_id === Auth::id())
                                        <span class="bg-blue-50 text-blue-700 text-[10px] px-2 py-1 rounded-md font-bold uppercase tracking-wide border border-blue-100">Owner</span>
                                    @else
                                        <span class="bg-orange-50 text-orange-700 text-[10px] px-2 py-1 rounded-md font-bold uppercase tracking-wide border border-orange-100">Member</span>
                                    @endif
                                    
                                    <div class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                        <i class="fas fa-user-circle"></i> {{ Str::limit($project->owner->name, 15) }}
                                    </div>
                                </div>
                            </div>

                            <h4 class="text-lg font-bold text-gray-800 mb-2 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                {{ $project->name }}
                            </h4>
                            <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed h-10">
                                {{ $project->description ?? 'Tidak ada deskripsi tambahan untuk proyek ini.' }}
                            </p>
                        </div>

                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 rounded-b-xl flex justify-between items-center">
                            
                            <div class="text-xs font-medium flex items-center gap-2">
                                @if($project->deadline)
                                    @php
                                        $isOverdue = $project->deadline->isPast();
                                        $daysLeft = now()->diffInDays($project->deadline, false);
                                    @endphp
                                    
                                    <span class="{{ $isOverdue ? 'text-red-600 bg-red-50 px-2 py-1 rounded border border-red-100' : 'text-green-600 bg-green-50 px-2 py-1 rounded border border-green-100' }}">
                                        <i class="far fa-flag mr-1"></i>
                                        {{ $isOverdue ? 'Telat ' . abs((int)$daysLeft) . ' hari' : $daysLeft . ' hari lagi' }}
                                    </span>
                                @else
                                    <span class="text-gray-400 flex items-center gap-1">
                                        <i class="far fa-calendar"></i> Tanpa Deadline
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('projects.show', $project) }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1 transition-all group-hover:translate-x-1">
                                Buka <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-xl border-2 border-dashed border-gray-300 p-12 text-center hover:border-blue-400 transition cursor-pointer group" onclick="window.location='{{ route('projects.create') }}'">
                        <div class="w-20 h-20 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl group-hover:bg-blue-50 group-hover:text-blue-500 transition duration-300">
                            <i class="fas fa-folder-plus"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada proyek</h3>
                        <p class="text-gray-500 mb-6 max-w-sm mx-auto">Proyek Anda akan muncul di sini. Mulai kelola tugas dengan membuat proyek baru.</p>
                        <span class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 shadow-md">
                            Buat Proyek Pertama
                        </span>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>