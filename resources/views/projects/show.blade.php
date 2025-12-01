<x-app-layout>
    <div x-data="kanbanBoard({{ $project->members->merge([$project->owner])->map(function($u){ $u->avatar_url = $u->avatar_url; return $u; }) }})" 
         class="h-screen flex flex-col bg-gradient-to-br from-gray-50 to-blue-50 overflow-hidden">

        <div class="bg-white border-b border-gray-200 shadow-sm px-6 py-4 flex-none z-20">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                
                <div>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition"><i class="fas fa-home"></i> Dashboard</a>
                        <span class="text-gray-300">/</span>
                        <span>Project</span>
                    </div>
                    <h1 class="text-2xl font-black text-gray-800 tracking-tight flex items-center gap-3">
                        {{ $project->name }}
                        @if($project->owner_id === Auth::id())
                            <span class="bg-blue-100 text-blue-700 text-[10px] px-2 py-0.5 rounded-full uppercase tracking-wider font-bold">Owner</span>
                        @endif
                    </h1>
                </div>

                <div class="flex items-center gap-4">
                    
                    @if(Auth::id() === $project->owner_id)
                        <button @click="fetchLogs({{ $project->id }})" 
                                class="bg-white border border-gray-200 text-gray-500 hover:text-blue-600 hover:border-blue-300 p-2 rounded-lg shadow-sm transition flex items-center gap-2 text-sm font-medium" 
                                title="Riwayat Aktivitas">
                            <i class="fas fa-history"></i> <span class="hidden md:inline">Log</span>
                        </button>
                        <div class="h-8 w-px bg-gray-300 mx-2"></div>
                    @endif

                    <div class="flex items-center -space-x-3 hover:space-x-1 transition-all duration-300">
                        <img src="{{ $project->owner->avatar_url }}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" title="Owner: {{ $project->owner->name }}">
                        @foreach($project->members->take(4) as $member)
                            <img src="{{ $member->avatar_url }}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" title="{{ $member->name }}">
                        @endforeach
                        @if($project->members->count() > 4)
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500 shadow-sm">
                                +{{ $project->members->count() - 4 }}
                            </div>
                        @endif
                    </div>

                    @if(Auth::id() === $project->owner_id)
                        <form action="{{ route('projects.members.store', $project) }}" method="POST" class="flex items-center">
                            @csrf
                            <div class="relative group">
                                <input type="email" name="email" placeholder="Undang email..." required
                                       class="pl-3 pr-10 py-2 text-sm border-gray-300 rounded-l-lg focus:ring-blue-500 focus:border-blue-500 w-32 md:w-48 transition-all group-hover:w-64 outline-none">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-r-lg text-sm font-bold shadow-md transition">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-x-auto overflow-y-hidden p-6">
            <div class="flex h-full gap-6 pb-4">
                
                @foreach ($project->lists->sortBy('order') as $list)
                    <div class="w-80 flex-shrink-0 flex flex-col max-h-full bg-gray-100 rounded-xl border border-gray-200 shadow-sm">
                        
                        <div class="p-4 flex justify-between items-center border-b border-gray-200/50">
                            <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide">
                                {{ $list->name }}
                            </h3>
                            <span class="bg-gray-200 text-gray-600 text-xs font-bold px-2 py-1 rounded-md">
                                {{ $list->tasks->count() }}
                            </span>
                        </div>

                        <div class="task-container flex-1 overflow-y-auto p-3 space-y-3 min-h-[100px] scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent" 
                             data-list-id="{{ $list->id }}">
                            
                            @foreach ($list->tasks as $task)
                                @php
                                    $isOverdue = $task->due_date && $task->due_date->isPast() && 
                                                 !Str::contains(Str::lower($task->list->name), ['done', 'selesai']);
                                @endphp

                                <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-lg cursor-pointer border-l-4 transition-all duration-200 group relative
                                            {{ $isOverdue ? 'border-red-500' : 'border-transparent hover:border-blue-300' }}"
                                     data-task-id="{{ $task->id }}"
                                     @click="openTaskModal({{ $task->id }})">
                                    
                                    @if($task->due_date)
                                        <div class="mb-2 text-[10px] font-bold uppercase tracking-wide flex items-center gap-1
                                            {{ $isOverdue ? 'text-red-600' : 'text-gray-400' }}">
                                            <i class="far fa-clock"></i> 
                                            {{ $task->due_date->format('d M') }}
                                        </div>
                                    @endif

                                    <h4 class="text-sm font-semibold text-gray-800 leading-snug mb-3">
                                        {{ $task->title }}
                                    </h4>
                                    
                                    <div class="flex justify-between items-end">
                                        <span class="text-[10px] text-gray-400 font-mono">#TSK-{{ $task->id }}</span>
                                        <div class="flex -space-x-2 overflow-hidden py-1 pl-1">
                                            @forelse($task->assignees as $user)
                                                <img src="{{ $user->avatar_url }}" class="inline-block h-6 w-6 rounded-full ring-2 ring-white object-cover" title="{{ $user->name }}">
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="p-3 mt-auto">
                            @if(Auth::id() === $project->owner_id)
                                <form action="{{ route('lists.tasks.store', $list) }}" method="POST">
                                    @csrf
                                    <div class="relative">
                                        <input type="text" name="title" placeholder="+ Tambah tugas baru..." 
                                               class="w-full text-sm border-none bg-white focus:bg-white focus:ring-2 focus:ring-blue-500 rounded-lg py-2 pl-3 pr-8 shadow-sm transition placeholder-gray-400"
                                               autocomplete="off" required>
                                        <button type="submit" class="absolute right-2 top-1.5 text-gray-400 hover:text-blue-600 transition">
                                            <i class="fas fa-paper-plane text-xs"></i>
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div x-show="isModalOpen" style="display: none;"
             class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity"
             x-transition.opacity>
            
            <div class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row h-[85vh] md:h-auto" @click.away="isModalOpen = false">
                
                <div x-show="isLoading" class="absolute inset-0 bg-white z-10 flex flex-col items-center justify-center">
                    <i class="fas fa-circle-notch fa-spin text-4xl text-blue-500 mb-4"></i>
                    <span class="text-gray-500 font-medium">Mengambil detail tugas...</span>
                </div>

                <div class="flex-1 p-8 overflow-y-auto">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                             <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-md text-xs font-medium bg-gray-100 text-gray-800 mb-3">
                                <i class="fas fa-list-ul text-gray-400"></i> 
                                <span x-text="currentTask.list ? currentTask.list.name : '...'"></span>
                            </span>
                            <h2 class="text-2xl font-bold text-gray-900 leading-tight" x-text="currentTask.title"></h2>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                            <i class="fas fa-align-left mr-1"></i> Deskripsi
                        </label>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 hover:border-blue-200 transition focus-within:ring-2 focus-within:ring-blue-100">
                            <textarea x-model="currentTask.description" 
                                      class="w-full bg-transparent border-none focus:ring-0 text-gray-700 text-sm h-32 resize-none p-0"
                                      placeholder="Tuliskan detail pekerjaan di sini..."></textarea>
                            <div class="mt-2 flex justify-end">
                                <button @click="saveDescription()" class="bg-gray-800 hover:bg-black text-white px-4 py-1.5 rounded-md text-sm font-medium transition">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">
                            <i class="fas fa-comments mr-1"></i> Komentar
                        </label>
                        <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2">
                            <template x-for="comment in currentTask.comments" :key="comment.id">
                                <div class="flex gap-3 group">
                                    <img :src="comment.user.avatar_url ? comment.user.avatar_url : '{{ asset('assets/avatars/1.png') }}'" 
                                         class="w-8 h-8 rounded-full bg-blue-100 object-cover flex-shrink-0">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-sm text-gray-900" x-text="comment.user.name"></span>
                                        </div>
                                        <div class="text-sm text-gray-600 mt-1 bg-gray-50 p-2 rounded-lg rounded-tl-none border border-gray-100" x-text="comment.body"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="flex gap-3 items-start">
                            <img src="{{ Auth::user()->avatar_url }}" class="w-8 h-8 rounded-full object-cover">
                            <div class="flex-1 relative">
                                <input type="text" x-model="newComment" @keydown.enter="addComment()" 
                                       class="w-full border-gray-200 rounded-lg pl-4 pr-12 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                       placeholder="Tulis komentar...">
                                <button @click="addComment()" class="absolute right-2 top-2 text-blue-600 hover:bg-blue-50 p-1 rounded transition">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-80 bg-gray-50 border-l border-gray-100 p-6 flex flex-col gap-6">
                    <button @click="isModalOpen = false" class="absolute top-4 right-4 md:hidden text-gray-500">
                        <i class="fas fa-times text-xl"></i>
                    </button>

                    <div>
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tenggat Waktu</h4>
                        <div class="relative">
                            <input type="date" x-model="currentTask.due_date_formatted" 
                                   @change="saveDueDate()"
                                   class="w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 shadow-sm text-gray-600">
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Anggota Tim</h4>
                        <div class="flex flex-col gap-2 max-h-60 overflow-y-auto pr-1 custom-scrollbar">
                            <template x-for="member in projectMembers" :key="member.id">
                                <button @click="toggleAssign(member.id)"
                                        class="flex items-center gap-3 w-full p-2 rounded-lg transition-all border group"
                                        :class="isAssigned(member.id) ? 'bg-blue-50 border-blue-200' : 'bg-white border-transparent hover:border-gray-200 hover:shadow-sm'">
                                    
                                    <img :src="member.avatar_url" class="w-8 h-8 rounded-full object-cover bg-gray-200">
                                    <span class="text-sm font-medium text-gray-700 flex-1 text-left" x-text="member.name"></span>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center transition"
                                         :class="isAssigned(member.id) ? 'bg-blue-500 border-blue-500' : 'border-gray-300 bg-white'">
                                        <i class="fas fa-check text-white text-[10px]" x-show="isAssigned(member.id)"></i>
                                    </div>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="mt-auto pt-6 border-t border-gray-200">
                         <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Tindakan</h4>
                         <button @click="deleteTask()" class="w-full flex items-center justify-center gap-2 bg-white border border-red-200 text-red-600 hover:bg-red-50 py-2 rounded-lg text-sm font-medium transition">
                            <i class="far fa-trash-alt"></i> Hapus Tugas
                         </button>
                         <button @click="isModalOpen = false" class="w-full mt-3 text-gray-400 hover:text-gray-600 text-sm transition">
                            Tutup (Esc)
                         </button>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="isLogOpen" style="display: none;" 
             class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             x-transition.opacity>
            <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden h-[80vh] flex flex-col" @click.away="isLogOpen = false">
                <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <h3 class="font-bold text-gray-700"><i class="fas fa-history mr-2"></i> Riwayat Aktivitas</h3>
                    <button @click="isLogOpen = false" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    <template x-for="log in projectLogs" :key="log.created_at">
                        <div class="flex gap-3 text-sm animate-fade-in">
                            <img :src="log.avatar_url" class="w-8 h-8 rounded-full bg-gray-200 object-cover mt-1 border border-gray-100">
                            <div>
                                <div class="font-medium text-gray-800">
                                    <span class="font-bold text-blue-600" x-text="log.user_name"></span> 
                                    <span x-text="log.description.replace(log.user_name, '')"></span>
                                </div>
                                <div class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                    <i class="far fa-clock"></i> <span x-text="log.created_at"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div x-show="projectLogs.length === 0" class="text-center text-gray-400 py-10 flex flex-col items-center">
                        <i class="far fa-clipboard text-4xl mb-2 opacity-50"></i>
                        <p>Belum ada aktivitas.</p>
                    </div>
                </div>
            </div>
        </div>

    </div> 

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const containers = document.querySelectorAll('.task-container');
                containers.forEach(container => {
                    new Sortable(container, {
                        group: 'shared',
                        animation: 150,
                        ghostClass: 'bg-blue-50',
                        onEnd: function (evt) {
                            const taskId = evt.item.getAttribute('data-task-id');
                            const newListId = evt.to.getAttribute('data-list-id');
                            fetch(`/tasks/${taskId}/move`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ project_list_id: newListId })
                            });
                        }
                    });
                });
            });

            function kanbanBoard(membersData) {
                return {
                    isModalOpen: false,
                    isLogOpen: false,
                    isLoading: false,
                    currentTask: {},
                    newComment: '',
                    projectMembers: membersData,
                    projectLogs: [],

                    openTaskModal(taskId) {
                        this.isModalOpen = true;
                        this.isLoading = true;
                        this.newComment = ''; 
                        fetch(`/tasks/${taskId}`)
                            .then(res => res.json())
                            .then(data => {
                                this.currentTask = data;
                                // Parsing Tanggal untuk Input HTML (YYYY-MM-DD)
                                if(this.currentTask.due_date) {
                                    this.currentTask.due_date_formatted = this.currentTask.due_date.split('T')[0];
                                } else {
                                    this.currentTask.due_date_formatted = '';
                                }

                                if(!this.currentTask.assignees) this.currentTask.assignees = [];
                                if(!this.currentTask.comments) this.currentTask.comments = [];
                                this.isLoading = false;
                            })
                            .catch(err => { alert('Error loading task'); this.isModalOpen = false; });
                    },

                    fetchLogs(projectId) {
                        this.isLogOpen = true;
                        this.projectLogs = [];
                        fetch(`/projects/${projectId}/logs`)
                            .then(res => res.json())
                            .then(data => this.projectLogs = data);
                    },

                    isAssigned(userId) {
                        if (!this.currentTask.assignees) return false;
                        return this.currentTask.assignees.some(u => u.id === userId);
                    },

                    toggleAssign(userId) {
                        fetch(`/tasks/${this.currentTask.id}/assign`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ user_id: userId })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.attached) {
                                this.currentTask.assignees.push(data.user);
                            } else {
                                this.currentTask.assignees = this.currentTask.assignees.filter(u => u.id !== userId);
                            }
                        });
                    },

                    saveDescription() {
                        fetch(`/tasks/${this.currentTask.id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ description: this.currentTask.description })
                        });
                    },

                    // LOGIC SIMPAN TANGGAL
                    saveDueDate() {
                        fetch(`/tasks/${this.currentTask.id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ 
                                due_date: this.currentTask.due_date_formatted 
                            })
                        });
                    },

                    deleteTask() {
                        if (!confirm('Yakin hapus tugas ini?')) return;
                        fetch(`/tasks/${this.currentTask.id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        }).then(() => {
                            window.location.reload(); 
                        });
                    },

                    addComment() {
                        if(!this.newComment) return;
                        fetch(`/tasks/${this.currentTask.id}/comments`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ body: this.newComment })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if(!data.user.avatar_url) data.user.avatar_url = "{{ asset('assets/avatars/1.png') }}"; 
                            this.currentTask.comments.push({ 
                                id: Date.now(), 
                                body: data.body, 
                                user: data.user 
                            });
                            this.newComment = ''; 
                        });
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>