<x-app-layout>
    <div x-data="dashboardBoard()" class="min-h-screen bg-[#F2F4F3] font-sans text-[#344E41]">
        
        <div class="bg-white border-b border-[#A3B18A]/20 px-4 sm:px-8 py-8 shadow-[0_4px_20px_-10px_rgba(88,129,87,0.1)]">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-end gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="h-8 w-1 bg-[#588157] rounded-full"></div>
                        <h2 class="text-xs font-bold text-[#A3B18A] uppercase tracking-[0.2em]">Workspace</h2>
                    </div>
                    <h1 class="text-4xl font-bold text-[#344E41] tracking-tight">
                        Dashboard
                    </h1>
                    <p class="text-[#5F6F65] mt-2 font-medium flex items-center gap-2">
                        <i class="far fa-calendar text-[#588157]"></i> 
                        {{ now()->format('l, d F Y') }}
                        <span class="w-1 h-1 rounded-full bg-[#A3B18A]"></span>
                        <span class="text-sm">Fokus pada prioritas hari ini.</span>
                    </p>
                </div>

                <a href="{{ route('projects.create') }}" 
                   class="group flex items-center gap-3 bg-[#344E41] hover:bg-[#2A3E34] text-white pl-5 pr-6 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-plus bg-[#588157] p-1.5 rounded-lg text-xs group-hover:rotate-90 transition-transform"></i>
                    <span class="font-bold tracking-wide">Proyek Baru</span>
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            @if(session('success'))
                <div class="mb-8 flex items-center gap-4 bg-[#588157] text-white p-4 rounded-xl shadow-lg animate-fade-in-down">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check"></i>
                    </div>
                    <p class="font-medium">{{ session('success') }}</p>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-white/70 hover:text-white"><i class="fas fa-times"></i></button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-5 rounded-2xl border border-[#DAD7CD] shadow-sm flex items-center gap-5 relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-[#A3B18A]/10 rounded-bl-[4rem] transition-transform group-hover:scale-110"></div>
                    <div class="w-12 h-12 bg-[#F2F4F3] text-[#344E41] rounded-xl flex items-center justify-center text-xl shadow-inner">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#A3B18A] uppercase tracking-wider">Total Proyek</p>
                        <p class="text-3xl font-black text-[#344E41]">{{ $projects->count() }}</p>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-[#DAD7CD] shadow-sm flex items-center gap-5 relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-[#588157]/10 rounded-bl-[4rem] transition-transform group-hover:scale-110"></div>
                    <div class="w-12 h-12 bg-[#F2F4F3] text-[#588157] rounded-xl flex items-center justify-center text-xl shadow-inner">
                        <i class="fas fa-user-astronaut"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#A3B18A] uppercase tracking-wider">Milik Saya</p>
                        <p class="text-3xl font-black text-[#344E41]">{{ Auth::user()->ownedProjects->count() }}</p>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-[#DAD7CD] shadow-sm flex items-center gap-5 relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-orange-100 rounded-bl-[4rem] transition-transform group-hover:scale-110"></div>
                    <div class="w-12 h-12 bg-[#F2F4F3] text-orange-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#A3B18A] uppercase tracking-wider">Kolaborasi</p>
                        <p class="text-3xl font-black text-[#344E41]">{{ Auth::user()->projects->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-xl text-[#344E41]">Project List</h3>
                <span class="text-xs font-medium text-[#A3B18A] bg-white px-3 py-1.5 rounded-full border border-[#DAD7CD] shadow-sm">
                    <i class="fas fa-sort mr-1"></i> Drag to Reorder
                </span>
            </div>

            <div id="project-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pb-20">
                @forelse ($projects as $project)
                    <div class="project-card bg-white rounded-2xl border border-[#DAD7CD] hover:border-[#588157] shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_24px_rgba(88,129,87,0.15)] transition-all duration-300 relative group flex flex-col h-full"
                         data-id="{{ $project->id }}">
                        
                        <div class="drag-handle absolute top-4 right-4 text-[#A3B18A] hover:text-[#344E41] cursor-move p-2 rounded-lg hover:bg-[#F2F4F3] transition z-20">
                            <i class="fas fa-grip-vertical"></i>
                        </div>

                        @if($project->owner_id === Auth::id())
                            <div class="absolute top-4 right-12 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-20">
                                <a href="{{ route('projects.edit', $project) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#F2F4F3] text-[#588157] hover:bg-[#588157] hover:text-white transition" title="Edit">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Hapus proyek?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition" title="Hapus">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div class="p-6 flex-1 cursor-pointer" onclick="if(!this.closest('.project-card').classList.contains('cursor-move')) window.location='{{ route('projects.show', $project) }}'">
                            
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-12 h-12 rounded-xl bg-[#344E41] flex items-center justify-center text-white text-lg font-bold shadow-md group-hover:bg-[#588157] transition-colors">
                                    {{ substr($project->name, 0, 1) }}
                                </div>
                                <div>
                                    @if($project->owner_id === Auth::id())
                                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-[#588157]/10 text-[#588157] mb-1">
                                            Owner
                                        </span>
                                    @else
                                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-orange-100 text-orange-700 mb-1">
                                            Team
                                        </span>
                                    @endif
                                    <h3 class="text-lg font-bold text-[#344E41] leading-tight line-clamp-1 group-hover:text-[#588157] transition-colors">
                                        {{ $project->name }}
                                    </h3>
                                </div>
                            </div>

                            <p class="text-sm text-[#5F6F65] leading-relaxed line-clamp-2 h-10 mb-4">
                                {{ $project->description ?? 'Tidak ada deskripsi.' }}
                            </p>

                            <div class="h-px w-full bg-gradient-to-r from-transparent via-[#DAD7CD] to-transparent mb-4"></div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <img src="{{ $project->owner->avatar_url }}" class="w-6 h-6 rounded-full border border-white shadow-sm" title="Owner">
                                    
                                    <div class="text-xs font-medium">
                                        @if($project->deadline)
                                            @php
                                                $isOverdue = $project->deadline->isPast();
                                                $timeLeft = $project->deadline->diffForHumans(null, true);
                                            @endphp
                                            <div class="flex flex-col">
                                                <span class="{{ $isOverdue ? 'text-red-500' : 'text-[#588157]' }} font-bold flex items-center gap-1">
                                                    <i class="far {{ $isOverdue ? 'fa-bell' : 'fa-clock' }}"></i>
                                                    {{ $isOverdue ? 'Telat ' . $timeLeft : $timeLeft . ' lagi' }}
                                                </span>
                                                <span class="text-[#A3B18A] text-[10px] mt-0.5 pl-4">
                                                    {{ $project->deadline->format('d M, H:i') }} WIB
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-[#A3B18A] italic">-- : --</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="w-8 h-8 rounded-full bg-[#F2F4F3] flex items-center justify-center text-[#588157] group-hover:bg-[#588157] group-hover:text-white transition-all transform group-hover:translate-x-1">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full border-2 border-dashed border-[#DAD7CD] rounded-3xl p-12 text-center hover:border-[#588157] transition cursor-pointer bg-[#FDFCF8]" 
                         onclick="window.location='{{ route('projects.create') }}'">
                        <div class="w-16 h-16 bg-[#F2F4F3] rounded-full flex items-center justify-center mx-auto mb-4 text-2xl text-[#A3B18A]">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3 class="text-lg font-bold text-[#344E41]">Mulai Proyek Pertama</h3>
                        <p class="text-sm text-[#5F6F65] mt-1">Atur jadwal dan tugas tim dengan mudah.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script>
            function dashboardBoard() {
                return {
                    init() {
                        const el = document.getElementById('project-grid');
                        if(el) {
                            new Sortable(el, {
                                animation: 200,
                                ghostClass: 'opacity-50',
                                handle: '.drag-handle',
                                onEnd: () => { this.saveOrder(); }
                            });
                        }
                    },
                    saveOrder() {
                        const order = Array.from(document.querySelectorAll('.project-card')).map(el => el.getAttribute('data-id'));
                        fetch('{{ route("projects.reorder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ order: order })
                        });
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>