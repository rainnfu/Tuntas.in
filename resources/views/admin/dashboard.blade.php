<x-app-layout>
    <div class="min-h-screen bg-[#F2F4F3] text-[#344E41] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-xs font-bold text-[#A3B18A] uppercase tracking-[0.2em] mb-2">Super User Access</h2>
                    <h1 class="text-4xl font-black text-[#344E41]">Admin Control Panel</h1>
                </div>
                <div class="bg-[#344E41] text-[#DAD7CD] px-4 py-2 rounded-lg text-xs font-bold shadow-lg">
                    <i class="fas fa-shield-alt mr-2"></i> Mode Administrator Aktif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-[#588157]">
                    <p class="text-xs font-bold text-[#A3B18A] uppercase">Total Users</p>
                    <p class="text-3xl font-black text-[#344E41]">{{ $stats['users'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-[#344E41]">
                    <p class="text-xs font-bold text-[#A3B18A] uppercase">Total Projects</p>
                    <p class="text-3xl font-black text-[#344E41]">{{ $stats['projects'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-orange-400">
                    <p class="text-xs font-bold text-[#A3B18A] uppercase">Aktivitas Hari Ini</p>
                    <p class="text-3xl font-black text-[#344E41]">{{ $stats['logs_today'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-[#A3B18A]/20 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-[#FDFCF8]">
                    <h3 class="font-bold text-lg text-[#344E41]"><i class="fas fa-list-ul mr-2 text-[#588157]"></i> Global Activity Logs</h3>
                    <span class="text-xs text-[#A3B18A]">Memantau seluruh aktivitas sistem</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-[#588157] uppercase bg-[#F2F4F3]">
                            <tr>
                                <th class="px-6 py-4 font-bold">Waktu</th>
                                <th class="px-6 py-4 font-bold">User</th>
                                <th class="px-6 py-4 font-bold">Proyek</th>
                                <th class="px-6 py-4 font-bold">Aksi</th>
                                <th class="px-6 py-4 font-bold">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($logs as $log)
                                <tr class="hover:bg-[#F2F4F3]/50 transition">
                                    <td class="px-6 py-4 text-[#A3B18A] font-mono text-xs whitespace-nowrap">
                                        {{ $log->created_at->format('d M Y, H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-[#344E41] flex items-center gap-2">
                                        <img src="{{ $log->user->avatar_url }}" class="w-6 h-6 rounded-full object-cover">
                                        {{ $log->user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-[#5F6F65]">
                                        {{ optional($log->project)->name ?? 'Project Dihapus' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($log->action == 'create')
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-bold uppercase">Create</span>
                                        @elseif($log->action == 'move')
                                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-[10px] font-bold uppercase">Move</span>
                                        @elseif($log->action == 'delete')
                                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-[10px] font-bold uppercase">Delete</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-[10px] font-bold uppercase">{{ $log->action }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-[#344E41] max-w-md truncate" title="{{ $log->description }}">
                                        {{ $log->description }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada data aktivitas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100">
                    {{ $logs->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>