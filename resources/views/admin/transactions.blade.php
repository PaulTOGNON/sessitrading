<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Transactions FedaPay</h1>
                <p class="mt-1.5 text-sm text-gray-500 font-medium">Historique complet des paiements inities via FedaPay sur la plateforme.</p>
            </div>
        </div>

        <!-- Filter bar -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form action="{{ route('admin.transactions.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-grow">
                    <label for="q" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Recherche</label>
                    <div class="relative">
                        <input type="text" name="q" id="q" value="{{ $search }}" placeholder="ID Commande, ID Transaction, Reference, Client..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-200 text-sm focus:border-orange-500 focus:ring-orange-500 shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-48">
                    <label for="status" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Statut</label>
                    <select name="status" id="status" class="w-full py-2.5 rounded-xl border-gray-200 text-sm focus:border-orange-500 focus:ring-orange-500 shadow-sm">
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ $filterStatus === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="approved" {{ $filterStatus === 'approved' ? 'selected' : '' }}>Approuve</option>
                        <option value="declined" {{ $filterStatus === 'declined' ? 'selected' : '' }}>Refuse</option>
                        <option value="canceled" {{ $filterStatus === 'canceled' ? 'selected' : '' }}>Annule</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold px-6 py-2.5 rounded-xl transition-colors duration-150 shadow-sm text-sm">Filtrer</button>
                    @if($search || $filterStatus)
                        <a href="{{ route('admin.transactions.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-4 py-2.5 rounded-xl transition-colors duration-150 text-sm flex items-center justify-center">Reinitialiser</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden" x-data="{ openDetails: null }">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-400 font-semibold text-xs uppercase">
                            <th class="px-6 py-4">FedaPay ID</th>
                            <th class="px-6 py-4">Commande</th>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Montant</th>
                            <th class="px-6 py-4">Methode</th>
                            <th class="px-6 py-4">Statut</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 font-medium text-gray-900">
                        @forelse($transactions as $tx)
                            <tr class="hover:bg-gray-50/30 transition-colors duration-150">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">
                                    {{ $tx->transaction_id }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-orange-600 font-bold">#{{ $tx->order_id }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-0.5">
                                        <p class="font-semibold">{{ $tx->order && $tx->order->user ? $tx->order->user->name : 'N/A' }}</p>
                                        <p class="text-xs text-gray-400">{{ $tx->order && $tx->order->user ? $tx->order->user->email : 'N/A' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900">{{ number_format($tx->amount, 0, ',', ' ') }} {{ $tx->currency }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if(strtolower($tx->payment_method) === 'mtn')
                                        <span class="px-2 py-0.5 text-xs font-bold bg-yellow-100 text-yellow-800 rounded">MTN Mobile Money</span>
                                    @elseif(strtolower($tx->payment_method) === 'moov')
                                        <span class="px-2 py-0.5 text-xs font-bold bg-blue-100 text-blue-800 rounded">Moov Money</span>
                                    @elseif(strtolower($tx->payment_method) === 'orange')
                                        <span class="px-2 py-0.5 text-xs font-bold bg-orange-100 text-orange-800 rounded">Orange Money</span>
                                    @elseif(strtolower($tx->payment_method) === 'card')
                                        <span class="px-2 py-0.5 text-xs font-bold bg-purple-100 text-purple-800 rounded">Carte Bancaire</span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs font-bold bg-gray-100 text-gray-800 rounded">{{ strtoupper($tx->payment_method ?? 'Inconnu') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($tx->status === 'approved')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">Approuve</span>
                                    @elseif($tx->status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-100">En attente</span>
                                    @elseif($tx->status === 'canceled')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full bg-gray-50 text-gray-700 border border-gray-100">Annule</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full bg-red-50 text-red-700 border border-red-100">Refuse</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-400">
                                    {{ $tx->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="openDetails === {{ $tx->id }} ? openDetails = null : openDetails = {{ $tx->id }}" class="text-orange-600 hover:text-orange-700 font-bold text-xs bg-orange-50 px-3 py-1.5 rounded-lg transition-colors">
                                        Payload JSON
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Details collapsible row -->
                            <tr x-show="openDetails === {{ $tx->id }}" style="display: none;" class="bg-gray-50/50">
                                <td colspan="8" class="px-6 py-4">
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center text-xs font-semibold text-gray-500 uppercase">
                                            <span>Reference FedaPay: {{ $tx->reference ?? 'N/A' }}</span>
                                            <span>Details du payload brut de l'API</span>
                                        </div>
                                        <pre class="bg-white border border-gray-100 text-xs font-mono p-4 rounded-xl text-gray-700 max-h-60 overflow-y-auto leading-relaxed shadow-inner">{{ json_encode(json_decode($tx->raw_response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-gray-400 font-medium">
                                    Aucune transaction correspondante trouvee.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transactions->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
