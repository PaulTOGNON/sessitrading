<x-store-layout>
    <x-slot name="title">Sessitrading - Prêt-à-porter & Mode Premium</x-slot>

    <!-- HERO CAROUSEL BANNER (ALPINE.JS DRIVEN WITH AUTOPLAY) -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 pt-4 md:pt-8" x-data="{ 
        activeSlide: 3, 
        totalSlides: 6,
        next() { this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1 },
        prev() { this.activeSlide = this.activeSlide === 1 ? this.totalSlides : this.activeSlide - 1 },
        init() {
            setInterval(() => this.next(), 6000);
        }
    }">
        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-orange-400 to-amber-500 shadow-xl min-h-[220px] md:min-h-[380px] flex items-center">
            
            <!-- Slide 3 (Main Mockup Slide) -->
            <div x-show="activeSlide === 3" class="w-full grid grid-cols-1 md:grid-cols-2 items-center p-6 md:p-12 gap-6">
                <div class="flex flex-col gap-2 md:gap-4 text-white z-10">
                    <span class="text-xs md:text-sm font-bold uppercase tracking-wider bg-black/15 px-3 py-1 rounded-full w-max">Collection exclusive</span>
                    <h1 class="text-3xl md:text-5xl font-black leading-tight tracking-tight uppercase">
                        Ici <span class="text-black">Original</span><br>Qualité Premium
                    </h1>
                    <p class="text-xs md:text-base font-semibold text-orange-950/80 leading-relaxed">
                        exclusivement neuf
                    </p>
                    <a href="{{ route('store.shop') }}" class="mt-2 bg-black text-white hover:bg-gray-900 transition-colors w-max text-xs md:text-sm font-bold px-6 py-3 rounded-full shadow-lg shadow-black/15">
                        Découvrir maintenant
                    </a>
                </div>
                <!-- Right Side: Display mockup product elements -->
                <div class="hidden md:flex relative h-64 lg:h-80 items-center justify-center">
                    <div class="absolute right-0 top-6 w-36 h-36 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="grid grid-cols-2 gap-4 max-w-sm w-full relative z-10">
                        <div class="bg-white/15 backdrop-blur-md p-3 rounded-2xl border border-white/10 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                            <span class="text-[9px] uppercase font-bold text-orange-200">Robes</span>
                            <img src="/images/products/product2.jpeg" class="w-20 h-20 object-cover rounded-xl mt-1.5 shadow" alt="robe">
                        </div>
                        <div class="bg-white/15 backdrop-blur-md p-3 rounded-2xl border border-white/10 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                            <span class="text-[9px] uppercase font-bold text-orange-200">Boubous</span>
                            <img src="/images/products/product1.jpeg" class="w-20 h-20 object-cover rounded-xl mt-1.5 shadow" alt="boubou">
                        </div>
                        <div class="bg-white/15 backdrop-blur-md p-3 rounded-2xl border border-white/10 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                            <span class="text-[9px] uppercase font-bold text-orange-200">Sacs</span>
                            <img src="/images/products/product7.jpeg" class="w-20 h-20 object-cover rounded-xl mt-1.5 shadow" alt="bag">
                        </div>
                        <div class="bg-white/15 backdrop-blur-md p-3 rounded-2xl border border-white/10 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                            <span class="text-[9px] uppercase font-bold text-orange-200">Gilets</span>
                            <img src="/images/products/product5.jpeg" class="w-20 h-20 object-cover rounded-xl mt-1.5 shadow" alt="gilet">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 1 (Fallback Slide) -->
            <div x-show="activeSlide === 1" class="w-full grid grid-cols-1 md:grid-cols-2 items-center p-6 md:p-12 gap-6 bg-gradient-to-r from-orange-500 to-red-500">
                <div class="flex flex-col gap-2 md:gap-4 text-white z-10">
                    <span class="text-xs md:text-sm font-bold uppercase tracking-wider bg-black/15 px-3 py-1 rounded-full w-max">Nouveau catalogue</span>
                    <h1 class="text-3xl md:text-5xl font-black leading-tight tracking-tight uppercase">
                        Les Boubous<br>Amples & Chic
                    </h1>
                    <p class="text-xs md:text-base font-semibold text-orange-950/80 leading-relaxed">
                        Le meilleur de la mode traditionnelle
                    </p>
                    <a href="{{ route('store.shop') }}?category=Boubous" class="mt-2 bg-white text-orange-600 hover:bg-orange-50 transition-colors w-max text-xs md:text-sm font-bold px-6 py-3 rounded-full shadow-lg shadow-white/10">
                        Voir la sélection
                    </a>
                </div>
                <div class="hidden md:block relative h-64 lg:h-80 w-full">
                    <img src="/images/products/product9.jpeg" class="absolute right-4 bottom-0 h-[90%] object-contain rounded-t-3xl border-t border-x border-white/20 shadow-2xl" alt="traditionnel">
                </div>
            </div>

            <!-- Slide 2 (Fallback Slide) -->
            <div x-show="activeSlide === 2" class="w-full grid grid-cols-1 md:grid-cols-2 items-center p-6 md:p-12 gap-6 bg-gradient-to-r from-amber-500 to-yellow-500">
                <div class="flex flex-col gap-2 md:gap-4 text-white z-10">
                    <span class="text-xs md:text-sm font-bold uppercase tracking-wider bg-black/15 px-3 py-1 rounded-full w-max">Promotions</span>
                    <h1 class="text-3xl md:text-5xl font-black leading-tight tracking-tight uppercase">
                        Profitez de<br>Nos Offres Flash
                    </h1>
                    <p class="text-xs md:text-base font-semibold text-orange-950/80 leading-relaxed">
                        Jusqu'à 20% de remise immédiate
                    </p>
                    <a href="#promo" class="mt-2 bg-black text-white hover:bg-gray-900 transition-colors w-max text-xs md:text-sm font-bold px-6 py-3 rounded-full">
                        Accéder aux promos
                    </a>
                </div>
                <div class="hidden md:block relative h-64 lg:h-80 w-full">
                    <img src="/images/products/product6.jpeg" class="absolute right-12 bottom-0 h-[90%] object-contain rounded-t-3xl border-t border-x border-white/20 shadow-2xl" alt="promo">
                </div>
            </div>

            <!-- Slide 4 (Satin Dresses) -->
            <div x-show="activeSlide === 4" class="w-full grid grid-cols-1 md:grid-cols-2 items-center p-6 md:p-12 gap-6 bg-gradient-to-r from-pink-500 to-rose-600">
                <div class="flex flex-col gap-2 md:gap-4 text-white z-10">
                    <span class="text-xs md:text-sm font-bold uppercase tracking-wider bg-black/15 px-3 py-1 rounded-full w-max">Collection Robes</span>
                    <h1 class="text-3xl md:text-5xl font-black leading-tight tracking-tight uppercase">
                        Le Satin<br>Fluide & Chic
                    </h1>
                    <p class="text-xs md:text-base font-semibold text-orange-950/80 leading-relaxed">
                        Des coupes élégantes et modernes pour toutes vos soirées
                    </p>
                    <a href="{{ route('store.shop') }}?category=Robes" class="mt-2 bg-white text-rose-600 hover:bg-rose-50 transition-colors w-max text-xs md:text-sm font-bold px-6 py-3 rounded-full shadow-lg shadow-white/10">
                        Découvrir la collection
                    </a>
                </div>
                <div class="hidden md:block relative h-64 lg:h-80 w-full">
                    <img src="/images/products/product3.jpeg" class="absolute right-4 bottom-0 h-[90%] object-contain rounded-t-3xl border-t border-x border-white/20 shadow-2xl" alt="robes satin">
                </div>
            </div>

            <!-- Slide 5 (Gilets & Jackets) -->
            <div x-show="activeSlide === 5" class="w-full grid grid-cols-1 md:grid-cols-2 items-center p-6 md:p-12 gap-6 bg-gradient-to-r from-teal-500 to-cyan-600">
                <div class="flex flex-col gap-2 md:gap-4 text-white z-10">
                    <span class="text-xs md:text-sm font-bold uppercase tracking-wider bg-black/15 px-3 py-1 rounded-full w-max">Gilets & Vestes</span>
                    <h1 class="text-3xl md:text-5xl font-black leading-tight tracking-tight uppercase">
                        Style &<br>Confort Moderne
                    </h1>
                    <p class="text-xs md:text-base font-semibold text-orange-950/80 leading-relaxed">
                        Gilets sans manches et vestes légères pour parfaire votre style
                    </p>
                    <a href="{{ route('store.shop') }}?category=Gilets" class="mt-2 bg-black text-white hover:bg-gray-900 transition-colors w-max text-xs md:text-sm font-bold px-6 py-3 rounded-full">
                        Voir les modèles
                    </a>
                </div>
                <div class="hidden md:block relative h-64 lg:h-80 w-full">
                    <img src="/images/products/product6.jpeg" class="absolute right-12 bottom-0 h-[90%] object-contain rounded-t-3xl border-t border-x border-white/20 shadow-2xl" alt="gilets">
                </div>
            </div>

            <!-- Slide 6 (Ensembles) -->
            <div x-show="activeSlide === 6" class="w-full grid grid-cols-1 md:grid-cols-2 items-center p-6 md:p-12 gap-6 bg-gradient-to-r from-indigo-500 to-blue-600">
                <div class="flex flex-col gap-2 md:gap-4 text-white z-10">
                    <span class="text-xs md:text-sm font-bold uppercase tracking-wider bg-black/15 px-3 py-1 rounded-full w-max">Ensembles Homme/Femme</span>
                    <h1 class="text-3xl md:text-5xl font-black leading-tight tracking-tight uppercase">
                        Ensembles<br>Chic & Lin
                    </h1>
                    <p class="text-xs md:text-base font-semibold text-orange-950/80 leading-relaxed">
                        Le raffinement décontracté idéal pour vos journées ensoleillées
                    </p>
                    <a href="{{ route('store.shop') }}?category=Ensembles" class="mt-2 bg-white text-indigo-600 hover:bg-indigo-50 transition-colors w-max text-xs md:text-sm font-bold px-6 py-3 rounded-full shadow-lg shadow-white/10">
                        Découvrir les ensembles
                    </a>
                </div>
                <div class="hidden md:block relative h-64 lg:h-80 w-full">
                    <img src="/images/products/product4.jpeg" class="absolute right-4 bottom-0 h-[90%] object-contain rounded-t-3xl border-t border-x border-white/20 shadow-2xl" alt="ensembles">
                </div>
            </div>

            <!-- Carousel Pagination Overlay (Matching 3/6 Style) -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-3.5 bg-black/25 backdrop-blur-md px-4 py-1.5 rounded-full border border-white/10 z-20">
                <button @click="prev()" class="text-white hover:text-orange-350 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <span class="text-xs font-black text-white" x-text="activeSlide + ' / ' + totalSlides">3 / 6</span>
                <button @click="next()" class="text-white hover:text-orange-350 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- SHOP BY CATEGORY (Circular matching mockup) -->
    <section id="categories" class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-16">
        <h2 class="text-xl md:text-2xl font-black text-gray-950 dark:text-white tracking-tight mb-6 md:mb-10 text-center md:text-left">
            Acheté par catégories
        </h2>
        
        <!-- Scrolling circular row -->
        <div class="flex items-center gap-6 overflow-x-auto pb-4 scrollbar-none snap-x snap-mandatory">
            
            <!-- Category Item 1 (Robes) -->
            <a href="{{ route('store.shop') }}?category=Robes" class="flex flex-col items-center gap-3 flex-shrink-0 snap-start text-center w-24 md:w-32 group">
                <div class="w-20 h-20 md:w-28 md:h-28 rounded-full overflow-hidden border-2 border-transparent group-hover:border-orange-500 transition-all duration-300 bg-white dark:bg-gray-900 shadow-md">
                    <img src="/images/products/product2.jpeg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Robes">
                </div>
                <span class="text-xs md:text-sm font-bold text-gray-800 dark:text-gray-200 group-hover:text-orange-500 transition-colors truncate w-full">Robes</span>
            </a>

            <!-- Category Item 2 (Boubous) -->
            <a href="{{ route('store.shop') }}?category=Boubous" class="flex flex-col items-center gap-3 flex-shrink-0 snap-start text-center w-24 md:w-32 group">
                <div class="w-20 h-20 md:w-28 md:h-28 rounded-full overflow-hidden border-2 border-transparent group-hover:border-orange-500 transition-all duration-300 bg-white dark:bg-gray-900 shadow-md">
                    <img src="/images/products/product1.jpeg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Boubous">
                </div>
                <span class="text-xs md:text-sm font-bold text-gray-800 dark:text-gray-200 group-hover:text-orange-500 transition-colors truncate w-full">Boubous</span>
            </a>

            <!-- Category Item 5 (Gilets) -->
            <a href="{{ route('store.shop') }}?category=Gilets" class="flex flex-col items-center gap-3 flex-shrink-0 snap-start text-center w-24 md:w-32 group">
                <div class="w-20 h-20 md:w-28 md:h-28 rounded-full overflow-hidden border-2 border-transparent group-hover:border-orange-500 transition-all duration-300 bg-white dark:bg-gray-900 shadow-md">
                    <img src="/images/products/product5.jpeg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Gilets">
                </div>
                <span class="text-xs md:text-sm font-bold text-gray-800 dark:text-gray-200 group-hover:text-orange-500 transition-colors truncate w-full">Gilets & Vestes</span>
            </a>

            <!-- Category Item 6 (Ensembles) -->
            <a href="{{ route('store.shop') }}?category=Ensembles" class="flex flex-col items-center gap-3 flex-shrink-0 snap-start text-center w-24 md:w-32 group">
                <div class="w-20 h-20 md:w-28 md:h-28 rounded-full overflow-hidden border-2 border-transparent group-hover:border-orange-500 transition-all duration-300 bg-white dark:bg-gray-900 shadow-md">
                    <img src="/images/products/product4.jpeg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Ensembles">
                </div>
                <span class="text-xs md:text-sm font-bold text-gray-800 dark:text-gray-200 group-hover:text-orange-500 transition-colors truncate w-full">Ensembles H/F</span>
            </a>
        </div>
    </section>

    <!-- FEATURED STORE CARD (Sessitrading Showcase) -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-4 md:py-8">
        <div class="bg-gray-100 dark:bg-gray-900 rounded-3xl overflow-hidden shadow-lg border border-gray-100/50 dark:border-gray-800/50 grid grid-cols-1 md:grid-cols-2 items-center">
            
            <!-- Left image side -->
            <div class="relative h-64 md:h-96 bg-gray-200">
                <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800&auto=format&fit=crop&q=80" class="w-full h-full object-cover" alt="Sessitrading Premium Apparel Collection">
                
                <!-- White heart badge top right -->
                <button class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white flex items-center justify-center text-orange-500 shadow-md hover:scale-105 transition-transform" @click="wishlistCount++">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </button>
            </div>

            <!-- Right card body -->
            <div class="p-6 md:p-12 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-500 text-white px-3 py-1.5 rounded-full font-black text-[10px] tracking-widest uppercase">SESSITRADING</div>
                        <span class="text-xs font-bold text-gray-500 dark:text-gray-400">Sélection Premium</span>
                    </div>

                    <!-- rating badge -->
                    <span class="flex items-center gap-1 bg-amber-500 text-white font-bold text-xs px-2.5 py-1 rounded-lg">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        4.9
                    </span>
                </div>

                <h3 class="text-2xl md:text-3xl font-black text-gray-950 dark:text-white leading-tight">
                    L'Élégance au Quotidien
                </h3>
                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                    Découvrez une collection unique célébrant l'harmonie parfaite entre tradition et modernité. Nos magnifiques boubous en soie brodés, nos robes fluides en satin et nos ensembles en lin raffinés sont confectionnés dans des matières nobles rigoureusement sélectionnées pour vous offrir un confort ultime et une élégance intemporelle.
                </p>

                <div class="flex items-center gap-4 mt-2">
                    <a href="{{ route('store.shop') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs px-6 py-3 rounded-full shadow-lg shadow-orange-500/15">
                        Découvrir toute la boutique
                    </a>
                </div>
            </div>

        </div>
    </section>



    <!-- BEST SELLERS ("Produits les plus vendus" - Screenshot 3) -->
    <section id="popular" class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-16">
        <div class="flex items-center justify-between mb-8 md:mb-12">
            <h2 class="text-xl md:text-2xl font-black text-gray-950 dark:text-white tracking-tight">
                Produits les plus vendus
            </h2>
            <a href="{{ route('store.shop') }}" class="flex items-center gap-1.5 text-xs md:text-sm font-bold text-orange-500 hover:text-orange-600 group">
                Tout voir
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <!-- 2 columns mobile, 4 columns desktop -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($popularProducts as $product)
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
                        @if($product->original_price)
                            <span class="absolute bottom-3 left-3 bg-red-500 text-white font-bold text-[9px] px-2 py-0.5 rounded-md">PROMO</span>
                        @endif
                    </a>

                    <!-- Details -->
                    <div class="p-3 md:p-4 flex flex-col flex-grow justify-between gap-2">
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

                        <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs md:text-sm font-black text-orange-500">{{ $product->formatted_price }}</span>
                                @if($product->original_price)
                                    <span class="text-[10px] text-gray-450 line-through font-medium">{{ $product->formatted_original_price }}</span>
                                @endif
                            </div>
                            <button @click="addToCart({{ $product->id }})" class="p-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl transition-colors shadow-md shadow-orange-500/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- PROMOTIONAL HERO BANNER (Modern creative section) -->
    <section id="promo" class="max-w-7xl mx-auto px-4 lg:px-8 py-8">
        <div class="bg-orange-500 rounded-3xl p-8 md:p-16 text-white text-center md:text-left relative overflow-hidden shadow-xl shadow-orange-500/10">
            <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-white/10 -skew-x-12 translate-x-1/2 pointer-events-none"></div>
            <div class="relative z-10 max-w-xl flex flex-col gap-3.5 md:gap-5">
                <span class="text-xs font-bold uppercase tracking-widest bg-white/25 px-4 py-1 rounded-full w-max mx-auto md:mx-0">Offre Spéciale</span>
                <h2 class="text-3xl md:text-5xl font-black leading-tight tracking-tight">PROMOTION DE LA SEMAINE !</h2>
                <p class="text-sm md:text-base font-medium text-orange-100 leading-relaxed">
                    Profitez de réductions allant jusqu'à -25% sur nos boubous amples et gilets contemporains. Stock ultra-limité !
                </p>
                <a href="{{ route('store.shop') }}" class="bg-black text-white hover:bg-gray-950 font-bold text-xs md:text-sm px-8 py-4.5 rounded-full w-max mx-auto md:mx-0 shadow-lg shadow-black/15 transition-all">
                    Acheter en Promotion
                </a>
            </div>
        </div>
    </section>

    <!-- NEW ARRIVALS ("Nouveautés") -->
    <section id="new" class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-16">
        <h2 class="text-xl md:text-2xl font-black text-gray-950 dark:text-white tracking-tight mb-8 md:mb-12">
            Nouveautés
        </h2>

        <!-- 2 columns mobile, 4 columns desktop -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($newProducts as $product)
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
                        <span class="absolute top-3 left-3 bg-orange-500 text-white font-bold text-[9px] px-2.5 py-0.5 rounded-md">NEW</span>
                    </a>

                    <!-- Details -->
                    <div class="p-3 md:p-4 flex flex-col flex-grow justify-between gap-2">
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

                        <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs md:text-sm font-black text-orange-500">{{ $product->formatted_price }}</span>
                                @if($product->original_price)
                                    <span class="text-[10px] text-gray-455 line-through font-medium">{{ $product->formatted_original_price }}</span>
                                @endif
                            </div>
                            <button @click="addToCart({{ $product->id }})" class="p-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl transition-colors shadow-md shadow-orange-500/10">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ALL PRODUCTS ("Tous les produits" - Screenshot 3) -->
    <section id="all-products" class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-16 border-t border-gray-100 dark:border-gray-900">
        <h2 class="text-xl md:text-2xl font-black text-gray-950 dark:text-white tracking-tight mb-8 md:mb-12">
            Tous les produits
        </h2>

        <!-- 2 columns mobile, 4 columns desktop -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($allProducts as $product)
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
                    <div class="p-3 md:p-4 flex flex-col flex-grow justify-between gap-2">
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

                        <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs md:text-sm font-black text-orange-500">{{ $product->formatted_price }}</span>
                                @if($product->original_price)
                                    <span class="text-[10px] text-gray-450 line-through font-medium">{{ $product->formatted_original_price }}</span>
                                @endif
                            </div>
                            <button @click="addToCart({{ $product->id }})" class="p-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl transition-colors shadow-md shadow-orange-500/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- CUSTOMER REVIEWS ("Avis clients") -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-16 border-t border-gray-100 dark:border-gray-900 bg-gray-50/50 dark:bg-gray-950/20">
        <h2 class="text-xl md:text-2xl font-black text-gray-950 dark:text-white tracking-tight mb-8 md:mb-12 text-center">
            Ce que disent nos clients
        </h2>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($reviews as $review)
                <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-850 shadow-sm flex flex-col justify-between gap-4">
                    <div class="flex flex-col gap-2">
                        <!-- Rating Stars -->
                        <div class="flex text-amber-500 gap-0.5">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 fill-current {{ $i < $review['rating'] ? 'text-amber-500' : 'text-gray-200' }}" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            @endfor
                        </div>
                        <p class="text-xs md:text-sm text-gray-650 dark:text-gray-300 italic leading-relaxed">
                            &ldquo;{{ $review['comment'] }}&rdquo;
                        </p>
                    </div>

                    <!-- Client Profile -->
                    <div class="flex items-center gap-3 mt-2">
                        <img src="{{ $review['avatar'] }}" class="w-10 h-10 rounded-full object-cover shadow" alt="{{ $review['name'] }}">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-900 dark:text-white">{{ $review['name'] }}</span>
                            <span class="text-[10px] text-gray-400 font-semibold">{{ $review['date'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</x-store-layout>
