<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Sessitrading - Mode Premium & Traditionnelle' }}</title>

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-900 min-h-screen flex flex-col antialiased" x-data="{ activeTab: 'home', showCart: false, wishlistCount: 3, cartCount: 2 }">

    <!-- TOP HEADER -->
    <header class="sticky top-0 z-50 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-all duration-300">
        
        <!-- Desktop Header Interface -->
        <div class="hidden md:flex max-w-7xl mx-auto px-4 lg:px-8 h-20 items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('store.index') }}" class="flex items-center gap-2 group">
                <span class="w-10 h-10 rounded-xl bg-orange-500 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-orange-500/20 group-hover:scale-105 transition-transform duration-300">S</span>
                <span class="text-2xl font-black tracking-tight text-gray-950 dark:text-white">
                    Sessi<span class="text-orange-500">trading</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <nav class="flex items-center gap-6 text-sm font-semibold text-gray-600 dark:text-gray-300">
                <a href="{{ route('store.index') }}" class="hover:text-orange-500 transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-orange-500">Accueil</a>
                <a href="{{ route('store.shop') }}" class="hover:text-orange-500 transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-orange-500">Boutique</a>
                <a href="{{ route('store.index') }}#categories" class="hover:text-orange-500 transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-orange-500">Catégories</a>
                <a href="{{ route('store.index') }}#popular" class="hover:text-orange-500 transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-orange-500">Populaires</a>
                <a href="{{ route('store.index') }}#promo" class="hover:text-orange-500 transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-orange-500">Promotions</a>
            </nav>

            <!-- Search and Controls -->
            <div class="flex items-center gap-6">
                <!-- Search bar -->
                <form action="#" class="relative w-64">
                    <input type="text" placeholder="Chercher un produit..." class="w-full bg-gray-100 dark:bg-gray-800 text-xs rounded-full pl-10 pr-4 py-2.5 border-transparent focus:border-orange-500 focus:bg-white dark:focus:bg-gray-900 focus:ring-1 focus:ring-orange-500 transition-all duration-300">
                    <span class="absolute left-3.5 top-3 text-gray-400 dark:text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </form>

                <!-- Location Selector (Desktop) -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-1.5 text-xs font-semibold text-gray-700 dark:text-gray-300 hover:text-orange-500 bg-gray-100 dark:bg-gray-800 px-3.5 py-2 rounded-full transition-colors duration-200">
                        <span>📍 Sessitrading (Prêt-à-porter)</span>
                        <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-xl py-2 z-50">
                        <span class="block px-4 py-1 text-[10px] uppercase font-bold tracking-wider text-gray-400">Choisir un point de vente</span>
                        <button class="w-full text-left px-4 py-2.5 text-xs hover:bg-orange-50 hover:text-orange-600 dark:hover:bg-orange-950/30 dark:hover:text-orange-400 font-medium">Sessitrading (Prêt-à-porter)</button>
                        <button class="w-full text-left px-4 py-2.5 text-xs hover:bg-orange-50 hover:text-orange-600 dark:hover:bg-orange-950/30 dark:hover:text-orange-400">Akpakpa Boutique</button>
                        <button class="w-full text-left px-4 py-2.5 text-xs hover:bg-orange-50 hover:text-orange-600 dark:hover:bg-orange-950/30 dark:hover:text-orange-400">Dantokpa Stand A4</button>
                    </div>
                </div>

                <!-- Wishlist -->
                <a href="#" class="relative p-2 text-gray-500 hover:text-orange-500 hover:scale-105 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    <span class="absolute -top-1 -right-1 bg-orange-500 text-white text-[10px] w-4.5 h-4.5 rounded-full flex items-center justify-center font-bold" x-text="wishlistCount"></span>
                </a>

                <!-- Cart -->
                <button @click="showCart = !showCart" class="relative p-2 text-gray-500 hover:text-orange-500 hover:scale-105 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="absolute -top-1 -right-1 bg-orange-500 text-white text-[10px] w-4.5 h-4.5 rounded-full flex items-center justify-center font-bold" x-text="cartCount"></span>
                </button>

                <!-- Profile / Auth Links -->
                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 p-1 px-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-full transition-colors">
                        <span class="w-6 h-6 rounded-full bg-orange-500 text-white flex items-center justify-center text-xs font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold text-gray-700 dark:text-gray-350 hover:text-orange-500 transition-colors">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-orange-500 text-white text-xs font-bold px-4 py-2 rounded-full hover:bg-orange-600 transition-colors shadow-md shadow-orange-500/10">S'inscrire</a>
                @endauth
            </div>
        </div>

        <!-- Mobile Header Interface (Matching mockups) -->
        <div class="md:hidden flex flex-col px-4 pt-3.5 pb-3.5 gap-3.5 bg-white dark:bg-gray-900">
            <!-- Top bar -->
            <div class="flex items-center justify-between">
                <!-- Circular Icon with m/s and location text -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-black text-lg shadow-md shadow-orange-500/20">S</div>
                    <div class="flex flex-col">
                        <span class="text-[10px] text-gray-400 dark:text-gray-500 font-bold uppercase tracking-wider leading-none">Explorer</span>
                        <!-- Location Dropdown Mobile -->
                        <div x-data="{ open: false }" class="relative mt-0.5">
                            <button @click="open = !open" class="flex items-center gap-1 text-sm font-bold text-gray-950 dark:text-white focus:outline-none">
                                <span>Sessitrading (Prêt-à-porter)</span>
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute left-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-2xl shadow-xl py-2 z-50">
                                <button class="w-full text-left px-4 py-2.5 text-xs hover:bg-orange-50 dark:hover:bg-orange-950/30 text-orange-500 font-bold">Sessitrading (Prêt-à-porter)</button>
                                <button class="w-full text-left px-4 py-2.5 text-xs hover:bg-orange-50 dark:hover:bg-orange-950/30">Akpakpa Boutique</button>
                                <button class="w-full text-left px-4 py-2.5 text-xs hover:bg-orange-50 dark:hover:bg-orange-950/30">Dantokpa Stand A4</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Marker Icon -->
                <button class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </button>
            </div>

            <!-- Search and Wishlist Row -->
            <div class="flex items-center gap-3">
                <div class="relative flex-grow">
                    <input type="text" placeholder="Chercher un produit" class="w-full bg-gray-100 dark:bg-gray-800 text-sm rounded-full pl-11 pr-11 py-2.5 border-transparent focus:border-orange-500 focus:bg-white dark:focus:bg-gray-900 focus:ring-1 focus:ring-orange-500 transition-all duration-300">
                    <span class="absolute left-4 top-3 text-gray-400 dark:text-gray-500">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <button class="absolute right-4 top-3 text-gray-400 dark:text-gray-500 hover:text-orange-500">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                    </button>
                </div>

                <!-- Heart Icon (Wishlist) matching mockup yellow heart -->
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-100 dark:border-gray-800 hover:bg-orange-50 dark:hover:bg-orange-950/20 text-orange-500">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN BODY -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 pt-16 pb-28 md:pb-12 border-t border-gray-150 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Brand Info -->
            <div class="flex flex-col gap-4">
                <a href="{{ route('store.index') }}" class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-orange-500 flex items-center justify-center text-white font-black text-base">S</span>
                    <span class="text-xl font-bold tracking-tight text-gray-950 dark:text-white">
                        Sessi<span class="text-orange-500">trading</span>
                    </span>
                </a>
                <p class="text-xs leading-relaxed text-gray-500">
                    Sessitrading vous propose les meilleures sélections de vêtements originaux et de qualité premium, neufs et importés. De la mode traditionnelle aux baskets tendance.
                </p>
                <div class="flex items-center gap-3 mt-2 text-gray-450">
                    <a href="#" class="hover:text-orange-500"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg></a>
                    <a href="#" class="hover:text-orange-500"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                </div>
            </div>

            <!-- Categories -->
            <div class="flex flex-col gap-4">
                <h4 class="text-sm font-bold text-gray-955 dark:text-white uppercase tracking-wider">Catégories</h4>
                <div class="flex flex-col gap-2 text-xs">
                    <a href="{{ route('store.shop') }}" class="hover:text-orange-500 transition-colors">Boubous Traditionnels</a>
                    <a href="{{ route('store.shop') }}" class="hover:text-orange-500 transition-colors">Robes Élégantes</a>
                    <a href="{{ route('store.shop') }}" class="hover:text-orange-500 transition-colors">Ensembles Estivaux</a>
                    <a href="{{ route('store.shop') }}" class="hover:text-orange-500 transition-colors">Gilets & Vestes</a>
                    <a href="{{ route('store.shop') }}" class="hover:text-orange-500 transition-colors">Baskets & Sneakers</a>
                </div>
            </div>

            <!-- Links -->
            <div class="flex flex-col gap-4">
                <h4 class="text-sm font-bold text-gray-955 dark:text-white uppercase tracking-wider">Aide & Contact</h4>
                <div class="flex flex-col gap-2 text-xs">
                    <p class="leading-relaxed">📍 Boutique Sessitrading, Cotonou, Bénin</p>
                    <p class="leading-relaxed">📞 +229 90 00 00 00</p>
                    <p class="leading-relaxed">✉️ contact@sessitrading.com</p>
                    <a href="#" class="hover:text-orange-500 transition-colors mt-2">Politique de retour</a>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="flex flex-col gap-4">
                <h4 class="text-sm font-bold text-gray-955 dark:text-white uppercase tracking-wider">Newsletter</h4>
                <p class="text-xs leading-relaxed text-gray-500">
                    Abonnez-vous pour recevoir les nouveautés et les promotions exclusives de Sessitrading.
                </p>
                <form action="#" class="flex gap-2">
                    <input type="email" placeholder="Votre email" class="bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-xs px-3.5 py-2.5 w-full focus:ring-1 focus:ring-orange-500 text-gray-900 dark:text-white">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-colors shadow-lg shadow-orange-500/10">OK</button>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 lg:px-8 border-t border-gray-150 dark:border-gray-800 mt-12 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-gray-600">
            <p>&copy; 2026 Sessitrading. Tous droits réservés.</p>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-orange-500">Mentions légales</a>
                <a href="#" class="hover:text-orange-500">CGV</a>
                <a href="#" class="hover:text-orange-500">Données privées</a>
            </div>
        </div>
    </footer>

    <!-- MOBILE FLOATING NAVIGATION BAR (Glassmorphism & Blurry background matching mockup) -->
    <nav class="md:hidden fixed bottom-6 left-4 right-4 z-50 h-16 rounded-2xl bg-white/75 dark:bg-gray-900/75 border border-white/20 dark:border-gray-800/20 shadow-2xl backdrop-blur-xl flex items-center justify-around px-4">
        
        <!-- Home Tab -->
        <a href="{{ route('store.index') }}" @click="activeTab = 'home'" class="flex flex-col items-center justify-center gap-1 group w-12 h-12 transition-transform duration-200">
            <span class="p-1.5 rounded-full transition-all duration-300" :class="activeTab === 'home' ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20' : 'text-gray-400 dark:text-gray-500 group-hover:text-orange-500'">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            </span>
            <span class="text-[9px] font-bold tracking-tight" :class="activeTab === 'home' ? 'text-orange-500' : 'text-gray-400 dark:text-gray-500'">Home</span>
        </a>

        <!-- Categories Tab -->
        <a href="#categories" @click="activeTab = 'category'" class="flex flex-col items-center justify-center gap-1 group w-12 h-12 transition-transform duration-200">
            <span class="p-1.5 rounded-full transition-all duration-300" :class="activeTab === 'category' ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20' : 'text-gray-400 dark:text-gray-500 group-hover:text-orange-500'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </span>
            <span class="text-[9px] font-bold tracking-tight" :class="activeTab === 'category' ? 'text-orange-500' : 'text-gray-400 dark:text-gray-500'">Catégorie</span>
        </a>

        <!-- Search Tab -->
        <a href="{{ route('store.shop') }}" @click="activeTab = 'articles'" class="flex flex-col items-center justify-center gap-1 group w-12 h-12 transition-transform duration-200">
            <span class="p-1.5 rounded-full transition-all duration-300" :class="activeTab === 'articles' ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20' : 'text-gray-400 dark:text-gray-500 group-hover:text-orange-500'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <span class="text-[9px] font-bold tracking-tight" :class="activeTab === 'articles' ? 'text-orange-500' : 'text-gray-400 dark:text-gray-500'">Articles</span>
        </a>

        <!-- Cart Tab -->
        <a href="#" @click="activeTab = 'panier'; showCart = true" class="flex flex-col items-center justify-center gap-1 group w-12 h-12 transition-transform duration-200 relative">
            <span class="p-1.5 rounded-full transition-all duration-300" :class="activeTab === 'panier' ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20' : 'text-gray-400 dark:text-gray-500 group-hover:text-orange-500'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </span>
            <span class="text-[9px] font-bold tracking-tight" :class="activeTab === 'panier' ? 'text-orange-500' : 'text-gray-400 dark:text-gray-500'">Panier</span>
            <span class="absolute top-0 right-1.5 bg-orange-500 text-white text-[8px] w-4 h-4 rounded-full flex items-center justify-center font-bold" x-text="cartCount"></span>
        </a>

        <!-- Profile Tab -->
        <a href="{{ route('login') }}" @click="activeTab = 'utilisateur'" class="flex flex-col items-center justify-center gap-1 group w-12 h-12 transition-transform duration-200">
            <span class="p-1.5 rounded-full transition-all duration-300" :class="activeTab === 'utilisateur' ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20' : 'text-gray-400 dark:text-gray-500 group-hover:text-orange-500'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </span>
            <span class="text-[9px] font-bold tracking-tight" :class="activeTab === 'utilisateur' ? 'text-orange-500' : 'text-gray-400 dark:text-gray-500'">Utilisateur</span>
        </a>
    </nav>

    <!-- SHOPPING CART SLIDEOUT PANEL (ALPINE.JS CONTROLLER) -->
    <div x-show="showCart" class="fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Background Overlay -->
            <div x-show="showCart" x-transition:enter="ease-in-out duration-350" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="showCart = false" class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div x-show="showCart" x-transition:enter="transform transition ease-in-out duration-350 sm:duration-500" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-350 sm:duration-500" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col bg-white dark:bg-gray-900 shadow-2xl">
                        <div class="flex-1 overflow-y-auto px-6 py-6">
                            <div class="flex items-start justify-between border-b border-gray-100 dark:border-gray-800 pb-4">
                                <h2 class="text-lg font-extrabold text-gray-900 dark:text-white" id="slide-over-title">Mon Panier</h2>
                                <button @click="showCart = false" class="text-gray-400 hover:text-gray-500 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-850">
                                    <span class="sr-only">Fermer</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>

                            <div class="mt-8">
                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-gray-100 dark:divide-gray-800">
                                        <!-- Item 1 -->
                                        <li class="flex py-6">
                                            <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-gray-100 dark:border-gray-800 bg-gray-100">
                                                <img src="/images/products/product1.jpeg" alt="Boubou oversized" class="h-full w-full object-cover object-center">
                                            </div>
                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                    <div class="flex justify-between text-sm font-bold text-gray-900 dark:text-white">
                                                        <h3><a href="#">Boubou oversized</a></h3>
                                                        <p class="ml-4 text-orange-500">15 000 F</p>
                                                    </div>
                                                    <p class="mt-1 text-xs text-gray-400">Catégorie: Boubous</p>
                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-xs">
                                                    <p class="text-gray-400">Quantité: 1</p>
                                                    <button type="button" class="font-semibold text-red-500 hover:text-red-600">Supprimer</button>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Item 2 -->
                                        <li class="flex py-6">
                                            <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-gray-100 dark:border-gray-800 bg-gray-100">
                                                <img src="/images/products/product3.jpeg" alt="Chemise chic" class="h-full w-full object-cover object-center">
                                            </div>
                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                    <div class="flex justify-between text-sm font-bold text-gray-900 dark:text-white">
                                                        <h3><a href="#">Chemise chic</a></h3>
                                                        <p class="ml-4 text-orange-500">12 000 F</p>
                                                    </div>
                                                    <p class="mt-1 text-xs text-gray-400">Catégorie: Chemises</p>
                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-xs">
                                                    <p class="text-gray-400">Quantité: 1</p>
                                                    <button type="button" class="font-semibold text-red-500 hover:text-red-600">Supprimer</button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Cart Section -->
                        <div class="border-t border-gray-100 dark:border-gray-800 px-6 py-6 bg-gray-50/50 dark:bg-gray-900/30">
                            <div class="flex justify-between text-base font-bold text-gray-900 dark:text-white">
                                <p>Sous-total</p>
                                <p class="text-orange-500">27 000 F</p>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">Frais de livraison calculés lors de la commande.</p>
                            <div class="mt-6">
                                <a href="#" class="flex items-center justify-center rounded-xl border border-transparent bg-orange-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-orange-500/20 hover:bg-orange-600 transition-colors">Passer la commande</a>
                            </div>
                            <div class="mt-4 flex justify-center text-center text-xs text-gray-400">
                                <p>
                                    ou
                                    <button type="button" class="font-semibold text-orange-500 hover:text-orange-600 ml-1" @click="showCart = false">
                                        Continuer mes achats
                                        <span aria-hidden="true"> &rarr;</span>
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
