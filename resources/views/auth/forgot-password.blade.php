<x-store-layout>
    <x-slot name="title">Mot de passe oublié - Sessitrading</x-slot>

    <!-- Main Container -->
    <div class="min-h-[70vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
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
                    Mot de passe oublié
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Saisissez votre adresse email et nous vous enverrons un lien de réinitialisation.
                </p>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-xl text-sm" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Adresse Email
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                        value="{{ old('email') }}" autofocus
                        class="w-full bg-gray-50 text-sm rounded-xl pl-4 pr-4 py-3 border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all duration-200 @error('email') border-red-500 @enderror"
                        placeholder="votre.email@exemple.com">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-orange-500/15 hover:shadow-orange-500/25 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Envoyer le lien</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <!-- Bottom Login Link -->
            <div class="text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-500">
                    Retour à la 
                    <a href="{{ route('login') }}" class="font-bold text-orange-500 hover:text-orange-600 transition-colors">
                        Connexion
                    </a>
                </p>
            </div>

        </div>
    </div>
</x-store-layout>
