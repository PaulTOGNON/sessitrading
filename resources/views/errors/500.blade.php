<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erreur serveur - Sessitrading</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col items-center justify-center p-6 antialiased">
    <div class="max-w-md w-full text-center space-y-8 bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 transition-all duration-300">
        <!-- Logo -->
        <div class="flex justify-center">
            <a href="/">
                <x-application-logo type="full" class="h-10" />
            </a>
        </div>
        
        <!-- Error Code Visual -->
        <div class="relative py-4">
            <h1 class="text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-500 tracking-widest select-none">500</h1>
            <div class="absolute inset-0 flex items-center justify-center opacity-10">
                <span class="text-8xl font-bold">Erreur</span>
            </div>
        </div>

        <div class="space-y-3">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Erreur interne du serveur</h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                Une erreur imprévue s'est produite de notre côté. Notre équipe technique a été alertée et s'efforce de résoudre le problème dans les plus brefs délais.
            </p>
        </div>

        <div class="pt-4">
            <a href="/" class="inline-flex w-full items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                Retourner à la boutique
            </a>
        </div>
    </div>
</body>
</html>
