<x-store-layout>
    <x-slot name="title">Politique de retour - Sessitrading</x-slot>

    <!-- BREADCRUMBS & HEADER -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 pt-6 md:pt-10">
        <nav class="text-xs md:text-sm font-semibold text-gray-500 flex items-center gap-2 mb-4">
            <a href="{{ route('store.index') }}" class="hover:text-orange-500 transition-colors">Accueil</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-orange-500 font-bold">Politique de retour</span>
        </nav>

        <div class="border-b border-gray-150 dark:border-gray-800 pb-6">
            <h1 class="text-2xl md:text-4xl font-black text-gray-955 dark:text-white tracking-tight">Politique de Retour & Remboursement</h1>
            <p class="text-xs md:text-sm text-gray-400 font-semibold mt-1">
                Les conditions de retour, d'échange et de remboursement de vos articles achetés sur Sessitrading.
            </p>
        </div>
    </section>

    <!-- CONTENT GRID -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- SIDEBAR NAVIGATION -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-gray-55 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl p-5 flex flex-col gap-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 px-3 mb-2">Informations & Aide</h3>
                    
                    <a href="{{ route('store.mentions') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-extrabold transition-all {{ Route::is('store.mentions') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/10' : 'text-gray-650 hover:bg-gray-100 hover:text-orange-500 dark:text-gray-350 dark:hover:bg-gray-800' }}">
                        <span>Mentions Légales</span>
                    </a>
                    
                    <a href="{{ route('store.cgv') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-extrabold transition-all {{ Route::is('store.cgv') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/10' : 'text-gray-650 hover:bg-gray-100 hover:text-orange-500 dark:text-gray-350 dark:hover:bg-gray-800' }}">
                        <span>Conditions Générales (CGV)</span>
                    </a>
                    
                    <a href="{{ route('store.retour') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-extrabold transition-all {{ Route::is('store.retour') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/10' : 'text-gray-650 hover:bg-gray-100 hover:text-orange-500 dark:text-gray-350 dark:hover:bg-gray-800' }}">
                        <span>Politique de retour</span>
                    </a>
                    
                    <a href="{{ route('store.donnees') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-extrabold transition-all {{ Route::is('store.donnees') ? 'bg-orange-500 text-white shadow-md shadow-orange-500/10' : 'text-gray-650 hover:bg-gray-100 hover:text-orange-500 dark:text-gray-350 dark:hover:bg-gray-800' }}">
                        <span>Données privées</span>
                    </a>
                </div>
            </div>

            <!-- MAIN TEXT CONTENT -->
            <div class="lg:col-span-3 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl p-6 md:p-10 text-sm text-gray-600 dark:text-gray-305 leading-relaxed flex flex-col gap-6">
                
                <div>
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">1. Délai de rétractation et de retour</h2>
                    <p class="mb-3">
                        Chez <strong>Sessitrading</strong>, nous tenons à ce que vous soyez entièrement satisfait de vos achats. Conformément aux usages du commerce en ligne et pour vous offrir une expérience d'achat en toute confiance, vous disposez d'un délai de <strong>14 jours calendaires</strong> à compter de la date de réception de votre commande pour demander un retour, un échange ou un remboursement.
                    </p>
                    <p>
                        Passé ce délai de 14 jours, nous ne pourrons malheureusement plus vous proposer de remboursement ni d'échange.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">2. Conditions d'éligibilité au retour</h2>
                    <p class="mb-3">
                        Pour que votre article soit éligible à un retour, il doit être dans le même état que celui dans lequel vous l'avez reçu. Les conditions suivantes doivent être respectées :
                    </p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5 mb-3">
                        <li>L'article doit être <strong>neuf, non porté, non lavé</strong> et exempt de toute odeur (parfum, transpiration, etc.).</li>
                        <li>L'article doit être retourné dans son <strong>emballage d'origine</strong> complet.</li>
                        <li>Toutes les <strong>étiquettes d'origine</strong> doivent être intactes et attachées à l'article.</li>
                        <li>La facture d'achat ou une preuve d'achat doit être jointe au colis de retour.</li>
                    </ul>
                    <p class="text-red-500 font-semibold bg-red-50 dark:bg-red-950/20 p-3 rounded-xl border border-red-100 dark:border-red-900/30">
                        Attention : Les sous-vêtements, les articles en promotion ou soldés, et les commandes personnalisées ne sont ni repris ni échangés pour des raisons d'hygiène et de spécificité.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">3. Procédure de retour</h2>
                    <p class="mb-3">
                        Pour initier un retour, veuillez suivre les étapes suivantes :
                    </p>
                    <ol class="list-decimal pl-5 flex flex-col gap-2">
                        <li>
                            <strong>Contactez notre service client</strong> : Envoyez un email à <a href="mailto:contact@sessitrading.com" class="text-orange-500 hover:underline">contact@sessitrading.com</a> ou écrivez-nous par WhatsApp au <a href="https://wa.me/2290195076635" target="_blank" class="text-orange-500 hover:underline">+229 0195076635</a> en indiquant votre numéro de commande, le nom de l'article à retourner et le motif du retour.
                        </li>
                        <li>
                            <strong>Validation du retour</strong> : Notre équipe étudiera votre demande et vous transmettra un bon de retour ou des instructions spécifiques sous 24 à 48 heures.
                        </li>
                        <li>
                            <strong>Expédition / Dépôt du produit</strong> : 
                            <ul class="list-disc pl-5 mt-1 flex flex-col gap-1">
                               <li><strong>À Cotonou</strong> : Vous pouvez déposer directement l'article à notre Boutique Sessitrading à Cotonou, ou faire appel à notre service de coursier partenaire (les frais de coursier pour le retour sont à votre charge).</li>
                               <li><strong>Hors Cotonou / International</strong> : Les frais d'expédition de retour sont entièrement à la charge du client. Nous vous recommandons d'utiliser un service d'expédition avec suivi pour garantir la bonne réception du colis.</li>
                            </ul>
                        </li>
                    </ol>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">4. Remboursements et Avoirs</h2>
                    <p class="mb-3">
                        Une fois votre colis de retour reçu et inspecté par notre équipe, nous vous enverrons un e-mail ou un message WhatsApp pour vous notifier de la bonne réception du colis et de l'approbation ou du rejet de votre demande de remboursement (selon l'état de conformité de l'article).
                    </p>
                    <p class="mb-3">
                        Si votre retour est approuvé, vous aurez le choix entre :
                    </p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5 mb-3">
                        <li>Un <strong>remboursement monétaire</strong> effectué sur le même moyen de paiement utilisé lors de votre achat (via FedaPay : Mobile Money MTN MoMo, Moov Flooz, ou carte bancaire).</li>
                        <li>Un <strong>avoir (code promo)</strong> de la valeur d'achat du produit, valable pendant 6 mois sur l'ensemble de notre boutique en ligne.</li>
                        <li>Un <strong>échange standard</strong> contre un autre article de même valeur ou de valeur différente (avec ajustement du prix).</li>
                    </ul>
                    <p>
                        Les remboursements monétaires sont traités sous un délai maximal de <strong>7 jours ouvrés</strong> à compter de la validation du retour.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">5. Service Client</h2>
                    <p>
                        Pour toute question relative à notre politique de retour, écrivez-nous à <a href="mailto:contact@sessitrading.com" class="text-orange-500 hover:underline">contact@sessitrading.com</a> ou contactez-nous directement par téléphone ou WhatsApp au <a href="tel:+2290195076635" class="text-orange-500 hover:underline">+229 0195076635</a>.
                    </p>
                </div>

            </div>

        </div>
    </section>
</x-store-layout>
