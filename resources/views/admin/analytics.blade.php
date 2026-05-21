<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight font-outfit">Analyses & Rapports</h1>
            <p class="mt-1.5 text-sm text-gray-500 font-medium font-outfit">Visualisez les performances de vente, la popularité des articles et les tendances des paniers.</p>
        </div>

        <!-- Analytics Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Card 1: Popular products (Ordered) -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Palmarès des Ventes</h3>
                    <p class="text-xs text-gray-400 font-medium">Top 5 des produits les plus vendus (quantité totale commandée).</p>
                </div>

                <div class="space-y-5">
                    @php 
                        $maxOrdered = count($popularProducts) > 0 ? max(array_column($popularProducts, 'ordered_count')) : 1;
                        if ($maxOrdered == 0) $maxOrdered = 1;
                    @endphp
                    @forelse($popularProducts as $index => $prod)
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-orange-100 text-orange-700 font-bold flex items-center justify-center text-[10px]">{{ $index + 1 }}</span>
                                    <span class="font-bold text-gray-800">{{ $prod['name'] }}</span>
                                </div>
                                <span class="font-black text-gray-900">{{ $prod['ordered_count'] }} vendus</span>
                            </div>
                            <!-- Styled Progress Bar -->
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-orange-500 h-full rounded-full transition-all duration-500" style="width: {{ ($prod['ordered_count'] / $maxOrdered) * 100 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-8 text-sm">Aucune donnée de vente pour le moment.</p>
                    @endforelse
                </div>
            </div>

            <!-- Card 2: Most Favorited -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Coups de Cœur Clients</h3>
                    <p class="text-xs text-gray-400 font-medium">Top 5 des produits les plus souvent ajoutés aux favoris.</p>
                </div>

                <div class="space-y-5">
                    @php 
                        $maxFav = count($favoritedProducts) > 0 ? max(array_column($favoritedProducts, 'favorites_count')) : 1;
                        if ($maxFav == 0) $maxFav = 1;
                    @endphp
                    @forelse($favoritedProducts as $index => $prod)
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-orange-100 text-orange-700 font-bold flex items-center justify-center text-[10px]">{{ $index + 1 }}</span>
                                    <span class="font-bold text-gray-800">{{ $prod['name'] }}</span>
                                </div>
                                <span class="font-black text-gray-900">{{ $prod['favorites_count'] }} favoris</span>
                            </div>
                            <!-- Styled Progress Bar -->
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-rose-500 h-full rounded-full transition-all duration-500" style="width: {{ ($prod['favorites_count'] / $maxFav) * 100 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-8 text-sm">Aucun produit mis en favoris pour le moment.</p>
                    @endforelse
                </div>
            </div>

            <!-- Card 3: Active Carts -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Intérêt d'Achat (Paniers)</h3>
                    <p class="text-xs text-gray-400 font-medium">Top 5 des produits les plus présents dans les paniers actifs.</p>
                </div>

                <div class="space-y-5">
                    @php 
                        $maxCart = count($activeCartProducts) > 0 ? max(array_column($activeCartProducts, 'cart_count')) : 1;
                        if ($maxCart == 0) $maxCart = 1;
                    @endphp
                    @forelse($activeCartProducts as $index => $prod)
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-orange-100 text-orange-700 font-bold flex items-center justify-center text-[10px]">{{ $index + 1 }}</span>
                                    <span class="font-bold text-gray-800">{{ $prod['name'] }}</span>
                                </div>
                                <span class="font-black text-gray-900">{{ $prod['cart_count'] }} dans des paniers</span>
                            </div>
                            <!-- Styled Progress Bar -->
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-indigo-500 h-full rounded-full transition-all duration-500" style="width: {{ ($prod['cart_count'] / $maxCart) * 100 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-8 text-sm">Aucun produit dans un panier actif actuellement.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
