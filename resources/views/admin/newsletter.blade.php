<x-admin-layout>
    <div class="space-y-8">
        <!-- Header & Action -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight font-outfit">Gestion de la Newsletter</h1>
                <p class="mt-1.5 text-sm text-gray-500 font-medium">Visualisez, recherchez et gérez les abonnés de la newsletter.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <!-- Search bar -->
                <form method="GET" action="{{ route('admin.newsletter.index') }}" class="relative w-full sm:w-64">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Rechercher un email..." class="w-full bg-white text-xs rounded-full pl-10 pr-16 py-2.5 border-gray-200 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-300 shadow-sm">
                    <span class="absolute left-3.5 top-3 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    @if($search)
                        <a href="{{ route('admin.newsletter.index') }}" class="absolute right-3 top-2 text-[10px] text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full px-2 py-1 transition-colors">Effacer</a>
                    @endif
                </form>

                <!-- Export CSV Button -->
                <a href="{{ route('admin.newsletter.export') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-orange-600 text-white hover:bg-orange-700 transition-colors text-xs font-semibold rounded-full shadow-sm">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Exporter en CSV
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 text-sm font-semibold rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Card -->
            <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-2xl flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L22 8m-9.3 1.25l-2.28 1.52a4 4 0 01-4.44 0L3.8 9.25M3 18V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Abonnés Actifs</p>
                    <h3 class="text-2xl font-black text-gray-900 font-outfit mt-0.5">{{ $totalCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Subscribers Table Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm text-left">
                    <thead class="bg-gray-50/50">
                        <tr class="text-gray-400 font-semibold text-xs uppercase">
                            <th class="px-6 py-4">Abonné</th>
                            <th class="px-6 py-4">Date d'inscription</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                        @forelse($subscribers as $subscriber)
                            <tr class="hover:bg-gray-50/30 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-orange-50 text-orange-600 font-bold flex items-center justify-center text-xs uppercase">
                                            {{ substr($subscriber->email, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 leading-snug">{{ $subscriber->email }}</p>
                                            <p class="text-[10px] text-gray-400">ID: {{ $subscriber->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    {{ $subscriber->created_at->format('d/m/Y \à H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Delete Action -->
                                        <form method="POST" action="{{ route('admin.newsletter.destroy', $subscriber) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet abonné de la newsletter ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L22 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        <span>Aucun abonné trouvé.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($subscribers->hasPages())
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                    {{ $subscribers->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
