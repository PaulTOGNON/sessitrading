<x-store-layout>
    <x-slot name="title">Réinitialisation du mot de passe - Sessitrading</x-slot>

    <!-- Main Container -->
    <div class="min-h-[75vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-gray-100 transition-all duration-300 hover:shadow-2xl">
            
            <!-- Header Section -->
            <div class="text-center">
                <!-- Logo -->
                <div class="flex justify-center mb-4">
                    <span class="w-14 h-14 rounded-2xl bg-orange-500 flex items-center justify-center text-white font-black text-2xl shadow-lg shadow-orange-500/20">
                        S
                    </span>
                </div>
                <h2 class="text-3xl font-black text-gray-950 tracking-tight">
                    Nouveau mot de passe
                </h2>
                <p class="mt-2 text-sm text-gray-500">
                    Définissez votre nouveau mot de passe sécurisé pour Sessitrading.
                </p>
            </div>

            <!-- Form -->
            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Input fields container -->
                <div class="space-y-4">
                    
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Adresse Email
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            value="{{ old('email', $request->email) }}" autofocus
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Nouveau mot de passe
                        </label>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Confirmer le mot de passe
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                            class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200"
                            placeholder="••••••••">
                        @error('password_confirmation')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-orange-500/15 hover:shadow-orange-500/25 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Réinitialiser le mot de passe</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-store-layout>
