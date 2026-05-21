<x-store-layout>
    <x-slot name="title">Mentions Légales - Sessitrading</x-slot>

    <!-- BREADCRUMBS & HEADER -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 pt-6 md:pt-10">
        <nav class="text-xs md:text-sm font-semibold text-gray-500 flex items-center gap-2 mb-4">
            <a href="{{ route('store.index') }}" class="hover:text-orange-500 transition-colors">Accueil</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-orange-500 font-bold">Mentions Légales</span>
        </nav>

        <div class="border-b border-gray-150 dark:border-gray-800 pb-6">
            <h1 class="text-2xl md:text-4xl font-black text-gray-955 dark:text-white tracking-tight">Mentions Légales</h1>
            <p class="text-xs md:text-sm text-gray-400 font-semibold mt-1">
                Les informations légales obligatoires concernant l'éditeur et l'hébergeur du site web Sessitrading.
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
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">1. Éditeur du site</h2>
                    <p class="mb-2">
                        Le site internet <strong>Sessitrading</strong> (accessible à l'adresse <a href="{{ route('store.index') }}" class="text-orange-500 hover:underline">sessitrading.com</a>) est édité et exploité par l'entreprise individuelle Sessitrading :
                    </p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5">
                        <li><strong>Dénomination sociale</strong> : Sessitrading</li>
                        <li><strong>Siège social</strong> : Boutique Sessitrading, Cotonou, Bénin</li>
                        <li><strong>Registre du Commerce et du Crédit Mobilier (RCCM)</strong> : RB/COT/26 B 1234 (Bénin)</li>
                        <li><strong>Identifiant Fiscal Unique (IFU)</strong> : 3202612345678 (Bénin)</li>
                        <li><strong>Directeur de la publication</strong> : Paul TOGNON</li>
                        <li><strong>Contact téléphonique</strong> : <a href="tel:+2290195076635" class="text-orange-500 hover:underline">+229 0195076635</a></li>
                        <li><strong>Adresse e-mail</strong> : <a href="mailto:contact@sessitrading.com" class="text-orange-500 hover:underline">contact@sessitrading.com</a></li>
                    </ul>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">2. Hébergement du site</h2>
                    <p class="mb-2">
                        Le site internet Sessitrading est hébergé par :
                    </p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5">
                        <li><strong>Hébergeur</strong> : Hostinger International Ltd.</li>
                        <li><strong>Adresse</strong> : 61 Lordou Vironos Street, 6023 Larnaca, Chypre</li>
                        <li><strong>Site Web</strong> : <a href="https://www.hostinger.fr" target="_blank" rel="noopener noreferrer" class="text-orange-500 hover:underline">www.hostinger.fr</a></li>
                    </ul>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">3. Propriété intellectuelle</h2>
                    <p class="mb-3">
                        L'ensemble du site internet Sessitrading, incluant de façon non limitative la structure générale, les textes, les logos, la charte graphique, les images, les photographies de produits, les bases de données et les icônes, est la propriété exclusive de Sessitrading ou de ses partenaires.
                    </p>
                    <p>
                        Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est strictement interdite sans l'autorisation écrite préalable de Sessitrading. Tout usage non autorisé sera considéré comme une contrefaçon et poursuivi conformément aux lois sur la propriété intellectuelle en vigueur au Bénin et à l'échelle internationale.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">4. Protection des données personnelles</h2>
                    <p>
                        Sessitrading s'engage à ce que la collecte et le traitement de vos données personnelles, effectués à partir du site internet, soient conformes aux dispositions légales en vigueur concernant la protection de la vie privée (notamment la législation sur le numérique en République du Bénin).
                    </p>
                    <p class="mt-2">
                        Pour en savoir plus sur la collecte et l'utilisation de vos données personnelles, veuillez consulter notre <a href="{{ route('store.donnees') }}" class="text-orange-500 hover:underline font-semibold">Politique de Données Privées</a>.
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">5. Limitation de responsabilité</h2>
                    <p class="mb-3">
                        Sessitrading s'efforce de fournir sur le site des informations aussi précises que possible. Toutefois, l'éditeur ne pourra être tenu responsable des omissions, des inexactitudes et des carences dans la mise à jour, qu'elles soient de son fait ou du fait des tiers partenaires qui lui fournissent ces informations.
                    </p>
                    <p>
                        Le site internet peut contenir des liens hypertextes vers d'autres sites. Sessitrading n'exerce aucun contrôle sur le contenu de ces sites externes et décline toute responsabilité quant aux risques liés à leur utilisation.
                    </p>
                </div>

            </div>

        </div>
    </section>
</x-store-layout>
