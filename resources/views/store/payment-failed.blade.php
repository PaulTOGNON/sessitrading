<x-store-layout>
    <x-slot name="title">Echec du Paiement - Sessitrading</x-slot>

    <section class="max-w-3xl mx-auto px-4 py-16 md:py-24 text-center">
        <div class="bg-white border border-gray-150 rounded-3xl p-8 md:p-12 shadow-sm space-y-6 flex flex-col items-center">
            
            <!-- Failed Icon Animation -->
            <div class="w-20 h-20 rounded-full bg-red-50 text-red-500 flex items-center justify-center border border-red-100 shadow-sm">
                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>

            <!-- Header Content -->
            <div class="space-y-2">
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Le paiement a echoue</h1>
                <p class="text-sm font-semibold text-gray-500">Nous n'avons pas pu valider votre transaction. L'operation a ete annulee ou refusee.</p>
            </div>

            <!-- Transaction info card -->
            <div class="w-full bg-gray-50 rounded-2xl p-6 text-left border border-gray-100 space-y-4">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Numero de Commande</span>
                    <span class="font-bold text-gray-900">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">ID de Transaction</span>
                    <span class="font-mono text-xs text-gray-700 font-semibold">{{ $localTx->transaction_id }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Statut FedaPay</span>
                    <span class="font-bold text-red-600 uppercase text-xs">{{ $localTx->status }}</span>
                </div>
                <hr class="border-gray-200">
                <p class="text-xs text-gray-400 font-medium leading-relaxed font-semibold">Si de l'argent a ete debite de votre compte Mobile Money, le remboursement ou la regularisation sera geree par FedaPay. Vous pouvez egalement reessayer le paiement ou choisir une autre methode.</p>
            </div>

            <!-- Action buttons -->
            <div class="w-full flex flex-col sm:flex-row gap-4 pt-4">
                <a href="{{ route('checkout.pay', ['order' => $order->id]) }}" class="flex-grow bg-orange-600 hover:bg-orange-700 text-white font-bold py-3.5 px-6 rounded-2xl transition-all shadow-sm text-sm animate-pulse">
                    Reessayer le paiement
                </a>
                <a href="{{ route('dashboard', ['tab' => 'orders']) }}" class="flex-grow bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3.5 px-6 rounded-2xl transition-all text-sm">
                    Mes commandes
                </a>
            </div>
        </div>
    </section>
</x-store-layout>
