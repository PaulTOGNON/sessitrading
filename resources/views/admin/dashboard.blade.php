<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tableau de Bord</h1>
            <p class="mt-1.5 text-sm text-gray-500 font-medium">Aperçu global de l'activité commerciale de Sessitrading.</p>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Metric 1: Revenue -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Chiffre d'Affaires</span>
                    <h3 class="text-2xl font-bold text-gray-900">{{ number_format($estimatedRevenue, 0, ',', ' ') }} F</h3>
                    <span class="text-xs text-emerald-600 font-bold flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Revenus estimés
                    </span>
                </div>
                <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Metric 2: Orders -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Commandes</span>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</h3>
                    <span class="text-xs text-gray-500 font-medium">Commandes totales passées</span>
                </div>
                <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
            </div>

            <!-- Metric 3: Products -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Catalogue</span>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</h3>
                    <span class="text-xs text-gray-500 font-medium">Articles au catalogue</span>
                </div>
                <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>

            <!-- Metric 4: Users -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Clients</span>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</h3>
                    <span class="text-xs text-gray-500 font-medium">Utilisateurs enregistrés</span>
                </div>
                <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Lists Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Orders (2/3 width on desktop) -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Commandes Récentes</h2>
                        <p class="text-xs text-gray-400 font-medium">Dernières commandes enregistrées sur la boutique.</p>
                    </div>
                    <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 bg-orange-50 px-3.5 py-2 rounded-xl transition-colors duration-200">Voir tout</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm text-left">
                        <thead>
                            <tr class="text-gray-400 font-semibold text-xs uppercase">
                                <th class="py-3.5">ID</th>
                                <th class="py-3.5">Client</th>
                                <th class="py-3.5">Total</th>
                                <th class="py-3.5">Statut</th>
                                <th class="py-3.5">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 font-medium">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                    <td class="py-4 text-gray-500">#{{ $order->id }}</td>
                                    <td class="py-4 text-gray-900">{{ $order->user ? ($order->user->first_name . ' ' . $order->user->last_name) : 'Client Supprimé' }}</td>
                                    <td class="py-4 text-gray-900">{{ number_format($order->total_amount, 0, ',', ' ') }} F</td>
                                    <td class="py-4">
                                        @if($order->status === 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-100">En attente</span>
                                        @elseif($order->status === 'confirmed')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-full bg-blue-50 text-blue-700 border border-blue-100">Confirmé</span>
                                        @elseif($order->status === 'shipped')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">Expédié</span>
                                        @elseif($order->status === 'delivered')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">Livré</span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-full bg-red-50 text-red-700 border border-red-100">Annulé</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-gray-400 text-xs">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-400">Aucune commande enregistrée pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Registrations (1/3 width on desktop) -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Nouveaux Clients</h2>
                        <p class="text-xs text-gray-400 font-medium">Dernières inscriptions.</p>
                    </div>
                    <a href="{{ route('admin.users') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 bg-orange-50 px-3.5 py-2 rounded-xl transition-colors duration-200">Voir tout</a>
                </div>

                <div class="space-y-4">
                    @forelse($recentUsers as $user)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-700 font-bold flex items-center justify-center text-sm uppercase">
                                    {{ substr($user->first_name ?? $user->name, 0, 2) }}
                                </div>
                                <div class="space-y-0.5">
                                    <h4 class="text-sm font-semibold text-gray-900">{{ $user->name }}</h4>
                                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-8 text-sm">Aucun client inscrit pour le moment.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
