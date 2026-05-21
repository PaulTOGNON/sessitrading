<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Administration - Sessitrading' }}</title>

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
<body class="h-full text-gray-900 antialiased" x-data="{ mobileSidebarOpen: false }">

    <div class="min-h-full flex flex-col md:flex-row">
        <!-- Desktop Sidebar -->
        <aside class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-white border-r border-gray-200">
            <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                <!-- Brand logo -->
                <div class="flex items-center flex-shrink-0 px-6">
                    <x-application-logo type="admin" />
                </div>
                
                <!-- Navigation -->
                <nav class="mt-8 flex-1 px-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ Request::routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ Request::routeIs('admin.dashboard') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                        </svg>
                        Vue d'ensemble
                    </a>

                    <a href="{{ route('admin.products') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ Request::routeIs('admin.products*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ Request::routeIs('admin.products*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Produits
                    </a>

                    <a href="{{ route('admin.orders') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ Request::routeIs('admin.orders*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ Request::routeIs('admin.orders*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Commandes
                    </a>

                    <a href="{{ route('admin.users') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ Request::routeIs('admin.users*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ Request::routeIs('admin.users*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Clients
                    </a>

                    <a href="{{ route('admin.analytics') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ Request::routeIs('admin.analytics*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ Request::routeIs('admin.analytics*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2zm9 0h-2a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-6a2 2 0 00-2-2z"></path>
                        </svg>
                        Analyses & Rapports
                    </a>

                    <a href="{{ route('admin.payment-settings.index') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ Request::routeIs('admin.payment-settings*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ Request::routeIs('admin.payment-settings*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Paiements
                    </a>

                    <a href="{{ route('admin.transactions.index') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-150 {{ Request::routeIs('admin.transactions*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ Request::routeIs('admin.transactions*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Transactions
                    </a>
                </nav>

                <!-- Footer Sidebar -->
                <div class="px-4 mt-auto space-y-1">
                    <a href="{{ route('store.index') }}" class="group flex items-center px-3 py-2 text-sm font-semibold rounded-lg text-gray-500 hover:bg-gray-50 hover:text-gray-900">
                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour Boutique
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left group flex items-center px-3 py-2 text-sm font-semibold rounded-lg text-red-600 hover:bg-red-50">
                            <svg class="mr-3 h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile Sidebar Overlay & Sidebar -->
        <div x-show="mobileSidebarOpen" class="relative z-50 md:hidden" x-description="Off-canvas menu for mobile" role="dialog" aria-modal="true" style="display: none;">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity" @click="mobileSidebarOpen = false"></div>
            <div class="fixed inset-0 flex z-40">
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white pt-5 pb-4">
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button type="button" @click="mobileSidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center flex-shrink-0 px-6">
                        <x-application-logo type="admin" />
                    </div>

                    <nav class="mt-8 flex-1 px-4 space-y-1 overflow-y-auto">
                        <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg {{ Request::routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50' }}">Vue d'ensemble</a>
                        <a href="{{ route('admin.products') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg {{ Request::routeIs('admin.products*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600' }}">Produits</a>
                        <a href="{{ route('admin.orders') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg {{ Request::routeIs('admin.orders*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600' }}">Commandes</a>
                        <a href="{{ route('admin.users') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg {{ Request::routeIs('admin.users*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600' }}">Clients</a>
                        <a href="{{ route('admin.analytics') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg {{ Request::routeIs('admin.analytics*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600' }}">Analyses</a>
                        <a href="{{ route('admin.payment-settings.index') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg {{ Request::routeIs('admin.payment-settings*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600' }}">Paiements</a>
                        <a href="{{ route('admin.transactions.index') }}" class="group flex items-center px-3 py-2.5 text-sm font-semibold rounded-lg {{ Request::routeIs('admin.transactions*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600' }}">Transactions</a>
                        
                        <hr class="my-4 border-gray-200">
                        <a href="{{ route('store.index') }}" class="group flex items-center px-3 py-2 text-sm font-semibold rounded-lg text-gray-500">Retour Boutique</a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left group flex items-center px-3 py-2 text-sm font-semibold rounded-lg text-red-600">Déconnexion</button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 md:pl-64 flex flex-col min-h-screen">
            <!-- Mobile Header bar -->
            <header class="relative flex items-center justify-between md:hidden bg-white border-b border-gray-200 px-4 py-3">
                <button type="button" @click="mobileSidebarOpen = true" class="text-gray-500 focus:outline-none z-10">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="pointer-events-auto">
                        <x-application-logo type="admin" />
                    </div>
                </div>
                <div class="w-6 z-10"></div> <!-- spacer -->
            </header>

            <!-- Inner Page Content -->
            <main class="flex-grow p-4 md:p-8">
                <!-- Notification Banner -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 flex items-center gap-3 animate-fade-in shadow-sm">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-800 flex items-center gap-3 animate-fade-in shadow-sm">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-800 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <h4 class="text-sm font-semibold">Une ou plusieurs erreurs sont survenues :</h4>
                        </div>
                        <ul class="list-disc pl-8 space-y-1 text-xs font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Yield page contents -->
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
