<x-store-layout>
    <x-slot name="title">Inscription - Sessitrading</x-slot>

    <!-- Main Container -->
    <div class="min-h-[80vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8 bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100 transition-all duration-300 hover:shadow-2xl">
            
            <!-- Header Section -->
            <div class="text-center">
                <!-- Logo -->
                <div class="flex justify-center mb-4">
                    <x-application-logo type="icon" class="scale-125 shadow-lg shadow-orange-500/20" />
                </div>
                <h2 class="text-3xl font-black text-gray-950 tracking-tight">
                    Créer un compte
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Rejoignez Sessitrading pour gérer vos favoris, suivre vos commandes et commander en toute simplicité.
                </p>
            </div>

            <!-- Form -->
            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Input fields container -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Prénom
                        </label>
                        <input id="first_name" name="first_name" type="text" required 
                            value="{{ old('first_name') }}" autofocus
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('first_name') border-red-500 @enderror"
                            placeholder="Jean">
                        @error('first_name')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Nom
                        </label>
                        <input id="last_name" name="last_name" type="text" required 
                            value="{{ old('last_name') }}"
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('last_name') border-red-500 @enderror"
                            placeholder="Dupont">
                        @error('last_name')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Téléphone
                        </label>
                        <input id="phone_number" name="phone_number" type="tel" required 
                            value="{{ old('phone_number') }}"
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('phone_number') border-red-500 @enderror"
                            placeholder="+229 01 02 03 04">
                        @error('phone_number')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Adresse Email
                        </label>
                        <input id="email" name="email" type="email" required 
                            value="{{ old('email') }}"
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('email') border-red-500 @enderror"
                            placeholder="jean.dupont@exemple.com">
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Adresse de livraison
                        </label>
                        <input id="address" name="address" type="text" required 
                            value="{{ old('address') }}"
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('address') border-red-500 @enderror"
                            placeholder="Rue 145, Avenue de l'indépendance">
                        @error('address')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Ville
                        </label>
                        <input id="city" name="city" type="text" required 
                            value="{{ old('city') }}"
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('city') border-red-500 @enderror"
                            placeholder="Cotonou">
                        @error('city')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Pays
                        </label>
                        <input id="country" name="country" type="text" required 
                            value="{{ old('country') ?? 'Bénin' }}"
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('country') border-red-500 @enderror"
                            placeholder="Bénin">
                        @error('country')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div x-data="{ showPassword: false }">
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Mot de passe
                        </label>
                        <div class="relative">
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required
                                class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-12 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                            <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-3 text-gray-400 hover:text-orange-500 focus:outline-none">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div x-data="{ showConfirmPassword: false }">
                        <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Confirmer le mot de passe
                        </label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" required
                                class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-12 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200"
                                placeholder="••••••••">
                            <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute right-4 top-3 text-gray-400 hover:text-orange-500 focus:outline-none">
                                <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-orange-500/15 hover:shadow-orange-500/25 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Créer mon compte</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <!-- Bottom Registration Link -->
            <div class="text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-500">
                    Déjà inscrit ? 
                    <a href="{{ route('login') }}" class="font-bold text-orange-500 hover:text-orange-600 transition-colors">
                        Se connecter
                    </a>
                </p>
            </div>

        </div>
    </div>
</x-store-layout>
