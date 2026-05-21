<x-store-layout>
    <x-slot name="title">Données privées & Confidentialité - Sessitrading</x-slot>

    <!-- BREADCRUMBS & HEADER -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 pt-6 md:pt-10">
        <nav class="text-xs md:text-sm font-semibold text-gray-500 flex items-center gap-2 mb-4">
            <a href="{{ route('store.index') }}" class="hover:text-orange-500 transition-colors">Accueil</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-orange-500 font-bold">Données privées</span>
        </nav>

        <div class="border-b border-gray-150 dark:border-gray-800 pb-6">
            <h1 class="text-2xl md:text-4xl font-black text-gray-955 dark:text-white tracking-tight">Politique de Confidentialité & Données Privées</h1>
            <p class="text-xs md:text-sm text-gray-400 font-semibold mt-1">
                La charte de protection et de respect de vos données personnelles collectées sur Sessitrading.
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
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">1. Collecte des données personnelles</h2>
                    <p class="mb-3">
                        Dans le cadre de l'utilisation de notre boutique en ligne <strong>Sessitrading</strong>, nous sommes amenés à collecter et traiter un certain nombre de vos données personnelles. Cette collecte intervient lorsque vous créez un compte, passez une commande, vous inscrivez à notre newsletter ou contactez notre support client.
                    </p>
                    <p class="mb-2 font-semibold">Les données collectées peuvent comprendre :</p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5">
                        <li><strong>Identité</strong> : Nom, prénom, adresse e-mail.</li>
                        <li><strong>Coordonnées</strong> : Adresse de livraison, adresse de facturation, numéro de téléphone (incluant le numéro pour les notifications de livraison et les transactions WhatsApp).</li>
                        <li><strong>Données de transaction</strong> : Les détails de vos achats (les données bancaires ou de comptes Mobile Money sont traitées de manière chiffrée et ultra-sécurisée directement par notre passerelle FedaPay et ne transitent jamais sur nos serveurs).</li>
                        <li><strong>Données techniques</strong> : Adresse IP, données de navigation à des fins de statistiques de trafic et de fonctionnement de votre panier.</li>
                    </ul>
                </div>

                <div class="border-t border-gray-150 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">2. Utilisation de vos données</h2>
                    <p class="mb-2 font-semibold">Les données collectées sont utilisées pour les finalités suivantes :</p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5">
                        <li>Le traitement, la facturation et la préparation de vos commandes.</li>
                        <li>Le suivi de livraison (envoi de notifications par e-mail, SMS ou WhatsApp).</li>
                        <li>La gestion de la relation client (aide en ligne, traitement des réclamations et des retours).</li>
                        <li>L'amélioration de l'ergonomie générale du site internet.</li>
                        <li>L'envoi d'informations commerciales et promotionnelles (si vous y avez explicitement consenti lors de votre inscription).</li>
                    </ul>
                </div>

                <div class="border-t border-gray-150 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">3. Partage des données avec des tiers</h2>
                    <p class="mb-3">
                        Sessitrading s'engage à <strong>ne jamais vendre, louer ou divulguer</strong> vos données personnelles à des fins commerciales à des entreprises tierces.
                    </p>
                    <p class="mb-2">Vos données personnelles sont uniquement communiquées à nos sous-traitants directs pour la bonne exécution de votre commande :</p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5">
                        <li>Les <strong>sociétés de livraison et coursiers</strong> partenaires pour acheminer vos produits.</li>
                        <li>La <strong>passerelle FedaPay</strong> pour la sécurisation et la validation de vos paiements par carte bancaire ou Mobile Money.</li>
                    </ul>
                </div>

                <div class="border-t border-gray-150 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">4. Durée de conservation des données</h2>
                    <p>
                        Vos données de compte client et d'historique de commande sont conservées aussi longtemps que vous êtes un client actif et au maximum pendant une durée légale de 5 ans à compter de la fermeture de votre compte, conformément aux exigences fiscales et comptables locales.
                    </p>
                </div>

                <div class="border-t border-gray-150 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">5. Vos droits et accès aux données</h2>
                    <p class="mb-3">
                        Conformément aux réglementations sur la protection des données personnelles, vous disposez d'un droit permanent d'accès, de rectification, de portabilité et de suppression de vos données personnelles.
                    </p>
                    <p class="mb-3">
                        Vous pouvez exercer ces droits à tout moment :
                    </p>
                    <ul class="list-disc pl-5 flex flex-col gap-1.5 mb-3">
                        <li>Depuis votre tableau de bord dans l'onglet <strong>Paramètres du compte</strong> pour rectifier vos informations ou supprimer votre compte.</li>
                        <li>En contactant notre support par e-mail à l'adresse <a href="mailto:contact@sessitrading.com" class="text-orange-500 hover:underline">contact@sessitrading.com</a>.</li>
                    </ul>
                </div>

                <div class="border-t border-gray-150 dark:border-gray-800 pt-6">
                    <h2 class="text-lg font-bold text-gray-955 dark:text-white mb-2">6. Utilisation des cookies</h2>
                    <p class="mb-3">
                        Notre site internet utilise des traceurs ("cookies") essentiels pour enregistrer le contenu de votre panier en ligne pendant votre navigation, mémoriser votre session de connexion, et réaliser des analyses de trafic anonymes.
                    </p>
                    <p>
                        Vous pouvez à tout moment configurer votre navigateur internet pour refuser l'installation des cookies, bien que cela puisse dégrader certaines fonctionnalités clés du site (comme la conservation des articles dans le panier).
                    </p>
                </div>

            </div>

        </div>
    </section>
</x-store-layout>
