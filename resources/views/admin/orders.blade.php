<x-admin-layout>
    <div class="space-y-8" x-data="{ 
        detailModalOpen: false, 
        activeOrder: {
            id: '',
            user: { first_name: '', last_name: '', email: '' },
            total_amount: 0,
            status: '',
            shipping_address: '',
            shipping_city: '',
            shipping_country: '',
            shipping_phone: '',
            created_at_formatted: '',
            items: []
        },
        openDetail(order, dateStr) {
            this.activeOrder = { ...order, created_at_formatted: dateStr };
            this.detailModalOpen = true;
        }
    }">
        <!-- Header & Action -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight font-outfit">Gestion des Commandes</h1>
                <p class="mt-1.5 text-sm text-gray-500 font-medium font-outfit">Suivez les livraisons et mettez à jour les statuts de commande.</p>
            </div>
            
            <!-- Filters -->
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.orders') }}" class="px-3.5 py-2 text-xs font-bold rounded-full transition-all border {{ !$filterStatus ? 'bg-orange-500 border-orange-500 text-white shadow-md shadow-orange-500/10' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">Toutes</a>
                <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="px-3.5 py-2 text-xs font-bold rounded-full transition-all border {{ $filterStatus === 'pending' ? 'bg-orange-500 border-orange-500 text-white shadow-md shadow-orange-500/10' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">En attente</a>
                <a href="{{ route('admin.orders', ['status' => 'confirmed']) }}" class="px-3.5 py-2 text-xs font-bold rounded-full transition-all border {{ $filterStatus === 'confirmed' ? 'bg-orange-500 border-orange-500 text-white shadow-md shadow-orange-500/10' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">Confirmées</a>
                <a href="{{ route('admin.orders', ['status' => 'shipped']) }}" class="px-3.5 py-2 text-xs font-bold rounded-full transition-all border {{ $filterStatus === 'shipped' ? 'bg-orange-500 border-orange-500 text-white shadow-md shadow-orange-500/10' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">Expédiées</a>
                <a href="{{ route('admin.orders', ['status' => 'delivered']) }}" class="px-3.5 py-2 text-xs font-bold rounded-full transition-all border {{ $filterStatus === 'delivered' ? 'bg-orange-500 border-orange-500 text-white shadow-md shadow-orange-500/10' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">Livrées</a>
                <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" class="px-3.5 py-2 text-xs font-bold rounded-full transition-all border {{ $filterStatus === 'cancelled' ? 'bg-orange-500 border-orange-500 text-white shadow-md shadow-orange-500/10' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">Annulées</a>
            </div>
        </div>

        <!-- Orders Table Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm text-left">
                    <thead class="bg-gray-50/50">
                        <tr class="text-gray-400 font-semibold text-xs uppercase">
                            <th class="px-6 py-4">ID Commande</th>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Statut</th>
                            <th class="px-6 py-4">Date & Heure</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50/30 transition-colors duration-150">
                                <td class="px-6 py-4 text-gray-500 font-mono">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-gray-900 font-bold">
                                    {{ $order->user ? ($order->user->first_name . ' ' . $order->user->last_name) : 'Client Supprimé' }}
                                    <span class="block text-[10px] text-gray-400 font-normal mt-0.5">{{ $order->user ? $order->user->email : '' }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-900 font-bold">{{ number_format($order->total_amount, 0, ',', ' ') }} F</td>
                                <td class="px-6 py-4">
                                    @if($order->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-100">En attente</span>
                                    @elseif($order->status === 'confirmed')
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-blue-50 text-blue-700 border border-blue-100">Confirmé</span>
                                    @elseif($order->status === 'shipped')
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">Expédié</span>
                                    @elseif($order->status === 'delivered')
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">Livré</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-red-50 text-red-700 border border-red-100">Annulé</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <button type="button" @click="openDetail({{ json_encode($order) }}, '{{ $order->created_at->format('d/m/Y à H:i') }}')" class="px-3.5 py-1.5 bg-orange-50 hover:bg-orange-100 text-orange-600 rounded-xl text-xs font-bold transition-all">Inspecter</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">Aucune commande ne correspond à ce filtre.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 font-medium">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

        <!-- Order Detail Modal (Alpine.js) -->
        <div x-show="detailModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="detailModalOpen = false"></div>
                
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="detailModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-middle bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-100">
                    
                    <div class="px-6 pt-6 pb-4 sm:p-8 space-y-6">
                        <!-- Header -->
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 font-outfit">Commande #<span x-text="activeOrder.id"></span></h3>
                                <p class="text-xs text-gray-400 mt-1" x-text="'Enregistrée le ' + activeOrder.created_at_formatted"></p>
                            </div>
                            <button @click="detailModalOpen = false" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <!-- Status Update Form -->
                        <div class="p-4 bg-orange-50/50 rounded-2xl border border-orange-100 space-y-3">
                            <h4 class="text-xs font-bold text-orange-800 uppercase tracking-wider">Mettre à jour le statut</h4>
                            <form :action="'/admin/orders/' + activeOrder.id + '/status'" method="POST" class="flex gap-2">
                                @csrf
                                <select name="status" x-model="activeOrder.status" class="bg-white border-gray-200 text-xs rounded-xl px-3 py-2.5 focus:border-orange-500 focus:ring-orange-500 font-semibold flex-1">
                                    <option value="pending">En attente de traitement</option>
                                    <option value="confirmed">Confirmée</option>
                                    <option value="shipped">Expédiée / En cours de livraison</option>
                                    <option value="delivered">Livrée avec succès</option>
                                    <option value="cancelled">Annulée</option>
                                </select>
                                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-md shadow-orange-500/10">Valider</button>
                            </form>
                        </div>

                        <!-- Customer Details Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs border-t border-b border-gray-100 py-6">
                            <div class="space-y-2">
                                <h4 class="font-bold text-gray-400 uppercase tracking-wider">Informations Client</h4>
                                <div class="font-medium text-gray-900 space-y-1">
                                    <p class="font-bold text-sm" x-text="(activeOrder.user ? (activeOrder.user.first_name + ' ' + activeOrder.user.last_name) : 'Client Supprimé')"></p>
                                    <p x-text="activeOrder.user ? activeOrder.user.email : ''"></p>
                                    <p x-text="'Tél: ' + activeOrder.shipping_phone"></p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h4 class="font-bold text-gray-400 uppercase tracking-wider">Adresse de Livraison</h4>
                                <div class="font-medium text-gray-900 space-y-1">
                                    <p class="font-semibold text-gray-900" x-text="activeOrder.shipping_address"></p>
                                    <p x-text="activeOrder.shipping_city + ', ' + activeOrder.shipping_country"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Order items list -->
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Articles commandés</h4>
                            <div class="space-y-3 max-h-48 overflow-y-auto pr-1">
                                <template x-for="item in activeOrder.items" :key="item.id">
                                    <div class="flex items-center justify-between border-b border-gray-50 pb-2 last:border-0 last:pb-0">
                                        <div class="flex items-center gap-3">
                                            <img :src="'/images/products/' + item.product_image + '?v=2'" class="w-10 h-10 object-cover rounded-lg border border-gray-100 flex-shrink-0">
                                            <div>
                                                <h5 class="text-sm font-bold text-gray-900" x-text="item.product_name"></h5>
                                                <p class="text-xs text-gray-400" x-text="'Quantité : ' + item.quantity"></p>
                                            </div>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900" x-text="(item.price * item.quantity).toLocaleString() + ' F'"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="flex justify-between items-center bg-gray-50 px-5 py-4 rounded-xl font-outfit border border-gray-100/50">
                            <span class="text-sm font-bold text-gray-500">Montant Total Payé</span>
                            <span class="text-xl font-black text-gray-900" x-text="activeOrder.total_amount.toLocaleString() + ' F'"></span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 px-6 py-4 sm:px-8 sm:py-5 flex justify-end border-t border-gray-100">
                        <button type="button" @click="detailModalOpen = false" class="px-5 py-2 text-xs font-bold text-gray-500 hover:text-gray-700">Fermer</button>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
