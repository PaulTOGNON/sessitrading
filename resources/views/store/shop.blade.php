<x-store-layout>
    <x-slot name="title">Boutique - Sessitrading</x-slot>

    <!-- BREADCRUMBS & TITLE -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 pt-6 md:pt-10">
        <nav class="text-xs md:text-sm font-semibold text-gray-500 flex items-center gap-2 mb-4">
            <a href="{{ route('store.index') }}" class="hover:text-orange-500 transition-colors">Accueil</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-orange-500 font-bold">Boutique</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-gray-150 dark:border-gray-800 pb-6">
            <div>
                <h1 class="text-2xl md:text-4xl font-black text-gray-950 dark:text-white tracking-tight">Tous nos articles</h1>
                <p class="text-xs md:text-sm text-gray-400 font-semibold mt-1">
                    Découvrez notre collection exclusive de vêtements et accessoires importés de qualité supérieure.
                </p>
            </div>
            <span class="text-xs font-bold text-gray-500 bg-gray-100 dark:bg-gray-850 px-3 py-1.5 rounded-full w-max">
                {{ $products->count() }} articles trouvés
            </span>
        </div>
    </section>

    <!-- FILTERS AND PRODUCTS GRID -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-6 md:py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- SIDEBAR FILTERS (Desktop) & Collapsible (Mobile) -->
            <div class="lg:col-span-1 flex flex-col gap-6" x-data="{ showMobileFilters: false }">
                <!-- Mobile Filters Button -->
                <button @click="showMobileFilters = !showMobileFilters" class="lg:hidden w-full flex items-center justify-between bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 dark:text-gray-300">
                    <span class="flex items-center gap-2">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filtres & Options
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': showMobileFilters}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Filter Form Container -->
                <div x-show="showMobileFilters" class="lg:block flex flex-col gap-6" x-transition x-cloak class="hidden lg:flex flex-col gap-6">
                    <form action="{{ route('store.shop') }}" method="GET" class="flex flex-col gap-6">
                        
                        <!-- Search input -->
                        <div class="flex flex-col gap-2">
                            <label for="search" class="text-xs font-bold uppercase tracking-wider text-gray-400">Rechercher</label>
                            <div class="relative">
                                <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Ex: chemise, boubou..." class="w-full bg-white dark:bg-gray-900 text-xs rounded-xl pl-9 pr-4 py-3 border border-gray-200 dark:border-gray-800 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-gray-900 dark:text-white transition-all">
                                <span class="absolute left-3 top-3.5 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </span>
                            </div>
                        </div>

                        <!-- Category picker -->
                        <div class="flex flex-col gap-2.5">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Catégories</span>
                            <div class="flex flex-col gap-2">
                                <label class="flex items-center gap-2.5 text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 cursor-pointer">
                                    <input type="radio" name="category" value="" {{ !$selectedCategory ? 'checked' : '' }} onchange="this.form.submit()" class="rounded-full text-orange-500 focus:ring-orange-500 border-gray-300">
                                    <span>Toutes les catégories</span>
                                </label>
                                @foreach($categories as $category)
                                    <label class="flex items-center gap-2.5 text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 cursor-pointer">
                                        <input type="radio" name="category" value="{{ $category }}" {{ $selectedCategory === $category ? 'checked' : '' }} onchange="this.form.submit()" class="rounded-full text-orange-500 focus:ring-orange-500 border-gray-300">
                                        <span>{{ $category }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Sort picker -->
                        <div class="flex flex-col gap-2">
                            <label for="sort" class="text-xs font-bold uppercase tracking-wider text-gray-400">Trier par</label>
                            <select name="sort" id="sort" onchange="this.form.submit()" class="w-full bg-white dark:bg-gray-900 text-xs rounded-xl px-3 py-3 border border-gray-200 dark:border-gray-800 focus:border-orange-500 focus:ring-orange-500 text-gray-900 dark:text-white font-semibold">
                                <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Derniers arrivages</option>
                                <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Prix : Ordre croissant</option>
                                <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Prix : Ordre décroissant</option>
                                <option value="rating" {{ $sort === 'rating' ? 'selected' : '' }}>Mieux notés</option>
                            </select>
                        </div>

                        <!-- Clear filter -->
                        @if($search || $selectedCategory || $sort !== 'latest')
                            <a href="{{ route('store.shop') }}" class="w-full text-center py-3 rounded-xl border border-dashed border-gray-300 dark:border-gray-700 text-xs font-bold text-gray-500 hover:text-orange-500 transition-colors">
                                Réinitialiser les filtres
                            </a>
                        @endif

                    </form>
                </div>
            </div>

            <!-- PRODUCTS LIST GRID -->
            <div class="lg:col-span-3">
                @if($products->isEmpty())
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-12 text-center flex flex-col items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-orange-50 dark:bg-orange-950/20 text-orange-500 flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-extrabold text-gray-900 dark:text-white">Aucun produit trouvé</h3>
                        <p class="text-xs md:text-sm text-gray-400 max-w-sm">
                            Nous n'avons trouvé aucun résultat correspondant à votre recherche. Essayez de réinitialiser vos filtres ou de modifier votre recherche.
                        </p>
                        <a href="{{ route('store.shop') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs px-6 py-3 rounded-full shadow-lg shadow-orange-500/10 transition-colors mt-2">
                            Voir tous les produits
                        </a>
                    </div>
                @else
                    <!-- 2 columns mobile, 3 columns desktop -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                        @foreach($products as $product)
                            <!-- Product Card Component -->
                            <div class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-850 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full relative">
                                <!-- Wishlist button -->
                                <button class="absolute top-3 right-3 z-10 w-8.5 h-8.5 rounded-full bg-white/90 dark:bg-gray-800/90 flex items-center justify-center transition-colors shadow"
                                    :class="isFavorite({{ $product->id }}) ? 'text-red-500' : 'text-gray-450 hover:text-orange-500'"
                                    @click="toggleFavorite({{ $product->id }})">
                                    <svg class="w-4.5 h-4.5" :fill="isFavorite({{ $product->id }}) ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </button>

                                <!-- Image with link -->
                                <a href="{{ route('store.show', $product->slug) }}" class="block overflow-hidden bg-gray-50 dark:bg-gray-950 aspect-[4/5] relative">
                                    <img src="/images/products/{{ $product->image }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" alt="{{ $product->name }}">
                                    @if($product->is_new)
                                        <span class="absolute top-3 left-3 bg-orange-500 text-white font-bold text-[9px] px-2.5 py-0.5 rounded-md">NEW</span>
                                    @elseif($product->original_price)
                                        <span class="absolute bottom-3 left-3 bg-red-500 text-white font-bold text-[9px] px-2 py-0.5 rounded-md">PROMO</span>
                                    @endif
                                </a>

                                <!-- Details -->
                                <div class="p-3 md:p-4 flex flex-col flex-grow justify-between gap-3">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[9px] uppercase font-bold text-orange-500 tracking-wider">{{ $product->category }}</span>
                                        <h3 class="text-xs md:text-sm font-extrabold text-gray-900 dark:text-white leading-tight line-clamp-1 group-hover:text-orange-500 transition-colors">
                                            <a href="{{ route('store.show', $product->slug) }}">{{ $product->name }}</a>
                                        </h3>
                                        <div class="flex items-center gap-1.5 mt-0.5">
                                            <span class="flex items-center text-[10px] font-bold text-amber-500">
                                                ★ {{ $product->rating }}
                                            </span>
                                            <span class="text-[10px] text-gray-400 font-semibold">({{ $product->reviews_count }} avis)</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-2.5 mt-1">
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-sm md:text-base font-black text-orange-500">{{ $product->formatted_price }}</span>
                                            @if($product->original_price)
                                                <span class="text-xs text-gray-400 line-through font-medium">{{ $product->formatted_original_price }}</span>
                                            @endif
                                        </div>

                                        <!-- Quick add to cart button -->
                                        <button class="w-full bg-orange-50 dark:bg-orange-950/20 text-orange-600 dark:text-orange-400 hover:bg-orange-500 hover:text-white transition-all duration-300 font-bold text-xs py-2 rounded-xl flex items-center justify-center gap-1.5" @click="addToCart({{ $product->id }})">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                            Ajouter au Panier
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </section>

</x-store-layout>
