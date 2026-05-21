<x-admin-layout>
    <div class="space-y-8" x-data="{ 
        editModalOpen: false, 
        activeUser: {
            id: '',
            first_name: '',
            last_name: '',
            email: '',
            phone_number: '',
            address: '',
            city: '',
            country: '',
            is_admin: false,
            is_suspended: false
        },
        openEdit(user) {
            this.activeUser = { ...user };
            this.editModalOpen = true;
        }
    }">
        <!-- Header & Action -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight font-outfit">Gestion des Clients</h1>
                <p class="mt-1.5 text-sm text-gray-500 font-medium">Recherchez, modifiez et gérez les comptes utilisateurs.</p>
            </div>
            
            <!-- Search bar -->
            <form method="GET" action="{{ route('admin.users') }}" class="relative w-full sm:w-80">
                <input type="text" name="q" value="{{ $search }}" placeholder="Rechercher nom, email, ville..." class="w-full bg-white text-xs rounded-full pl-10 pr-4 py-2.5 border-gray-200 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-300 shadow-sm">
                <span class="absolute left-3.5 top-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                @if($search)
                    <a href="{{ route('admin.users') }}" class="absolute right-3 top-2.5 text-xs text-gray-400 hover:text-gray-600 bg-gray-100 rounded-full px-2 py-0.5">Effacer</a>
                @endif
            </form>
        </div>

        <!-- Users Table Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm text-left">
                    <thead class="bg-gray-50/50">
                        <tr class="text-gray-400 font-semibold text-xs uppercase">
                            <th class="px-6 py-4">Nom Complet</th>
                            <th class="px-6 py-4">Email / Tél</th>
                            <th class="px-6 py-4">Ville</th>
                            <th class="px-6 py-4">Rôle</th>
                            <th class="px-6 py-4">Statut</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50/30 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-orange-50 text-orange-600 font-bold flex items-center justify-center text-xs uppercase">
                                            {{ substr($user->first_name ?? $user->name, 0, 2) }}
                                        </div>
                                        <div class="space-y-0.5">
                                            <h4 class="font-bold text-gray-900 leading-snug">{{ $user->name }}</h4>
                                            <p class="text-[10px] text-gray-400">Inscrit le {{ $user->created_at->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-0.5">
                                        <p class="text-gray-900 font-semibold">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900">{{ $user->city ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    @if($user->is_admin)
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-bold rounded-md bg-orange-100 text-orange-800">Admin</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-bold rounded-md bg-gray-100 text-gray-600">Client</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_suspended)
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-bold rounded-md bg-red-100 text-red-800">Suspendu</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-bold rounded-md bg-emerald-100 text-emerald-800">Actif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Edit Action -->
                                        <button type="button" @click="openEdit({{ json_encode($user) }})" class="p-1.5 text-gray-500 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors" title="Modifier">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                        
                                        <!-- Suspend Toggle -->
                                        <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="p-1.5 rounded-lg transition-colors {{ $user->is_suspended ? 'text-emerald-600 hover:bg-emerald-50' : 'text-amber-600 hover:bg-amber-50' }}" title="{{ $user->is_suspended ? 'Réactiver' : 'Suspendre' }}">
                                                @if($user->is_suspended)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                @endif
                                            </button>
                                        </form>

                                        <!-- Delete Action -->
                                        @if(Auth::id() !== $user->id)
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet utilisateur ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">Aucun client trouvé pour votre recherche.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

        <!-- Edit User Modal (Alpine.js) -->
        <div x-show="editModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="editModalOpen = false"></div>
                
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-middle bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                    <form :action="'/admin/users/' + activeUser.id" method="POST">
                        @csrf
                        <div class="bg-white px-6 pt-6 pb-4 sm:p-8 space-y-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 font-outfit">Modifier l'Utilisateur</h3>
                                <p class="text-xs text-gray-400 mt-1">Mettez à jour les informations du compte client.</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Prénom</label>
                                    <input type="text" name="first_name" x-model="activeUser.first_name" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Nom</label>
                                    <input type="text" name="last_name" x-model="activeUser.last_name" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Adresse Email</label>
                                <input type="email" name="email" x-model="activeUser.email" required class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Téléphone</label>
                                <input type="text" name="phone_number" x-model="activeUser.phone_number" class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 uppercase">Adresse</label>
                                <input type="text" name="address" x-model="activeUser.address" class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Ville</label>
                                    <input type="text" name="city" x-model="activeUser.city" class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Pays</label>
                                    <input type="text" name="country" x-model="activeUser.country" class="w-full bg-gray-50 text-xs rounded-xl px-3 py-2.5 border-transparent focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition-all font-medium">
                                </div>
                            </div>

                            <!-- Roles / Permissions -->
                            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <input type="hidden" name="is_admin" value="0">
                                    <input type="checkbox" name="is_admin" id="edit_is_admin" value="1" x-model="activeUser.is_admin" class="rounded text-orange-500 focus:ring-orange-500 border-gray-300">
                                    <label for="edit_is_admin" class="text-xs font-bold text-gray-700">Administrateur</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="hidden" name="is_suspended" value="0">
                                    <input type="checkbox" name="is_suspended" id="edit_is_suspended" value="1" x-model="activeUser.is_suspended" class="rounded text-orange-500 focus:ring-orange-500 border-gray-300">
                                    <label for="edit_is_suspended" class="text-xs font-bold text-red-600">Compte Suspendu</label>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-gray-50 px-6 py-4 sm:px-8 sm:py-5 flex justify-end gap-3 border-t border-gray-100">
                            <button type="button" @click="editModalOpen = false" class="px-4 py-2 text-xs font-bold text-gray-500 hover:text-gray-700">Annuler</button>
                            <button type="submit" class="px-5 py-2.5 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl transition-all shadow-md shadow-orange-500/10">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
