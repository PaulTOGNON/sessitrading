@props([
    'type' => 'full', // 'full', 'icon', 'admin'
    'class' => ''
])

@php
    // Sizing classes for responsiveness: w-7/text-base below 375px, w-8/text-lg from 375px, scaling up on sm/md
    $iconSizeClass = 'w-7 h-7 min-[375px]:w-8 min-[375px]:h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-lg md:rounded-xl';
    $textSizeClass = 'text-base min-[375px]:text-lg sm:text-xl md:text-2xl';
@endphp

@if($type === 'icon')
    <!-- Icon Only Version -->
    <div {{ $attributes->merge(['class' => 'flex items-center justify-center flex-shrink-0 ' . $iconSizeClass . ' shadow-sm']) }} style="background: linear-gradient(135deg, #FF7E40 0%, #F97316 100%);">
        <svg class="w-full h-full flex-shrink-0" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Hanger + S stylized curve in white -->
            <path d="M20 9C21.6569 9 23 10.3431 23 12C23 13.25 22.25 14.75 21.25 14.75L27 21C28.5 22.5 29 24.5 28 26.5C27 28.5 25 29.5 23 29.5H17C15 29.5 13 28.5 12 26.5C11 24.5 11.5 22.5 13 21L18.75 14.75C17.75 14.25 17 13.25 17 12C17 10.3431 18.3431 9 20 9Z" fill="white" />
            <path d="M16 25C18 23 22 23 24 25" stroke="#F97316" stroke-width="2" stroke-linecap="round" />
        </svg>
    </div>
@else
    <!-- Full Logo (Icon + Text) -->
    <div {{ $attributes->merge(['class' => 'flex items-center gap-2 md:gap-2.5 flex-shrink-0 group']) }}>
        <!-- Icon -->
        <div class="{{ $iconSizeClass }} flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-105 shadow-sm" style="background: linear-gradient(135deg, #FF7E40 0%, #F97316 100%);">
            <svg class="w-full h-full flex-shrink-0" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Hanger + S stylized curve in white -->
                <path d="M20 9C21.6569 9 23 10.3431 23 12C23 13.25 22.25 14.25 21.25 14.75L27 21C28.5 22.5 29 24.5 28 26.5C27 28.5 25 29.5 23 29.5H17C15 29.5 13 28.5 12 26.5C11 24.5 11.5 22.5 13 21L18.75 14.75C17.75 14.25 17 13.25 17 12C17 10.3431 18.3431 9 20 9Z" fill="white" />
                <path d="M16 25C18 23 22 23 24 25" stroke="#F97316" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>
        <!-- Text -->
        <span class="{{ $textSizeClass }} font-black tracking-tight text-gray-950 dark:text-white whitespace-nowrap">
            Sessi<span class="text-orange-500">@if($type === 'admin')admin@else<span>trading</span>@endif</span>
        </span>
    </div>
@endif


