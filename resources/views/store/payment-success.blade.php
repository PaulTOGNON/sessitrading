<x-store-layout>
    <x-slot name="title">Paiement Reussi - Sessitrading</x-slot>

    <section class="max-w-3xl mx-auto px-4 py-16 md:py-24 text-center">
        <div class="bg-white border border-gray-150 rounded-3xl p-8 md:p-12 shadow-sm space-y-6 flex flex-col items-center">
            
            <!-- Success Icon Animation -->
            <div class="w-20 h-20 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center border border-emerald-100 shadow-sm">
                <svg class="w-10 h-10 animate-bounce text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <!-- Header Content -->
            <div class="space-y-2">
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Merci pour votre paiement !</h1>
                <p class="text-sm font-semibold text-gray-500">Votre paiement a ete valide avec succes via Mobile Money.</p>
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
                    <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Reference</span>
                    <span class="font-mono text-xs text-gray-700 font-semibold">{{ $localTx->reference ?? 'N/A' }}</span>
                </div>
                <hr class="border-gray-200">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Moyen de paiement</span>
                    <span class="font-bold text-gray-900 capitalize">{{ $localTx->payment_method ?? 'Mobile Money' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Montant total</span>
                    <span class="text-lg font-black text-orange-600">{{ number_format($localTx->amount, 0, ',', ' ') }} {{ $localTx->currency }}</span>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="w-full flex flex-col sm:flex-row gap-4 pt-4">
                <a href="{{ route('dashboard', ['tab' => 'orders']) }}" class="flex-grow bg-orange-600 hover:bg-orange-700 text-white font-bold py-3.5 px-6 rounded-2xl transition-all shadow-sm text-sm">
                    Voir mes commandes
                </a>
                <a href="{{ route('store.shop') }}" class="flex-grow bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3.5 px-6 rounded-2xl transition-all text-sm">
                    Continuer mes achats
                </a>
            </div>
        </div>
    </section>
</x-store-layout>
