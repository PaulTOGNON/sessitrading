<x-store-layout>
    <x-slot name="title">{{ $product->name }} - Sessitrading</x-slot>

    <!-- BREADCRUMBS -->
    <nav class="max-w-7xl mx-auto px-4 lg:px-8 pt-6 md:pt-10 text-xs md:text-sm font-semibold text-gray-500 flex items-center gap-2">
        <a href="{{ route('store.index') }}" class="hover:text-orange-500 transition-colors">Accueil</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('store.shop') }}" class="hover:text-orange-500 transition-colors">Boutique</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-orange-500 truncate">{{ $product->category }}</span>
        <svg class="w-3 h-3 hidden sm:inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-gray-900 dark:text-white truncate hidden sm:inline">{{ $product->name }}</span>
    </nav>

    <!-- PRODUCT DETAILS BLOCK (Interactive with Alpine.js) -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-16" x-data="{ 
        selectedSize: 'M',
        quantity: 1,
        activeTab: 'desc',
        activeImage: '/images/products/{{ $product->image }}',
        thumbnailImages: [
            '/images/products/{{ $product->image }}',
            'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=600&auto=format&fit=crop&q=80',
            'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=600&auto=format&fit=crop&q=80'
        ]
    }">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-start">
            
            <!-- LEFT COLUMN: Product Image Gallery -->
            <div class="flex flex-col gap-4">
                <!-- Large Display Image -->
                <div class="bg-gray-100 dark:bg-gray-900 rounded-3xl overflow-hidden aspect-[4/5] relative border border-gray-100 dark:border-gray-800 shadow-sm">
                    <img :src="activeImage" class="w-full h-full object-cover object-center transition-all duration-300" alt="{{ $product->name }}">
                    
                    @if($product->is_new)
                        <span class="absolute top-4 left-4 bg-orange-500 text-white font-extrabold text-xs px-3.5 py-1 rounded-full shadow-lg shadow-orange-500/10">NEW</span>
                    @elseif($product->original_price)
                        <span class="absolute top-4 left-4 bg-red-500 text-white font-extrabold text-xs px-3.5 py-1 rounded-full shadow-lg shadow-red-500/10">PROMO</span>
                    @endif
                </div>

                <!-- Interactive Thumbnails -->
                <div class="flex gap-3">
                    <template x-for="(img, idx) in thumbnailImages" :key="idx">
                        <button @click="activeImage = img" class="w-20 h-20 rounded-2xl overflow-hidden border-2 bg-gray-100 dark:bg-gray-900 flex-shrink-0 relative focus:outline-none transition-all duration-200" :class="activeImage === img ? 'border-orange-500 scale-95 shadow-md' : 'border-transparent hover:border-gray-300 dark:hover:border-gray-700'">
                            <img :src="img" class="w-full h-full object-cover object-center" alt="thumbnail">
                        </button>
                    </template>
                </div>
            </div>

            <!-- RIGHT COLUMN: Product Info and Selection Controls -->
            <div class="flex flex-col gap-6">
                <!-- Header Block -->
                <div class="flex flex-col gap-2">
                    <span class="text-xs md:text-sm font-bold uppercase tracking-wider text-orange-500">{{ $product->category }}</span>
                    <h1 class="text-2xl md:text-4xl font-black text-gray-950 dark:text-white tracking-tight leading-tight">
                        {{ $product->name }}
                    </h1>
                    
                    <!-- rating reviews block -->
                    <div class="flex items-center gap-3.5 mt-1">
                        <div class="flex items-center gap-1 bg-amber-500 text-white font-extrabold text-xs px-2.5 py-0.5 rounded-lg">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            {{ $product->rating }}
                        </div>
                        <span class="text-xs md:text-sm text-gray-400 font-semibold">({{ $product->reviews_count }} évaluations clients)</span>
                    </div>
                </div>

                <!-- Price Block -->
                <div class="border-y border-gray-100 dark:border-gray-800 py-4 flex flex-col gap-1.5">
                    <div class="flex items-baseline gap-4">
                        <span class="text-2xl md:text-3xl font-black text-orange-500">{{ $product->formatted_price }}</span>
                        @if($product->original_price)
                            <span class="text-base md:text-lg text-gray-400 line-through font-semibold">{{ $product->formatted_original_price }}</span>
                            <span class="bg-red-50 dark:bg-red-950/20 text-red-650 dark:text-red-400 font-bold text-xs px-2.5 py-1 rounded-md">
                                Économie de {{ number_format($product->original_price - $product->price, 0, ',', ' ') }} FCFA
                            </span>
                        @endif
                    </div>
                    <span class="text-xs text-gray-400">Taxes incluses. Livraison calculée au panier. En stock : <strong class="text-gray-900 dark:text-white">{{ $product->stock }} articles</strong>.</span>
                </div>

                <!-- Short description -->
                <p class="text-xs md:text-sm text-gray-650 dark:text-gray-300 leading-relaxed">
                    {{ $product->description }}
                </p>

                <!-- SIZE SELECTOR -->
                <div class="flex flex-col gap-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Taille : <strong class="text-gray-900 dark:text-white" x-text="selectedSize"></strong></span>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <button @click="selectedSize = '{{ $size }}'" class="h-11 px-5 rounded-xl border font-bold text-xs md:text-sm transition-all focus:outline-none" :class="selectedSize === '{{ $size }}' ? 'border-orange-500 bg-orange-50 text-orange-600 dark:bg-orange-950/30 dark:text-orange-400' : 'border-gray-200 hover:border-gray-400 dark:border-gray-700 text-gray-700 dark:text-gray-300'">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- QUANTITY & ADD TO CART ROW -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 mt-2">
                    <!-- Quantity control -->
                    <div class="flex items-center justify-between border border-gray-200 dark:border-gray-700 rounded-xl h-12 w-32 px-3">
                        <button @click="if(quantity > 1) quantity--" class="text-gray-500 hover:text-orange-500 font-extrabold focus:outline-none p-1">-</button>
                        <span class="text-sm font-bold text-gray-900 dark:text-white" x-text="quantity"></span>
                        <button @click="if(quantity < {{ $product->stock }}) quantity++" class="text-gray-500 hover:text-orange-500 font-extrabold focus:outline-none p-1">+</button>
                    </div>

                    <!-- Add to cart -->
                    <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm h-12 px-8 rounded-xl flex-grow flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 active:scale-[0.99] transition-all" @click="cartCount = cartCount + quantity; wishlistCount++; alert('Produit ajouté au panier !')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Ajouter au Panier
                    </button>
                </div>

                <!-- DETAILED INFORMATION ACCORDION TABS -->
                <div class="border-t border-gray-150 dark:border-gray-800 mt-6 pt-6">
                    <div class="flex border-b border-gray-150 dark:border-gray-800 gap-6 text-xs md:text-sm font-bold">
                        <button @click="activeTab = 'desc'" class="pb-3 border-b-2 transition-all focus:outline-none" :class="activeTab === 'desc' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-400 hover:text-gray-600'">Description</button>
                        <button @click="activeTab = 'livraison'" class="pb-3 border-b-2 transition-all focus:outline-none" :class="activeTab === 'livraison' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-400 hover:text-gray-600'">Livraison & Retours</button>
                        <button @click="activeTab = 'contact'" class="pb-3 border-b-2 transition-all focus:outline-none" :class="activeTab === 'contact' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-400 hover:text-gray-600'">Commander par WhatsApp</button>
                    </div>

                    <div class="py-4 text-xs md:text-sm text-gray-600 dark:text-gray-305 leading-relaxed">
                        <!-- Description tab -->
                        <div x-show="activeTab === 'desc'">
                            <p>Ce produit premium Sessitrading a été sélectionné pour sa durabilité et ses finitions soignées. Confectionné à partir de matériaux légers et agréables à porter.</p>
                            <ul class="list-disc list-inside mt-3 flex flex-col gap-1.5 text-gray-500">
                                <li>Coupe étudiée pour allier esthétique et liberté de mouvement</li>
                                <li>Matière respirante de premier choix</li>
                                <li>Coutures renforcées pour une longévité maximale</li>
                                <li>Entretien facile : Lavage en machine à 30° conseillé</li>
                            </ul>
                        </div>

                        <!-- Livraison tab -->
                        <div x-show="activeTab === 'livraison'" style="display: none;">
                            <p>Nous livrons partout au Bénin et dans la sous-région.</p>
                            <ul class="list-disc list-inside mt-3 flex flex-col gap-1.5 text-gray-500">
                                <li><strong>Retrait gratuit</strong> à notre boutique Sessitrading (Cotonou).</li>
                                <li>Livraison à domicile à Cotonou / Calavi sous 24h (1 000 FCFA à 2 000 FCFA).</li>
                                <li>Envoi par Zemidjan ou colis postal à l'intérieur du pays.</li>
                                <li>Retours acceptés sous 3 jours si l'article n'a pas été porté.</li>
                            </ul>
                        </div>

                        <!-- Contact tab -->
                        <div x-show="activeTab === 'contact'" style="display: none;" class="flex flex-col gap-3">
                            <p>Vous préférez finaliser votre commande directement par WhatsApp ? Aucun problème ! Envoyez-nous simplement une capture d'écran du produit.</p>
                            <a href="https://wa.me/22990000000?text=Bonjour%20Sessitrading,%20je%20souhaite%20commander%20l'article%20{{ urlencode($product->name) }}" target="_blank" class="w-max bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-lg shadow-emerald-500/10">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm5.835-3.23c1.657.982 3.284 1.517 5.161 1.519 5.516.002 10.01-4.486 10.014-9.998.002-2.67-1.033-5.18-2.915-7.065C16.27 3.34 13.766 2.3 11.101 2.3 5.585 2.3 1.09 6.788 1.086 12.3c-.001 1.939.513 3.526 1.489 5.109L1.5 22.1l4.392-1.33z"/></svg>
                                Discuter sur WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- RELATED PRODUCTS ("Produits similaires") -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-16 border-t border-gray-150 dark:border-gray-800">
        <h2 class="text-xl md:text-2xl font-black text-gray-950 dark:text-white tracking-tight mb-8 md:mb-12">
            Produits similaires
        </h2>

        <!-- 2 columns mobile, 4 columns desktop -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @forelse($relatedProducts as $related)
                <!-- Product Card Component -->
                <div class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-850 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full relative">
                    <!-- Wishlist button -->
                    <button class="absolute top-3 right-3 z-10 w-8.5 h-8.5 rounded-full bg-white/90 dark:bg-gray-800/90 flex items-center justify-center text-gray-400 hover:text-orange-500 transition-colors shadow" @click="wishlistCount++">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>

                    <!-- Image with link -->
                    <a href="{{ route('store.show', $related->slug) }}" class="block overflow-hidden bg-gray-50 dark:bg-gray-950 aspect-[4/5] relative">
                        <img src="/images/products/{{ $related->image }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" alt="{{ $related->name }}">
                        @if($related->is_new)
                            <span class="absolute top-3 left-3 bg-orange-500 text-white font-bold text-[9px] px-2.5 py-0.5 rounded-md">NEW</span>
                        @elseif($related->original_price)
                            <span class="absolute bottom-3 left-3 bg-red-500 text-white font-bold text-[9px] px-2 py-0.5 rounded-md">PROMO</span>
                        @endif
                    </a>

                    <!-- Details -->
                    <div class="p-3 md:p-4 flex flex-col flex-grow justify-between gap-2">
                        <div class="flex flex-col gap-1">
                            <span class="text-[9px] uppercase font-bold text-orange-500 tracking-wider">{{ $related->category }}</span>
                            <h3 class="text-xs md:text-sm font-extrabold text-gray-900 dark:text-white leading-tight line-clamp-1 group-hover:text-orange-500 transition-colors">
                                <a href="{{ route('store.show', $related->slug) }}">{{ $related->name }}</a>
                            </h3>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <span class="flex items-center text-[10px] font-bold text-amber-500">
                                    ★ {{ $related->rating }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-semibold">({{ $related->reviews_count }} avis)</span>
                            </div>
                        </div>

                        <div class="flex flex-col mt-1">
                            <div class="flex items-baseline gap-2">
                                <span class="text-sm md:text-base font-black text-orange-500">{{ $related->formatted_price }}</span>
                                @if($related->original_price)
                                    <span class="text-xs text-gray-400 line-through font-medium">{{ $related->formatted_original_price }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-400 col-span-full">Aucun produit similaire trouvé dans cette catégorie.</p>
            @endforelse
        </div>
    </section>

</x-store-layout>
