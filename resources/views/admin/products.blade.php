<x-admin-layout>
    <div class="space-y-8" x-data="{
        addModalOpen: false,
        editModalOpen: false,
        activeProduct: {
            id: '',
            name: '',
            price: 0,
            original_price: '',
            category: '',
            description: '',
            stock: 0,
            is_popular: false,
            is_new: false
        },
        openEdit(product) {
            this.activeProduct = { ...product };
            this.editModalOpen = true;
        }
    }">
        <!-- Header & Add Button -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight font-outfit">Inventaire des Produits</h1>
                <p class="mt-1.5 text-sm text-gray-500 font-medium font-outfit">Gérez les fiches articles, les stocks et les prix de la boutique.</p>
            </div>
            
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <!-- Search bar -->
                <form method="GET" action="{{ route('admin.products') }}" class="relative">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Rechercher nom, catégorie..." class="w-full sm:w-64 bg-white text-xs rounded-full pl-10 pr-4 py-2.5 border-gray-200 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all shadow-sm font-medium">
                    <span class="absolute left-3.5 top-3 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    @if($search)
                        <a href="{{ route('admin.products') }}" class="absolute right-3 top-2.5 text-xs text-gray-400 hover:text-gray-600 bg-gray-100 rounded-full px-2 py-0.5">Effacer</a>
                    @endif
                </form>

                <button type="button" @click="addModalOpen = true" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition-all shadow-md shadow-orange-500/10 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Ajouter un Produit
                </button>
            </div>
        </div>

        <!-- Products Table Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm text-left">
                    <thead class="bg-gray-50/50">
                        <tr class="text-gray-400 font-semibold text-xs uppercase">
                            <th class="px-6 py-4">Article</th>
                            <th class="px-6 py-4">Catégorie</th>
                            <th class="px-6 py-4">Prix</th>
                            <th class="px-6 py-4">Stock</th>
                            <th class="px-6 py-4">Badges</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50/30 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="/images/products/{{$product->image}}?v=2" class="w-12 h-12 object-cover rounded-lg border border-gray-100 flex-shrink-0">
                                        <div class="space-y-0.5">
                                            <h4 class="font-bold text-gray-900 leading-snug">{{ $product->name }}</h4>
                                            <p class="text-xs text-gray-400 font-normal truncate max-w-xs">{{ Str::limit($product->description, 60) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900">{{ $product->category }}</td>
                                <td class="px-6 py-4 text-gray-900 font-bold">
                                    {{ number_format($product->price, 0, ',', ' ') }} F
                                    @if($product->original_price)
                                        <span class="block text-[10px] text-gray-400 font-normal line-through">{{ number_format($product->original_price, 0, ',', ' ') }} F</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($product->stock <= 0)
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-bold rounded-md bg-red-100 text-red-800">Rupture de stock</span>
                                    @elseif($product->stock <= 5)
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-bold rounded-md bg-amber-100 text-amber-800">{{ $product->stock }} restants</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-bold rounded-md bg-emerald-100 text-emerald-800">{{ $product->stock }} en stock</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-1.5">
                                        @if($product->is_popular)
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-orange-100 text-orange-700">Populaire</span>
                                        @endif
                                        @if($product->is_new)
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-blue-100 text-blue-700">Nouveau</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Edit button -->
                                        <button type="button" @click="openEdit({{ json_encode($product) }})" class="p-1.5 text-gray-500 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors" title="Modifier">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                        
                                        <!-- Delete action -->
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet article ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">Aucun produit ne correspond à vos filtres.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 font-medium">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

        <!-- Add Product Modal (Alpine.js) -->
        <div x-show="addModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="addModalOpen = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="addModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-middle bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white px-6 pt-6 pb-4 sm:p-8 space-y-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 font-outfit">Ajouter un nouveau produit</h3>
                                <p class="text-xs text-gray-400 mt-1">Créez une nouvelle fiche produit dans l'inventaire.</p>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Nom de l'article</label>
                                <input type="text" name="name" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Prix de vente (F CFA)</label>
                                    <input type="number" name="price" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Prix barré (Optionnel - F CFA)</label>
                                    <input type="number" name="original_price" class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Catégorie</label>
                                    <select name="category" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-semibold">
                                        <option value="Boubous">Boubous</option>
                                        <option value="Robes">Robes</option>
                                        <option value="Gilets">Gilets</option>
                                        <option value="Ensembles">Ensembles</option>
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Stock Initial</label>
                                    <input type="number" name="stock" value="15" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Description de l'article</label>
                                <textarea name="description" rows="3" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium"></textarea>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Photo du produit</label>
                                <input type="file" name="image_file" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            </div>

                            <!-- Badges -->
                            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="is_popular" id="add_is_popular" value="1" class="rounded text-orange-500 focus:ring-orange-500 border-gray-300">
                                    <label for="add_is_popular" class="text-xs font-bold text-gray-700">Mettre en avant (Populaire)</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="is_new" id="add_is_new" value="1" checked class="rounded text-orange-500 focus:ring-orange-500 border-gray-300">
                                    <label for="add_is_new" class="text-xs font-bold text-gray-700">Nouveauté (Badge Nouveau)</label>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-gray-50 px-6 py-4 sm:px-8 sm:py-5 flex justify-end gap-3 border-t border-gray-100">
                            <button type="button" @click="addModalOpen = false" class="px-4 py-2 text-xs font-bold text-gray-500 hover:text-gray-700">Annuler</button>
                            <button type="submit" class="px-5 py-2.5 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl transition-all shadow-md shadow-orange-500/10">Créer le Produit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal (Alpine.js) -->
        <div x-show="editModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="editModalOpen = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-middle bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                    <form :action="'/admin/products/' + activeProduct.id" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white px-6 pt-6 pb-4 sm:p-8 space-y-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 font-outfit">Modifier la Fiche Article</h3>
                                <p class="text-xs text-gray-400 mt-1">Mettez à jour les prix, stocks et détails du produit.</p>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Nom de l'article</label>
                                <input type="text" name="name" x-model="activeProduct.name" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Prix de vente (F CFA)</label>
                                    <input type="number" name="price" x-model="activeProduct.price" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Prix barré (Optionnel - F CFA)</label>
                                    <input type="number" name="original_price" x-model="activeProduct.original_price" class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Catégorie</label>
                                    <select name="category" x-model="activeProduct.category" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-semibold">
                                        <option value="Boubous">Boubous</option>
                                        <option value="Robes">Robes</option>
                                        <option value="Gilets">Gilets</option>
                                        <option value="Ensembles">Ensembles</option>
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Stock restants</label>
                                    <input type="number" name="stock" x-model="activeProduct.stock" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Description de l'article</label>
                                <textarea name="description" rows="3" x-model="activeProduct.description" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium"></textarea>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Nouvelle photo du produit (Optionnel)</label>
                                <input type="file" name="image_file" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            </div>

                            <!-- Badges -->
                            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <input type="hidden" name="is_popular" value="0">
                                    <input type="checkbox" name="is_popular" id="edit_is_popular" value="1" x-model="activeProduct.is_popular" class="rounded text-orange-500 focus:ring-orange-500 border-gray-300">
                                    <label for="edit_is_popular" class="text-xs font-bold text-gray-700">Mettre en avant (Populaire)</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="hidden" name="is_new" value="0">
                                    <input type="checkbox" name="is_new" id="edit_is_new" value="1" x-model="activeProduct.is_new" class="rounded text-orange-500 focus:ring-orange-500 border-gray-300">
                                    <label for="edit_is_new" class="text-xs font-bold text-gray-700">Nouveauté (Badge Nouveau)</label>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-gray-50 px-6 py-4 sm:px-8 sm:py-5 flex justify-end gap-3 border-t border-gray-100">
                            <button type="button" @click="editModalOpen = false" class="px-4 py-2 text-xs font-bold text-gray-500 hover:text-gray-700">Annuler</button>
                            <button type="submit" class="px-5 py-2.5 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl transition-all shadow-md shadow-orange-500/10">Enregistrer les Modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
