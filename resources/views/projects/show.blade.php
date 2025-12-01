<x-app-layout>
    <div x-data="kanbanBoard({{ $project->members->merge([$project->owner])->map(function($u){ $u->avatar_url = $u->avatar_url; return $u; }) }})" 
         class="h-[calc(100vh-4rem)] md:h-screen flex flex-col bg-[#F2F4F3] font-sans overflow-hidden">

        <div class="bg-white border-b border-[#A3B18A]/30 px-6 py-4 flex-none z-20 shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#A3B18A] mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:text-[#588157] transition">Dashboard</a>
                        <span class="text-[#DAD7CD]">/</span>
                        <span class="text-[#588157]">Project</span>
                    </div>
                    <h1 class="text-2xl font-black text-[#344E41] tracking-tight flex items-center gap-3">
                        {{ $project->name }}
                        @if($project->owner_id === Auth::id())
                            <span class="bg-[#344E41] text-white text-[10px] px-2 py-0.5 rounded-md uppercase tracking-wider font-bold shadow-sm">Owner</span>
                        @endif
                    </h1>
                </div>

                <div class="flex items-center gap-3">
                    
                    @if(Auth::id() === $project->owner_id)
                        <button @click="fetchLogs({{ $project->id }})" 
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-[#F2F4F3] text-[#588157] hover:bg-[#344E41] hover:text-white transition shadow-sm border border-[#A3B18A]/20" 
                                title="Riwayat Aktivitas">
                            <i class="fas fa-history"></i>
                        </button>
                    @endif

                    @if(Auth::id() === $project->owner_id)
                        <button @click="isCreateOpen = true" 
                                class="bg-[#588157] hover:bg-[#3A5A40] text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg shadow-[#588157]/20 transition flex items-center gap-2 hover:-translate-y-0.5">
                            <i class="fas fa-plus"></i> <span class="hidden md:inline">Tugas Baru</span>
                        </button>
                        <div class="h-8 w-px bg-[#DAD7CD] mx-1"></div>
                    @endif

                    <div class="flex items-center -space-x-3 hover:space-x-1 transition-all duration-300">
                        <div class="relative group cursor-help z-30">
                            <img src="{{ $project->owner->avatar_url }}" class="w-10 h-10 rounded-full border-2 border-white shadow-md object-cover hover:scale-110 transition">
                            <div class="absolute top-full mt-2 left-1/2 -translate-x-1/2 bg-[#344E41] text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-50">
                                Owner: {{ $project->owner->name }}
                            </div>
                        </div>
                        @foreach($project->members->take(4) as $member)
                            <div class="relative group cursor-help z-20">
                                <img src="{{ $member->avatar_url }}" class="w-10 h-10 rounded-full border-2 border-white shadow-md object-cover hover:scale-110 transition">
                                <div class="absolute top-full mt-2 left-1/2 -translate-x-1/2 bg-[#344E41] text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-50">
                                    {{ $member->name }}
                                </div>
                            </div>
                        @endforeach
                        @if($project->members->count() > 4)
                            <button @click="isMembersModalOpen = true" 
                                    class="w-10 h-10 rounded-full border-2 border-white bg-[#DAD7CD] flex items-center justify-center text-xs font-bold text-[#344E41] shadow-md hover:bg-[#A3B18A] hover:text-white transition z-10 relative">
                                +{{ $project->members->count() - 4 }}
                            </button>
                        @endif
                    </div>

                    @if(Auth::id() === $project->owner_id)
                        <button @click="isInviteOpen = !isInviteOpen" class="w-9 h-9 flex items-center justify-center rounded-full border-2 border-dashed border-[#A3B18A] text-[#A3B18A] hover:border-[#588157] hover:text-[#588157] transition ml-2">
                            <i class="fas fa-user-plus"></i>
                        </button>
                        
                        <div x-show="isInviteOpen" @click.away="isInviteOpen = false" style="display: none;"
                             class="absolute top-20 right-6 w-72 bg-white rounded-2xl shadow-xl border border-[#A3B18A]/20 p-4 z-50 animate-fade-in-down">
                            <form action="{{ route('projects.members.store', $project) }}" method="POST">
                                @csrf
                                <label class="text-xs font-bold text-[#344E41] uppercase mb-2 block">Undang Kolaborator</label>
                                <div class="flex gap-2">
                                    <input type="email" name="email" placeholder="email@teman.com" required 
                                           class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#588157] focus:border-[#588157] bg-[#F2F4F3]">
                                    <button type="submit" class="bg-[#344E41] text-white px-3 rounded-lg hover:bg-[#2A3E34] transition">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-x-auto overflow-y-hidden p-6 lg:p-8">
            <div class="flex h-full gap-6 pb-4">
                
                @foreach ($project->lists->sortBy('order') as $list)
                    <div class="w-80 flex-shrink-0 flex flex-col max-h-full bg-[#E2E5E4] rounded-2xl border border-white/50 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)]">
                        
                        <div class="p-4 flex justify-between items-center">
                            <h3 class="font-extrabold text-[#344E41] text-sm uppercase tracking-widest pl-1">
                                {{ $list->name }}
                            </h3>
                            <span class="bg-white text-[#588157] text-xs font-bold px-2.5 py-1 rounded-lg shadow-sm border border-[#A3B18A]/20">
                                {{ $list->tasks->count() }}
                            </span>
                        </div>

                        <div class="task-container flex-1 overflow-y-auto p-3 space-y-3 min-h-[100px] scrollbar-thin scrollbar-thumb-[#A3B18A] scrollbar-track-transparent pr-1" 
                             data-list-id="{{ $list->id }}">
                            
                            @foreach ($list->tasks as $task)
                                @php
                                    $isOverdue = $task->due_date && $task->due_date->isPast() && !Str::contains(Str::lower($task->list->name), ['done', 'selesai']);
                                @endphp

                                <div class="bg-white p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_16px_rgba(88,129,87,0.15)] cursor-pointer border-l-[6px] transition-all duration-200 group relative flex flex-col gap-3 transform hover:-translate-y-0.5
                                            {{ $isOverdue ? 'border-red-400' : 'border-[#A3B18A]' }}"
                                     data-task-id="{{ $task->id }}"
                                     @click="openTaskModal({{ $task->id }})">
                                    
                                    <div class="flex items-center justify-between">
                                        @php
                                            $pColors = [
                                                'low' => 'bg-[#E9EDC9] text-[#5F6F65]',     // Creamy Green
                                                'medium' => 'bg-[#A3B18A] text-white',      // Mint
                                                'high' => 'bg-[#D4A373] text-white',        // Earthy Orange
                                                'urgent' => 'bg-[#BC4749] text-white',      // Muted Red
                                            ];
                                            $pLabel = ucfirst($task->priority ?? 'medium');
                                            $pClass = $pColors[$task->priority ?? 'medium'];
                                        @endphp
                                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-md {{ $pClass }}">
                                            {{ $pLabel }}
                                        </span>

                                        @if($task->due_date)
                                            <div class="text-[10px] font-bold flex items-center gap-1 {{ $isOverdue ? 'text-red-500' : 'text-[#A3B18A]' }}">
                                                <i class="far {{ $isOverdue ? 'fa-exclamation-circle' : 'fa-clock' }}"></i>
                                                {{ $task->due_date->format('d M') }}
                                            </div>
                                        @endif
                                    </div>

                                    <h4 class="text-sm font-bold text-[#344E41] leading-snug line-clamp-2">
                                        {{ $task->title }}
                                    </h4>
                                    
                                    <div class="flex justify-between items-end border-t border-[#F2F4F3] pt-2 mt-1">
                                        <span class="text-[9px] text-[#A3B18A] font-mono tracking-wide">#{{ $task->id }}</span>
                                        
                                        <div class="flex -space-x-1.5 overflow-hidden pl-1">
                                            @forelse($task->assignees as $user)
                                                <img src="{{ $user->avatar_url }}" 
                                                     class="inline-block h-6 w-6 rounded-full ring-2 ring-white object-cover" 
                                                     title="{{ $user->name }}">
                                            @empty
                                                <span class="text-[10px] text-gray-300 italic">Unassigned</span>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="h-2"></div> </div>
                @endforeach
            </div>
        </div>

        <div x-show="isCreateOpen" style="display: none;" 
             class="fixed inset-0 bg-[#344E41]/60 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-transition.opacity>
            <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8 border border-[#A3B18A]/20" @click.away="isCreateOpen = false">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-serif font-bold text-[#344E41]">Tugas Baru</h2>
                    <button @click="isCreateOpen = false" class="text-gray-400 hover:text-[#588157]"><i class="fas fa-times"></i></button>
                </div>
                
                <form action="{{ route('projects.tasks.store', $project) }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-[#588157] uppercase tracking-wider mb-1">Judul Tugas</label>
                        <input type="text" name="title" required 
                               class="w-full rounded-xl border-gray-200 focus:ring-[#588157] focus:border-[#588157] bg-[#F2F4F3] text-[#344E41] font-bold" 
                               placeholder="Contoh: Riset Kompetitor">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#A3B18A] uppercase tracking-wider mb-1">Status</label>
                            <select name="project_list_id" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#588157] focus:border-[#588157]">
                                @foreach($project->lists->sortBy('order') as $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#A3B18A] uppercase tracking-wider mb-1">Prioritas</label>
                            <select name="priority" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#588157] focus:border-[#588157]">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#A3B18A] uppercase tracking-wider mb-1">Tenggat Waktu</label>
                        <input type="date" name="due_date" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#588157] focus:border-[#588157]">
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <button type="button" @click="isCreateOpen = false" class="px-4 py-2 text-[#A3B18A] font-bold hover:text-[#344E41]">Batal</button>
                        <button type="submit" class="px-6 py-2 bg-[#344E41] hover:bg-[#588157] text-white rounded-xl font-bold shadow-lg transition transform hover:-translate-y-0.5">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="isLogOpen" style="display: none;" 
             class="fixed inset-0 bg-[#344E41]/60 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-transition.opacity>
            <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden h-[80vh] flex flex-col" @click.away="isLogOpen = false">
                <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-[#F2F4F3]">
                    <h3 class="font-bold text-[#344E41] flex items-center gap-2"><i class="fas fa-history text-[#588157]"></i> Riwayat Aktivitas</h3>
                    <button @click="isLogOpen = false" class="text-gray-400 hover:text-[#588157]"><i class="fas fa-times"></i></button>
                </div>
                <div class="flex-1 overflow-y-auto p-5 space-y-6 bg-white custom-scrollbar">
                    <template x-for="log in projectLogs" :key="log.id">
                        <div class="flex gap-4 relative animate-fade-in">
                            <div class="absolute left-[15px] top-8 bottom-[-24px] w-0.5 bg-[#DAD7CD]"></div>
                            
                            <img :src="log.avatar_url" class="w-8 h-8 rounded-full bg-gray-200 object-cover border-2 border-white shadow-sm z-10">
                            <div>
                                <div class="text-sm text-[#344E41]">
                                    <span class="font-bold text-[#588157]" x-text="log.user_name"></span> 
                                    <span x-text="log.description.replace(log.user_name, '')"></span>
                                </div>
                                <div class="text-[10px] font-bold text-[#A3B18A] mt-1 uppercase tracking-wide" x-text="log.created_at"></div>
                            </div>
                        </div>
                    </template>
                    <div x-show="projectLogs.length === 0" class="text-center text-[#A3B18A] py-10">
                        <i class="far fa-clipboard text-4xl mb-2 opacity-50"></i>
                        <p>Belum ada aktivitas.</p>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="isMembersModalOpen" style="display: none;" 
             class="fixed inset-0 bg-[#344E41]/60 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-transition.opacity>
            <div class="bg-white w-full max-w-sm rounded-3xl shadow-2xl overflow-hidden" @click.away="isMembersModalOpen = false">
                <div class="bg-[#344E41] px-6 py-5 border-b border-[#588157] flex justify-between items-center">
                    <h3 class="font-bold text-white">Tim Proyek ({{ $project->members->count() + 1 }})</h3>
                    <button @click="isMembersModalOpen = false" class="text-[#A3B18A] hover:text-white"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-2 max-h-[60vh] overflow-y-auto bg-[#F2F4F3]">
                    <div class="bg-white p-3 rounded-xl shadow-sm border border-[#A3B18A]/20 mb-2 flex items-center gap-3">
                        <img src="{{ $project->owner->avatar_url }}" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <div class="font-bold text-[#344E41] text-sm">{{ $project->owner->name }}</div>
                            <div class="text-[10px] font-bold text-[#588157] uppercase">Owner</div>
                        </div>
                    </div>
                    <template x-for="member in projectMembers" :key="member.id">
                        <div x-show="member.id !== {{ $project->owner_id }}" class="bg-white p-3 rounded-xl shadow-sm border border-transparent hover:border-[#A3B18A]/30 mb-2 flex items-center gap-3 transition">
                            <img :src="member.avatar_url" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <div class="font-bold text-[#344E41] text-sm" x-text="member.name"></div>
                                <div class="text-[10px] text-[#A3B18A]" x-text="member.email"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="isModalOpen" style="display: none;"
             class="fixed inset-0 bg-[#344E41]/80 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-transition.opacity>
            <div class="bg-white w-full max-w-5xl rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row h-[85vh] md:h-[80vh]" @click.away="isModalOpen = false">
                
                <div x-show="isLoading" class="absolute inset-0 bg-white z-10 flex flex-col items-center justify-center">
                    <i class="fas fa-circle-notch fa-spin text-4xl text-[#588157] mb-4"></i><span>Loading...</span>
                </div>

                <div class="flex-1 p-8 overflow-y-auto custom-scrollbar">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="bg-[#F2F4F3] text-[#344E41] px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider border border-[#A3B18A]/20" x-text="currentTask.list ? currentTask.list.name : '...'"></span>
                        <h2 class="text-2xl font-serif font-bold text-[#344E41]" x-text="currentTask.title"></h2>
                    </div>
                    
                    <div class="mb-8">
                        <label class="block text-xs font-bold text-[#A3B18A] uppercase tracking-wider mb-3">
                            <i class="fas fa-align-left mr-1"></i> Deskripsi
                        </label>
                        <textarea x-model="currentTask.description" class="w-full bg-[#F2F4F3] border-none rounded-xl p-4 text-sm text-[#344E41] h-40 focus:ring-2 focus:ring-[#588157] placeholder-[#A3B18A]/50 transition resize-none leading-relaxed" placeholder="Deskripsikan detail tugas..."></textarea>
                        <div class="mt-2 text-right"><button @click="saveDescription()" class="text-[#588157] text-xs font-bold hover:underline">Simpan Perubahan</button></div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#A3B18A] uppercase tracking-wider mb-4">
                            <i class="fas fa-comments mr-1"></i> Diskusi
                        </label>
                        <div class="space-y-4 mb-6 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                            <template x-for="comment in currentTask.comments" :key="comment.id">
                                <div class="flex gap-4">
                                    <img :src="comment.user.avatar_url ? comment.user.avatar_url : '{{ asset('assets/avatars/1.jpg') }}'" class="w-8 h-8 rounded-full object-cover shadow-sm">
                                    <div class="flex-1">
                                        <div class="font-bold text-xs text-[#344E41]" x-text="comment.user.name"></div>
                                        <div class="text-sm text-[#5F6F65] bg-[#F2F4F3] p-3 rounded-r-xl rounded-bl-xl mt-1 leading-relaxed" x-text="comment.body"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="flex gap-3">
                            <img src="{{ Auth::user()->avatar_url }}" class="w-8 h-8 rounded-full object-cover">
                            <div class="flex-1 relative">
                                <input type="text" x-model="newComment" @keydown.enter="addComment()" class="w-full bg-white border border-[#A3B18A]/30 rounded-xl pl-4 pr-12 py-3 text-sm focus:ring-[#588157] focus:border-[#588157] shadow-sm" placeholder="Tulis komentar...">
                                <button @click="addComment()" class="absolute right-2 top-2 text-[#588157] hover:bg-[#F2F4F3] p-1.5 rounded-lg transition"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-80 bg-[#F9FAF9] border-l border-[#A3B18A]/20 p-8 flex flex-col gap-8">
                    <button @click="isModalOpen = false" class="absolute top-6 right-6 md:hidden text-gray-400"><i class="fas fa-times text-xl"></i></button>
                    
                    <div>
                        <h4 class="text-xs font-bold text-[#A3B18A] uppercase tracking-wider mb-3">Prioritas</h4>
                        <select x-model="currentTask.priority" @change="savePriority()" class="w-full text-sm border-[#DAD7CD] bg-white rounded-xl focus:ring-[#588157] focus:border-[#588157] text-[#344E41] py-2.5 font-medium shadow-sm">
                            <option value="low">🟢 Low</option>
                            <option value="medium">🟡 Medium</option>
                            <option value="high">🟠 High</option>
                            <option value="urgent">🔴 Urgent</option>
                        </select>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-[#A3B18A] uppercase tracking-wider mb-3">Deadline</h4>
                        <input type="date" x-model="currentTask.due_date_formatted" @change="saveDueDate()" class="w-full text-sm border-[#DAD7CD] bg-white rounded-xl focus:ring-[#588157] focus:border-[#588157] text-[#344E41] py-2.5 shadow-sm">
                    </div>

                    <div class="flex-1">
                        <h4 class="text-xs font-bold text-[#A3B18A] uppercase tracking-wider mb-3">Assignees</h4>
                        <div class="flex flex-col gap-2 max-h-60 overflow-y-auto custom-scrollbar pr-1">
                            <template x-for="member in projectMembers" :key="member.id">
                                <button @click="toggleAssign(member.id)" class="flex items-center gap-3 w-full p-2 rounded-xl transition-all border group"
                                        :class="isAssigned(member.id) ? 'bg-[#588157] border-[#588157] text-white shadow-md' : 'bg-white border-transparent hover:border-[#A3B18A]/30 hover:shadow-sm text-[#344E41]'">
                                    
                                    <img :src="member.avatar_url" class="w-6 h-6 rounded-full object-cover bg-white/20">
                                    <span class="text-xs font-bold flex-1 text-left" x-text="member.name"></span>
                                    <i class="fas fa-check text-white" x-show="isAssigned(member.id)"></i>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <button @click="deleteTask()" class="w-full flex items-center justify-center gap-2 text-red-500 bg-red-50 hover:bg-red-100 py-3 rounded-xl text-xs font-bold transition">
                            <i class="far fa-trash-alt"></i> Hapus Tugas
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script>
            // LOGIKA JAVASCRIPT (SAMA PERSIS DENGAN SEBELUMNYA)
            document.addEventListener('DOMContentLoaded', function () {
                const containers = document.querySelectorAll('.task-container');
                containers.forEach(container => {
                    new Sortable(container, {
                        group: 'shared',
                        animation: 150,
                        ghostClass: 'bg-[#DAD7CD]', // Ghost color updated
                        onEnd: function (evt) {
                            const taskId = evt.item.getAttribute('data-task-id');
                            const newListId = evt.to.getAttribute('data-list-id');
                            fetch(`/tasks/${taskId}/move`, {
                                method: 'PATCH',
                                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                                body: JSON.stringify({ project_list_id: newListId })
                            });
                        }
                    });
                });
            });

            function kanbanBoard(membersData) {
                return {
                    isModalOpen: false, isCreateOpen: false, isLogOpen: false, isInviteOpen: false, isMembersModalOpen: false,
                    isLoading: false, currentTask: {}, newComment: '', projectMembers: membersData, projectLogs: [],

                    fetchLogs(projectId) {
                        this.isLogOpen = true; this.projectLogs = [];
                        fetch(`/projects/${projectId}/logs`).then(res => res.json()).then(data => this.projectLogs = data);
                    },
                    openTaskModal(taskId) {
                        this.isModalOpen = true; this.isLoading = true; this.newComment = '';
                        fetch(`/tasks/${taskId}`).then(res => res.json()).then(data => {
                            this.currentTask = data;
                            if(this.currentTask.due_date) this.currentTask.due_date_formatted = this.currentTask.due_date.split('T')[0];
                            if(!this.currentTask.priority) this.currentTask.priority = 'medium';
                            if(!this.currentTask.assignees) this.currentTask.assignees = [];
                            if(!this.currentTask.comments) this.currentTask.comments = [];
                            this.isLoading = false;
                        }).catch(() => { this.isModalOpen = false; });
                    },
                    isAssigned(userId) {
                        if (!this.currentTask.assignees) return false;
                        return this.currentTask.assignees.some(u => u.id === userId);
                    },
                    toggleAssign(userId) {
                        fetch(`/tasks/${this.currentTask.id}/assign`, {
                            method: 'POST', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                            body: JSON.stringify({ user_id: userId })
                        }).then(res => res.json()).then(data => {
                            if (data.attached) this.currentTask.assignees.push(data.user);
                            else this.currentTask.assignees = this.currentTask.assignees.filter(u => u.id !== userId);
                        });
                    },
                    saveDescription() {
                        fetch(`/tasks/${this.currentTask.id}`, { method: 'PUT', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}, body: JSON.stringify({ description: this.currentTask.description }) });
                    },
                    saveDueDate() {
                        fetch(`/tasks/${this.currentTask.id}`, { method: 'PUT', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}, body: JSON.stringify({ due_date: this.currentTask.due_date_formatted }) });
                    },
                    savePriority() {
                        fetch(`/tasks/${this.currentTask.id}`, { method: 'PUT', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}, body: JSON.stringify({ priority: this.currentTask.priority }) }).then(() => window.location.reload());
                    },
                    deleteTask() {
                        if (!confirm('Yakin?')) return;
                        fetch(`/tasks/${this.currentTask.id}`, { method: 'DELETE', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')} }).then(() => window.location.reload());
                    },
                    addComment() {
                        if(!this.newComment) return;
                        fetch(`/tasks/${this.currentTask.id}/comments`, { method: 'POST', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}, body: JSON.stringify({ body: this.newComment }) }).then(res => res.json()).then(data => {
                            if(!data.user.avatar_url) data.user.avatar_url = "{{ asset('assets/avatars/1.jpg') }}";
                            this.currentTask.comments.push({ id: Date.now(), body: data.body, user: data.user });
                            this.newComment = '';
                        });
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>