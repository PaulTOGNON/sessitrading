@props([
    'type' => 'full', // 'full', 'icon', 'admin'
    'class' => ''
])

@if($type === 'icon')
    <!-- Icon Only Version -->
    <div {{ $attributes->merge(['class' => 'flex items-center justify-center']) }}>
        <svg class="w-10 h-10" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="logo-grad-icon" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#FF7E40" />
                    <stop offset="100%" stop-color="#F97316" />
                </linearGradient>
            </defs>
            <rect width="40" height="40" rx="12" fill="url(#logo-grad-icon)" />
            <!-- Hanger + S stylized curve in white -->
            <path d="M20 9C21.6569 9 23 10.3431 23 12C23 13.25 22.25 14.25 21.25 14.75L27 21C28.5 22.5 29 24.5 28 26.5C27 28.5 25 29.5 23 29.5H17C15 29.5 13 28.5 12 26.5C11 24.5 11.5 22.5 13 21L18.75 14.75C17.75 14.25 17 13.25 17 12C17 10.3431 18.3431 9 20 9Z" fill="white" />
            <path d="M16 25C18 23 22 23 24 25" stroke="#F97316" stroke-width="2" stroke-linecap="round" />
        </svg>
    </div>
@else
    <!-- Full Logo (Icon + Text) -->
    <div {{ $attributes->merge(['class' => 'flex items-center gap-2.5 group']) }}>
        <!-- Icon -->
        <svg class="w-10 h-10 transition-transform duration-300 group-hover:scale-105" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                @if($type === 'admin')
                    <linearGradient id="logo-grad-admin" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#FF7E40" />
                        <stop offset="100%" stop-color="#F97316" />
                    </linearGradient>
                @else
                    <linearGradient id="logo-grad-full" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#FF7E40" />
                        <stop offset="100%" stop-color="#F97316" />
                    </linearGradient>
                @endif
            </defs>
            <rect width="40" height="40" rx="12" fill="url(#{{ $type === 'admin' ? 'logo-grad-admin' : 'logo-grad-full' }})" />
            <!-- Hanger + S stylized curve in white -->
            <path d="M20 9C21.6569 9 23 10.3431 23 12C23 13.25 22.25 14.25 21.25 14.75L27 21C28.5 22.5 29 24.5 28 26.5C27 28.5 25 29.5 23 29.5H17C15 29.5 13 28.5 12 26.5C11 24.5 11.5 22.5 13 21L18.75 14.75C17.75 14.25 17 13.25 17 12C17 10.3431 18.3431 9 20 9Z" fill="white" />
            <path d="M16 25C18 23 22 23 24 25" stroke="#F97316" stroke-width="2" stroke-linecap="round" />
        </svg>
        <!-- Text -->
        <span class="text-2xl font-black tracking-tight text-gray-950 dark:text-white">
            Sessi<span class="text-orange-500">@if($type === 'admin')admin @elsetrading @endif</span>
        </span>
    </div>
@endif
