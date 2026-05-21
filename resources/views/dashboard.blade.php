<x-store-layout>
    <x-slot name="title">Mon Espace Client - Sessitrading</x-slot>

    <!-- Page Container -->
    <div class="bg-gray-50 min-h-screen py-8" x-data="{ tab: '{{ request('tab', 'overview') }}' }">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            
            <!-- Dashboard Header & Welcome Banner -->
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                <div class="flex items-center gap-4">
                    <!-- Avatar circle -->
                    <div class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-500 font-extrabold text-2xl">
                        {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-black text-gray-950 tracking-tight">
                            Bonjour, {{ Auth::user()->first_name ?? Auth::user()->name }} !
                        </h1>
                        <p class="text-xs md:text-sm text-gray-500">
                            Ravi de vous revoir. Gérez vos informations et suivez vos achats.
                        </p>
                    </div>
                </div>

                <!-- Quick actions / stats -->
                <div class="flex flex-wrap items-center gap-4 text-xs font-semibold">
                    <span class="bg-gray-100 text-gray-700 px-3.5 py-2 rounded-full">
                        Client depuis {{ Auth::user()->created_at->format('M Y') }}
                    </span>
                    
                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2.5 rounded-full shadow-sm hover:scale-102 active:scale-98 transition-all flex items-center gap-1.5 font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Sidebar Menu (Desktop) / Tabs Navigation -->
                <div class="lg:col-span-1 space-y-2">
                    <div class="bg-white rounded-3xl p-4 border border-gray-100 shadow-sm space-y-1">
                        
                        <!-- Tab button 1: Overview -->
                        <button @click="tab = 'overview'" :class="tab === 'overview' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/15' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-left text-sm font-bold transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                            Vue d'ensemble
                        </button>

                        <!-- Tab button 2: Orders -->
                        <button @click="tab = 'orders'" :class="tab === 'orders' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/15' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-left text-sm font-bold transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Mes Commandes
                        </button>

                        <!-- Tab button 3: Favorites -->
                        <button @click="tab = 'favorites'" :class="tab === 'favorites' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/15' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-left text-sm font-bold transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            Mes Favoris
                        </button>

                        <!-- Tab button 4: Cart -->
                        <button @click="tab = 'cart'" :class="tab === 'cart' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/15' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-left text-sm font-bold transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Mon Panier
                        </button>

                        <!-- Tab button 5: Settings -->
                        <button @click="tab = 'settings'" :class="tab === 'settings' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/15' : 'text-gray-600 hover:bg-gray-50'"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-left text-sm font-bold transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Paramètres du compte
                        </button>

                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-3">
                    
                    <!-- TAB 1: OVERVIEW -->
                    <div x-show="tab === 'overview'" class="space-y-6">
                        
                        <!-- Success message for profile changes -->
                        @if (session('status') === 'profile-updated')
                            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-2xl text-sm mb-4" role="alert">
                                Vos informations de profil ont été mises à jour avec succès.
                            </div>
                        @endif

                        <!-- Summary Cards Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            
                            <!-- Card: Orders -->
                            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group">
                                <div class="absolute -right-4 -bottom-4 text-orange-500/10 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M17 18c-1.11 0-2 .89-2 2s.89 2 2 2 2-.89 2-2-.89-2-2-2zM7 18c-1.11 0-2 .89-2 2s.89 2 2 2 2-.89 2-2-.89-2-2-2zm0-3c.27 0 .53-.11.71-.29L9.5 13H15c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7z"/></svg>
                                </div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Commandes</h3>
                                <p class="text-3xl font-black text-gray-950">1 active</p>
                                <button @click="tab = 'orders'" class="text-xs font-bold text-orange-500 hover:text-orange-600 mt-4 block">Voir mes commandes &rarr;</button>
                            </div>

                            <!-- Card: Favorites -->
                            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group">
                                <div class="absolute -right-4 -bottom-4 text-orange-500/10 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Favoris</h3>
                                <p class="text-3xl font-black text-gray-950">3 articles</p>
                                <button @click="tab = 'favorites'" class="text-xs font-bold text-orange-500 hover:text-orange-600 mt-4 block">Voir mes favoris &rarr;</button>
                            </div>

                            <!-- Card: Cart -->
                            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group">
                                <div class="absolute -right-4 -bottom-4 text-orange-500/10 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6h-2c0-2.76-2.24-5-5-5S7 3.24 7 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-3c1.66 0 3 1.34 3 3H9c0-1.66 1.34-3 3-3zm7 17H5V8h14v12z"/></svg>
                                </div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Panier</h3>
                                <p class="text-3xl font-black text-gray-950">2 articles</p>
                                <button @click="tab = 'cart'" class="text-xs font-bold text-orange-500 hover:text-orange-600 mt-4 block">Voir le panier &rarr;</button>
                            </div>

                        </div>

                        <!-- User Details Card -->
                        <div class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm">
                            <h3 class="text-lg font-black text-gray-950 tracking-tight mb-6">Informations de livraison par défaut</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nom complet</p>
                                    <p class="text-gray-900 font-bold mt-1">{{ Auth::user()->name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Téléphone</p>
                                    <p class="text-gray-900 font-bold mt-1">{{ Auth::user()->phone_number ?? 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Adresse</p>
                                    <p class="text-gray-900 font-bold mt-1">{{ Auth::user()->address ?? 'Non renseignée' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ville / Pays</p>
                                    <p class="text-gray-900 font-bold mt-1">
                                        {{ Auth::user()->city ?? 'Non renseignée' }} / {{ Auth::user()->country ?? 'Non renseigné' }}
                                    </p>
                                </div>
                            </div>
                            
                            <button @click="tab = 'settings'" class="mt-6 bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs px-5 py-2.5 rounded-full shadow-md shadow-orange-500/10 transition-all duration-200">
                                Mettre à jour mon adresse
                            </button>
                        </div>

                    </div>

                    <!-- TAB 2: ORDERS -->
                    <div x-show="tab === 'orders'" class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm space-y-6">
                        <h3 class="text-lg font-black text-gray-950 tracking-tight">Historique des commandes</h3>
                        
                        <!-- Table/List of Orders -->
                        <div class="space-y-4">
                            
                            <!-- Order Item 1 -->
                            <div class="border border-gray-100 rounded-2xl p-4 md:p-6 hover:shadow-md transition-shadow duration-300">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100 pb-4 mb-4 text-xs font-bold">
                                    <div class="flex flex-wrap gap-4 text-gray-500">
                                        <span>Commande <span class="text-gray-900">#ST-84931</span></span>
                                        <span>Passée le <span class="text-gray-900">18 Mai 2026</span></span>
                                    </div>
                                    <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-[10px] tracking-wide uppercase">En cours de livraison</span>
                                </div>
                                
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                    <!-- Order detail summary -->
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden">
                                            <img src="/images/products/robe_satin_vert_royal.jpg" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=150&auto=format&fit=crop&q=80'" alt="Product image">
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-950">Robe Satin Vert Royal</h4>
                                            <p class="text-xs text-gray-500 mt-0.5">Quantité : 1 • Couleur : Vert Royal</p>
                                            <p class="text-xs font-extrabold text-orange-500 mt-1">29 500 FCFA</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Actions & Total -->
                                    <div class="w-full md:w-auto flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center gap-2 pt-4 md:pt-0 border-t md:border-t-0 border-gray-100">
                                        <div>
                                            <p class="text-xs font-bold text-gray-400 text-left md:text-right uppercase">Total payé</p>
                                            <p class="text-base font-black text-gray-950 mt-0.5">29 500 FCFA</p>
                                        </div>
                                        <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold text-[10px] px-4 py-2 rounded-full transition-all">
                                            Détails de la commande
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Item 2 -->
                            <div class="border border-gray-100 rounded-2xl p-4 md:p-6 hover:shadow-md transition-shadow duration-300">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100 pb-4 mb-4 text-xs font-bold">
                                    <div class="flex flex-wrap gap-4 text-gray-500">
                                        <span>Commande <span class="text-gray-900">#ST-79012</span></span>
                                        <span>Passée le <span class="text-gray-900">12 Avril 2026</span></span>
                                    </div>
                                    <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-[10px] tracking-wide uppercase">Livrée</span>
                                </div>
                                
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                    <!-- Order detail summary -->
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden">
                                            <img src="/images/products/lin_ensemble_decontracte.jpg" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?w=150&auto=format&fit=crop&q=80'" alt="Product image">
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-950">Lin Ensemble Décontracté</h4>
                                            <p class="text-xs text-gray-500 mt-0.5">Quantité : 1 • Couleur : Beige</p>
                                            <p class="text-xs font-extrabold text-orange-500 mt-1">24 500 FCFA</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Actions & Total -->
                                    <div class="w-full md:w-auto flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center gap-2 pt-4 md:pt-0 border-t md:border-t-0 border-gray-100">
                                        <div>
                                            <p class="text-xs font-bold text-gray-400 text-left md:text-right uppercase">Total payé</p>
                                            <p class="text-base font-black text-gray-950 mt-0.5">24 500 FCFA</p>
                                        </div>
                                        <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold text-[10px] px-4 py-2 rounded-full transition-all">
                                            Facture PDF
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 3: FAVORITES -->
                    <div x-show="tab === 'favorites'" class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm space-y-6">
                        <h3 class="text-lg font-black text-gray-950 tracking-tight">Mes Articles Favoris</h3>
                        
                        <!-- Favorites grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            
                            <!-- Favorite Item 1 -->
                            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm hover:scale-[1.02] hover:shadow-lg transition-all duration-300">
                                <div class="relative h-64 bg-gray-100">
                                    <img src="/images/products/boubou_soie_brode_bleu.jpg" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=300&auto=format&fit=crop&q=80'" alt="Boubou Soie Brodé Bleu">
                                    <button class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white flex items-center justify-center text-red-500 shadow-md">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                    </button>
                                </div>
                                <div class="p-4 flex flex-col gap-1.5">
                                    <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Boubous</span>
                                    <h4 class="text-sm font-bold text-gray-950 truncate">Boubou Soie Brodé Bleu</h4>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-sm font-black text-orange-500">45 000 FCFA</span>
                                        <a href="{{ route('store.shop') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-[10px] px-3.5 py-1.5 rounded-full transition-all">
                                            Acheter
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Favorite Item 2 -->
                            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm hover:scale-[1.02] hover:shadow-lg transition-all duration-300">
                                <div class="relative h-64 bg-gray-100">
                                    <img src="/images/products/robe_satin_vert_royal.jpg" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=300&auto=format&fit=crop&q=80'" alt="Robe Satin Vert Royal">
                                    <button class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white flex items-center justify-center text-red-500 shadow-md">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                    </button>
                                </div>
                                <div class="p-4 flex flex-col gap-1.5">
                                    <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Robes</span>
                                    <h4 class="text-sm font-bold text-gray-950 truncate">Robe Satin Vert Royal</h4>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-sm font-black text-orange-500">29 500 FCFA</span>
                                        <a href="{{ route('store.shop') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-[10px] px-3.5 py-1.5 rounded-full transition-all">
                                            Acheter
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Favorite Item 3 -->
                            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm hover:scale-[1.02] hover:shadow-lg transition-all duration-300">
                                <div class="relative h-64 bg-gray-100">
                                    <img src="/images/products/lin_ensemble_decontracte.jpg" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?w=300&auto=format&fit=crop&q=80'" alt="Lin Ensemble Décontracté">
                                    <button class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white flex items-center justify-center text-red-500 shadow-md">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                    </button>
                                </div>
                                <div class="p-4 flex flex-col gap-1.5">
                                    <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Ensembles</span>
                                    <h4 class="text-sm font-bold text-gray-950 truncate">Lin Ensemble Décontracté</h4>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-sm font-black text-orange-500">24 500 FCFA</span>
                                        <a href="{{ route('store.shop') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-[10px] px-3.5 py-1.5 rounded-full transition-all">
                                            Acheter
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 4: CART -->
                    <div x-show="tab === 'cart'" class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm space-y-6">
                        <h3 class="text-lg font-black text-gray-950 tracking-tight">Mon Panier</h3>
                        
                        <!-- List of Cart Items -->
                        <div class="divide-y divide-gray-100">
                            
                            <!-- Cart Item 1 -->
                            <div class="py-4 flex justify-between items-center gap-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                        <img src="/images/products/robe_satin_vert_royal.jpg" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=150&auto=format&fit=crop&q=80'" alt="Robe Satin">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-950">Robe Satin Vert Royal</h4>
                                        <p class="text-xs text-gray-500 mt-0.5">Couleur : Vert Royal</p>
                                        <span class="text-xs text-orange-500 font-extrabold block mt-1">29 500 FCFA</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 text-sm">
                                    <div class="flex items-center border border-gray-100 rounded-full px-2.5 py-1 bg-gray-50 text-xs font-extrabold gap-3">
                                        <button class="hover:text-orange-500">&minus;</button>
                                        <span>1</span>
                                        <button class="hover:text-orange-500">&plus;</button>
                                    </div>
                                    <button class="text-red-500 hover:text-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Cart Item 2 -->
                            <div class="py-4 flex justify-between items-center gap-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                        <img src="/images/products/boubou_soie_brode_bleu.jpg" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=150&auto=format&fit=crop&q=80'" alt="Boubou Soie">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-950">Boubou Soie Brodé Bleu</h4>
                                        <p class="text-xs text-gray-500 mt-0.5">Couleur : Bleu Indigo</p>
                                        <span class="text-xs text-orange-500 font-extrabold block mt-1">45 000 FCFA</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 text-sm">
                                    <div class="flex items-center border border-gray-100 rounded-full px-2.5 py-1 bg-gray-50 text-xs font-extrabold gap-3">
                                        <button class="hover:text-orange-500">&minus;</button>
                                        <span>1</span>
                                        <button class="hover:text-orange-500">&plus;</button>
                                    </div>
                                    <button class="text-red-500 hover:text-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <!-- Subtotal and checkout -->
                        <div class="border-t border-gray-100 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase">Sous-total du panier</p>
                                <p class="text-2xl font-black text-gray-950 mt-1">74 500 FCFA</p>
                            </div>
                            <a href="{{ route('store.shop') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm px-6 py-3 rounded-full shadow-lg shadow-orange-500/15 transition-all">
                                Passer au paiement
                            </a>
                        </div>
                    </div>

                    <!-- TAB 5: SETTINGS (Forms integration) -->
                    <div x-show="tab === 'settings'" class="space-y-8">
                        
                        <!-- Success alert for profile changes -->
                        @if (session('status') === 'profile-updated')
                            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-2xl text-sm" role="alert">
                                Vos informations de profil ont été enregistrées avec succès.
                            </div>
                        @endif

                        <!-- Success alert for password changes -->
                        @if (session('status') === 'password-updated')
                            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-2xl text-sm" role="alert">
                                Votre mot de passe a été modifié avec succès.
                            </div>
                        @endif

                        <!-- Success alert for errors (if any update error bags are present) -->
                        @if ($errors->updatePassword->any())
                            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-2xl text-sm" role="alert">
                                <p class="font-bold">Impossible de mettre à jour le mot de passe :</p>
                                <ul class="list-disc pl-5 mt-1 text-xs">
                                    @foreach ($errors->updatePassword->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Section 1: Update Profile Details -->
                        <div class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm space-y-6">
                            <div>
                                <h3 class="text-lg font-black text-gray-950 tracking-tight">Informations personnelles</h3>
                                <p class="text-xs text-gray-500 mt-1">Mettez à jour vos coordonnées personnelles et votre adresse de livraison.</p>
                            </div>

                            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                                @csrf
                                @method('patch')
                                
                                <!-- Flag to redirect back to dashboard settings -->
                                <input type="hidden" name="redirect_to" value="dashboard">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    
                                    <!-- First Name -->
                                    <div>
                                        <label for="profile_first_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Prénom</label>
                                        <input id="profile_first_name" name="first_name" type="text" required 
                                            value="{{ old('first_name', Auth::user()->first_name) }}"
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                    <!-- Last Name -->
                                    <div>
                                        <label for="profile_last_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nom</label>
                                        <input id="profile_last_name" name="last_name" type="text" required 
                                            value="{{ old('last_name', Auth::user()->last_name) }}"
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label for="profile_phone" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Téléphone</label>
                                        <input id="profile_phone" name="phone_number" type="text" required 
                                            value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="profile_email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Adresse Email</label>
                                        <input id="profile_email" name="email" type="email" required 
                                            value="{{ old('email', Auth::user()->email) }}"
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                    <!-- Address -->
                                    <div class="md:col-span-2">
                                        <label for="profile_address" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Adresse de livraison</label>
                                        <input id="profile_address" name="address" type="text" required 
                                            value="{{ old('address', Auth::user()->address) }}"
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                    <!-- City -->
                                    <div>
                                        <label for="profile_city" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ville</label>
                                        <input id="profile_city" name="city" type="text" required 
                                            value="{{ old('city', Auth::user()->city) }}"
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                    <!-- Country -->
                                    <div>
                                        <label for="profile_country" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pays</label>
                                        <input id="profile_country" name="country" type="text" required 
                                            value="{{ old('country', Auth::user()->country) }}"
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                </div>

                                <div class="pt-4 flex justify-end">
                                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs px-6 py-3 rounded-full shadow-lg shadow-orange-500/10 hover:shadow-orange-500/20 hover:scale-102 transition-all">
                                        Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Section 2: Update Password -->
                        <div class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm space-y-6">
                            <div>
                                <h3 class="text-lg font-black text-gray-950 tracking-tight">Modifier le mot de passe</h3>
                                <p class="text-xs text-gray-500 mt-1">Garantissez la sécurité de votre compte en changeant de mot de passe régulièrement.</p>
                            </div>

                            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                                @csrf
                                @method('put')

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- Current Password -->
                                    <div>
                                        <label for="current_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Mot de passe actuel</label>
                                        <input id="current_password" name="current_password" type="password" required
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                    <!-- New Password -->
                                    <div>
                                        <label for="password_new" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nouveau mot de passe</label>
                                        <input id="password_new" name="password" type="password" required
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <label for="password_new_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Confirmer le mot de passe</label>
                                        <input id="password_new_confirmation" name="password_confirmation" type="password" required
                                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200">
                                    </div>
                                </div>

                                <div class="pt-4 flex justify-end">
                                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs px-6 py-3 rounded-full shadow-lg shadow-orange-500/10 hover:shadow-orange-500/20 hover:scale-102 transition-all">
                                        Mettre à jour le mot de passe
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Section 3: Delete Account (Critical Zone) -->
                        <div class="bg-white rounded-3xl p-6 md:p-8 border border-red-100 shadow-sm space-y-6">
                            <div>
                                <h3 class="text-lg font-black text-red-600 tracking-tight">Supprimer mon compte</h3>
                                <p class="text-xs text-gray-500 mt-1">Action irréversible. Toutes vos données personnelles et l'historique de vos commandes seront définitivement supprimés.</p>
                            </div>

                            <div x-data="{ confirmingDeletion: false }">
                                
                                <button @click="confirmingDeletion = true" x-show="!confirmingDeletion" class="bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs px-6 py-3 rounded-full transition-all">
                                    Demander la suppression du compte
                                </button>

                                <form method="POST" action="{{ route('profile.destroy') }}" x-show="confirmingDeletion" class="space-y-4 bg-red-50/50 p-6 rounded-2xl border border-red-100">
                                    @csrf
                                    @method('delete')
                                    
                                    <p class="text-xs text-red-800 font-bold">
                                        Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.
                                    </p>

                                    <div class="max-w-md">
                                        <input id="delete_password" name="password" type="password" required placeholder="Votre mot de passe actuel"
                                            class="w-full bg-white text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                                        @error('password', 'userDeletion')
                                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex items-center gap-3 pt-2">
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold text-xs px-6 py-2.5 rounded-full transition-all shadow-md">
                                            Confirmer la suppression
                                        </button>
                                        <button type="button" @click="confirmingDeletion = false" class="bg-white border border-gray-200 text-gray-700 font-bold text-xs px-5 py-2.5 rounded-full transition-all">
                                            Annuler
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-store-layout>
