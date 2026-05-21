<x-admin-layout>
    <div class="space-y-8 max-w-4xl">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Configuration de FedaPay</h1>
            <p class="mt-1.5 text-sm text-gray-500 font-medium">Gerez vos identifiants FedaPay pour accepter les paiements par Mobile Money et Carte Bancaire.</p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 md:p-8 space-y-6">
            <form action="{{ route('admin.payment-settings.update') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Enable/Disable Status -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="is_enabled" name="is_enabled" type="checkbox" value="1" {{ $settings->is_enabled ? 'checked' : '' }} class="h-5 w-5 text-orange-600 focus:ring-orange-500 border-gray-300 rounded transition-colors duration-150">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="is_enabled" class="font-bold text-gray-900">Activer le paiement via FedaPay</label>
                        <p class="text-gray-500">Cochez cette case pour activer la redirection automatique vers le portail FedaPay lors de la finalisation des commandes.</p>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Environment -->
                    <div>
                        <label for="environment" class="block text-sm font-semibold text-gray-700">Environnement</label>
                        <select id="environment" name="environment" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                            <option value="sandbox" {{ $settings->environment === 'sandbox' ? 'selected' : '' }}>Mode Test (Sandbox)</option>
                            <option value="live" {{ $settings->environment === 'live' ? 'selected' : '' }}>Mode Production (Live)</option>
                        </select>
                    </div>

                    <!-- Currency -->
                    <div>
                        <label for="currency" class="block text-sm font-semibold text-gray-700">Devise de transaction</label>
                        <select id="currency" name="currency" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                            <option value="XOF" {{ $settings->currency === 'XOF' ? 'selected' : '' }}>Franc CFA - BCEAO (XOF)</option>
                            <option value="XAF" {{ $settings->currency === 'XAF' ? 'selected' : '' }}>Franc CFA - BEAC (XAF)</option>
                            <option value="EUR" {{ $settings->currency === 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                            <option value="USD" {{ $settings->currency === 'USD' ? 'selected' : '' }}>Dollar Americain (USD)</option>
                        </select>
                    </div>
                </div>

                <!-- API Keys -->
                <div class="space-y-4">
                    <div>
                        <label for="public_key" class="block text-sm font-semibold text-gray-700">Cle Publique FedaPay (Public Key)</label>
                        <input type="text" id="public_key" name="public_key" value="{{ old('public_key', $settings->public_key) }}" placeholder="pk_sandbox_... ou pk_live_..." class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm font-mono">
                    </div>

                    <div>
                        <label for="secret_key" class="block text-sm font-semibold text-gray-700">Cle Secrete FedaPay (Secret Key)</label>
                        <input type="password" id="secret_key" name="secret_key" value="{{ old('secret_key', $settings->secret_key) }}" placeholder="sk_sandbox_... ou sk_live_..." class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm font-mono font-bold">
                    </div>

                    <div>
                        <label for="webhook_secret" class="block text-sm font-semibold text-gray-700">Secret de Signature du Webhook</label>
                        <input type="password" id="webhook_secret" name="webhook_secret" value="{{ old('webhook_secret', $settings->webhook_secret) }}" placeholder="whsec_..." class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm font-mono">
                        <p class="mt-1 text-xs text-gray-400">Requis pour valider de maniere securisee les notifications de transaction asynchrones (Webhooks).</p>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex justify-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-bold rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-150">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Alert Webhook -->
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6 flex gap-4">
            <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="space-y-2 text-sm text-amber-800">
                <h4 class="font-bold text-amber-900">Configuration du Webhook FedaPay</h4>
                <p>Pour assurer la mise a jour automatique des statuts de paiement en temps reel, veuillez copier l'URL ci-dessous et l'ajouter dans la section <strong>Webhooks</strong> de votre tableau de bord FedaPay (Test et Live) :</p>
                <div class="flex items-center gap-2 mt-2 bg-white/70 border border-amber-200/50 p-2 rounded-lg font-mono text-xs text-gray-700 select-all max-w-lg overflow-x-auto">
                    {{ url('/fedapay/webhook') }}
                </div>
                <p class="text-xs text-amber-700/80">Configurez l'evenement <code>transaction.approved</code>, <code>transaction.canceled</code>, et <code>transaction.declined</code> pour declencher ce webhook.</p>
            </div>
        </div>
    </div>
</x-admin-layout>
