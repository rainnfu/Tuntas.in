<x-app-layout>
    <div x-data="kanbanBoard({{ $project->members->merge([$project->owner]) }})" class="h-full flex flex-col">

        <x-slot name="header">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $project->name }}
                    </h2>
                    <div class="text-sm text-gray-500 mt-1">
                        {{ $project->members->count() + 1 }} Anggota Tim
                    </div>
                </div>

                @if(Auth::id() === $project->owner_id)
                <form action="{{ route('projects.members.store', $project) }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="email" name="email" placeholder="Email teman..." required
                           class="text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-700">
                        Undang
                    </button>
                </form>
                @endif
            </div>

            @if(session('error'))
                <div class="mt-2 text-sm text-red-600">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="mt-2 text-sm text-green-600">{{ session('success') }}</div>
            @endif
        </x-slot>

        <div class="flex flex-1 overflow-x-auto overflow-y-hidden h-[calc(100vh-8rem)] p-6 gap-6">
            
            @foreach ($project->lists->sortBy('order') as $list)
                <div class="w-80 flex-shrink-0 bg-gray-100 rounded-lg shadow-md flex flex-col max-h-full">
                    
                    <div class="p-3 font-bold text-gray-700 border-b border-gray-200 flex justify-between items-center">
                        <span>{{ $list->name }}</span>
                        <span class="text-xs bg-gray-300 px-2 py-1 rounded-full">{{ $list->tasks->count() }}</span>
                    </div>

                    <div class="task-container flex-1 overflow-y-auto p-3 space-y-3 min-h-[50px]" 
                         data-list-id="{{ $list->id }}">
                        
                        @foreach ($list->tasks as $task)
                            <div class="bg-white p-3 rounded shadow-sm hover:shadow-md cursor-pointer border border-gray-200 group relative"
                                 data-task-id="{{ $task->id }}"
                                 @click="openTaskModal({{ $task->id }})">
                                
                                <h4 class="text-sm font-medium text-gray-800">{{ $task->title }}</h4>
                                
                                <div class="mt-2 flex -space-x-1 overflow-hidden">
                                    @foreach($task->assignees as $user)
                                        <div class="inline-block h-6 w-6 rounded-full bg-blue-500 text-white text-xs flex items-center justify-center ring-2 ring-white"
                                             title="{{ $user->name }}">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="p-3 mt-auto border-t border-gray-200">
                        <form action="{{ route('lists.tasks.store', $list) }}" method="POST">
                            @csrf
                            <input type="text" name="title" placeholder="+ Tambah tugas..." 
                                   class="w-full text-sm border-transparent focus:border-blue-500 focus:ring-0 bg-transparent placeholder-gray-500"
                                   autocomplete="off">
                        </form>
                    </div>
                </div>
            @endforeach

        </div>

        <div x-show="isModalOpen" style="display: none;"
             class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
            
            <div class="relative mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white" @click.away="isModalOpen = false">
                
                <div x-show="isLoading" class="text-center py-10">
                    <span class="text-gray-500">Memuat data...</span>
                </div>

                <div x-show="!isLoading">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900" x-text="currentTask.title"></h3>
                        
                        <div class="flex gap-2">
                            <button @click="deleteTask()" class="text-red-500 hover:text-red-700 text-sm font-bold px-2">
                                Hapus
                            </button>
                            <button @click="isModalOpen = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                            <textarea x-model="currentTask.description" 
                                      class="w-full border-gray-300 rounded-md shadow-sm h-32 text-sm"
                                      placeholder="Tambahkan detail deskripsi..."></textarea>
                            <button @click="saveDescription()" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Simpan</button>

                            <div class="mt-6">
                                <h4 class="font-bold text-gray-700 mb-3">Komentar</h4>
                                <div class="space-y-3 max-h-48 overflow-y-auto mb-3 bg-gray-50 p-2 rounded">
                                    <template x-for="comment in currentTask.comments" :key="comment.id">
                                        <div class="text-sm border-b pb-1 mb-1">
                                            <span class="font-bold text-gray-800" x-text="comment.user.name"></span>:
                                            <span class="text-gray-600" x-text="comment.body"></span>
                                        </div>
                                    </template>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" x-model="newComment" @keydown.enter="addComment()" class="w-full border-gray-300 rounded-md shadow-sm text-sm" placeholder="Tulis komentar...">
                                    <button @click="addComment()" class="bg-gray-800 text-white px-3 py-1 rounded text-sm">Kirim</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1 border-l pl-4">
                            
                            <div class="mb-6">
                                <span class="text-xs text-gray-500 uppercase font-bold">Ditugaskan Ke</span>
                                <div class="mt-2 space-y-1">
                                    <template x-for="member in projectMembers" :key="member.id">
                                        <button 
                                            @click="toggleAssign(member.id)"
                                            class="flex items-center w-full px-2 py-1 rounded text-sm text-left transition-colors"
                                            :class="isAssigned(member.id) ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100 text-gray-600'">
                                            
                                            <div class="w-4 h-4 mr-2 border rounded flex items-center justify-center"
                                                 :class="isAssigned(member.id) ? 'bg-blue-500 border-blue-500' : 'border-gray-400'">
                                                <span x-show="isAssigned(member.id)" class="text-white text-xs">&check;</span>
                                            </div>
                                            
                                            <span x-text="member.name"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <div class="mb-4">
                                <span class="text-xs text-gray-500 uppercase font-bold">List</span>
                                <div class="mt-1 badge bg-gray-200 px-2 py-1 rounded text-sm inline-block" x-text="currentTask.list ? currentTask.list.name : '-'"></div>
                            </div>
                            <div class="mb-4">
                                <span class="text-xs text-gray-500 uppercase font-bold">Dibuat Pada</span>
                                <div class="mt-1 text-sm text-gray-700" x-text="new Date(currentTask.created_at).toLocaleDateString()"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div> 
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Inisialisasi Drag & Drop
                const containers = document.querySelectorAll('.task-container');
                containers.forEach(container => {
                    new Sortable(container, {
                        group: 'shared',
                        animation: 150,
                        ghostClass: 'bg-blue-100',
                        onEnd: function (evt) {
                            const taskId = evt.item.getAttribute('data-task-id');
                            const newListId = evt.to.getAttribute('data-list-id');
                            
                            // Kirim AJAX ke server untuk simpan posisi baru
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

            // Logika Alpine JS untuk Modal & Interaksi
            function kanbanBoard(membersData) {
                return {
                    isModalOpen: false,
                    isLoading: false,
                    currentTask: {},
                    newComment: '',
                    projectMembers: membersData, // Data anggota dari Backend
                    
                    openTaskModal(taskId) {
                        this.isModalOpen = true;
                        this.isLoading = true;
                        this.newComment = ''; 
                        
                        fetch(`/tasks/${taskId}`)
                            .then(res => res.json())
                            .then(data => {
                                this.currentTask = data;
                                // Inisialisasi array jika null agar tidak error
                                if(!this.currentTask.assignees) this.currentTask.assignees = [];
                                if(!this.currentTask.comments) this.currentTask.comments = [];
                                this.isLoading = false;
                            })
                            .catch(err => {
                                alert('Gagal memuat data tugas.');
                                this.isModalOpen = false;
                            });
                    },

                    // Fungsi Cek Apakah User Ditugaskan
                    isAssigned(userId) {
                        if (!this.currentTask.assignees) return false;
                        return this.currentTask.assignees.some(u => u.id === userId);
                    },

                    // Fungsi Toggle Assign (Add/Remove)
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
                        }).then(() => alert('Deskripsi tersimpan!'));
                    },

                    deleteTask() {
                        if (!confirm('Yakin ingin menghapus tugas ini secara permanen?')) return;

                        fetch(`/tasks/${this.currentTask.id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(() => {
                            this.isModalOpen = false;
                            window.location.reload(); // Reload agar tugas hilang dari papan
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
                            this.currentTask.comments.push({ 
                                id: Date.now(), 
                                body: data.body, 
                                user: { name: data.user } 
                            });
                            this.newComment = ''; 
                        });
                    }
                }
            }
        </script>
    @endpush
</x-app-layout> 