<x-store-layout>
    <x-slot name="title">Conditions Générales de Vente (CGV) - Sessitrading</x-slot>

    <!-- BREADCRUMBS & HEADER -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 pt-6 md:pt-10">
        <nav class="text-xs md:text-sm font-semibold text-gray-500 flex items-center gap-2 mb-4">
            <a href="{{ route('store.index') }}" class="hover:text-orange-500 transition-colors">Accueil</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-orange-500 font-bold">Conditions Générales de Vente</span>
        </nav>

        <div class="border-b border-gray-150 dark:border-gray-800 pb-6">
            <h1 class="text-2xl md:text-4xl font-black text-gray-955 dark:text-white tracking-tight">Conditions Générales de Vente</h1>
            <p class="text-xs md:text-sm text-gray-400 font-semibold mt-1">
                Les règles contractuelles régissant les ventes d'articles sur la boutique en ligne Sessitrading.
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
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">1. Objet et champ d'application</h2>
                    <p class="mb-3">
                        Les présentes Conditions Générales de Vente (CGV) régissent de manière exclusive les relations contractuelles entre la boutique de prêt-à-porter <strong>Sessitrading</strong> et toute personne physique ou morale (ci-après désignée "le Client") effectuant un achat sur le site internet <a href="{{ route('store.index') }}" class="text-orange-500 hover:underline">sessitrading.com</a>.
                    </p>
                    <p>
                        Toute commande passée sur le site implique l'adhésion entière et sans réserve du Client aux présentes CGV. Sessitrading se réserve le droit de modifier ses CGV à tout moment. Les CGV applicables sont celles en vigueur à la date de validation de la commande par le Client.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">2. Produits et descriptifs</h2>
                    <p class="mb-3">
                        Les produits proposés à la vente par Sessitrading sont ceux qui figurent sur le site au jour de sa consultation par le Client, dans la limite des stocks disponibles. Nos articles de mode sont des sélections de <strong>qualité premium, exclusivement neufs et importés</strong> (vêtements traditionnels, boubous, robes, ensembles, vestes, etc.).
                    </p>
                    <p>
                        Chaque produit est accompagné d'un descriptif détaillé (matière, taille, prix) et de photographies. Les images du site sont le plus fidèle possible aux produits d'origine mais ne peuvent assurer une similitude parfaite (notamment au niveau des teintes en fonction des écrans d'affichage).
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">3. Prix des articles</h2>
                    <p class="mb-3">
                        Les prix de nos articles sont indiqués sur le site en <strong>Francs CFA (FCFA / F)</strong> toutes taxes comprises (TTC), hors frais de livraison.
                    </p>
                    <p>
                        Sessitrading se réserve le droit de modifier ses prix à tout moment. Les produits seront facturés sur la base des tarifs indiqués au Client lors de la validation de la commande. Les frais de livraison sont calculés et affichés distinctement avant l'étape de paiement final.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">4. Commande et Modalités de paiement</h2>
                    <p class="mb-3">
                        Pour commander, le Client ajoute ses produits dans le panier, renseigne ses informations de livraison, et procède au paiement.
                    </p>
                    <p class="mb-3">
                        Le paiement en ligne s'effectue de manière sécurisée via la passerelle de paiement intégrée <strong>FedaPay</strong>. Les modes de paiement acceptés sont :
                    </p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5 mb-3 font-semibold text-gray-800 dark:text-gray-200">
                        <li>Mobile Money MTN (Bénin et sous-région)</li>
                        <li>Moov Flooz (Bénin et sous-région)</li>
                        <li>Cartes bancaires (Visa, MasterCard)</li>
                    </ul>
                    <p>
                        La commande est définitivement enregistrée et préparée dès validation de la transaction par FedaPay. En cas de rejet du paiement, la commande est automatiquement annulée.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">5. Livraison et transport</h2>
                    <p class="mb-3">
                        Les articles sont livrés à l'adresse de livraison indiquée par le Client lors de sa commande. Les délais de livraison varient en fonction de la destination :
                    </p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5 mb-3">
                        <li><strong>Cotonou et Calavi (Bénin)</strong> : Livraison sous 24h à 48h ouvrées.</li>
                        <li><strong>Autres départements du Bénin</strong> : Livraison sous 2 à 4 jours ouvrés.</li>
                        <li><strong>International & Sous-région</strong> : Expédition sous 3 à 7 jours ouvrés via nos partenaires logistiques.</li>
                    </ul>
                    <p>
                        Les risques du transport sont transférés au Client à compter de la remise du colis au transporteur ou au coursier. Sessitrading s'engage à expédier des colis en excellent état de conditionnement.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">6. Rétractation et Retour de marchandise</h2>
                    <p>
                        Le Client dispose d'un délai légal de <strong>14 jours</strong> pour exercer son droit de rétractation et retourner l'article à ses frais (ou en boutique physique à Cotonou). Les conditions précises et la méthode de retour sont détaillées dans notre <a href="{{ route('store.retour') }}" class="text-orange-500 hover:underline font-semibold">Politique de retour</a>.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">7. Droit applicable et Règlement des litiges</h2>
                    <p class="mb-3">
                        Les présentes Conditions Générales de Vente sont régies par le droit en vigueur en République du Bénin.
                    </p>
                    <p>
                        En cas de litige, le Client et Sessitrading s'engagent à rechercher une solution amiable avant toute action judiciaire. À défaut d'accord amiable, le litige sera soumis à la compétence exclusive des tribunaux compétents de Cotonou.
                    </p>
                </div>

            </div>

        </div>
    </section>
</x-store-layout>
