<x-store-layout>
    <x-slot name="title">Vérification de l'email - Sessitrading</x-slot>

    <!-- Main Container -->
    <div class="min-h-[70vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-gray-100 transition-all duration-300 hover:shadow-2xl">
            
            <!-- Header Section -->
            <div class="text-center">
                <!-- Logo -->
                <div class="flex justify-center mb-4">
                    <x-application-logo type="icon" class="scale-125 shadow-lg shadow-orange-500/20" />
                </div>
                <h2 class="text-3xl font-black text-gray-950 tracking-tight">
                    Vérification
                </h2>
                <p class="mt-2 text-sm text-gray-500">
                    Merci pour votre inscription ! Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.
                </p>
            </div>

            <!-- Status Alert -->
            @if (session('status') == 'verification-link-sent')
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-xl text-sm" role="alert">
                    Un nouveau lien de vérification a été envoyé à l'adresse email fournie lors de l'inscription.
                </div>
            @endif

            <!-- Form Actions -->
            <div class="space-y-4 pt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-orange-500/15 hover:shadow-orange-500/25 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Renvoyer l'email de vérification</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-gray-500 hover:text-orange-500 transition-colors underline focus:outline-none">
                        Se déconnecter
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-store-layout>
