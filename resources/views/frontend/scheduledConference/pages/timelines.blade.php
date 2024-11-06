<x-website::layouts.main>
    <main class="min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-6xl space-y-6">
            <nav class="bg-white rounded-lg shadow-sm">
                <div class="mb-8">
                    <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
                </div>
            </nav>
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="relative mb-8">
            <div class="flex items-center space-x-4 bg-white rounded-xl p-6 shadow-sm drop-shadow-2xl border border-gray-100">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-primary-50 rounded-lg">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">Event Timelines</h1>
                </div>
            </div>
        </div>
        @if($timelines->isNotEmpty())
        <div class="bg-white rounded-xl shadow-sm drop-shadow-2xl border border-gray-100 overflow-hidden">
            <div class="p-12">
                <div class="user-content prose prose-lg max-w-none">
        <ol class="relative border-s border-gray-200">
            @foreach ($timelines as $timeline)
            <li class="relative mb-16 ms-6 last:mb-0 group perspective-1000">
                {{-- Enhanced Timeline Connection --}}
                <div class="absolute -start-3 mt-2 flex items-center justify-center">
                    {{-- Animated Core Dot --}}
                    <div class="relative w-6 h-6 flex items-center justify-center">
                        <div class="absolute w-6 h-6 bg-primary-500/20 rounded-full animate-pulse"></div>
                        <div class="absolute w-4 h-4 bg-primary-400/40 rounded-full animate-ping"></div>
                        <div class="w-3 h-3 bg-primary-500 rounded-full border-2 border-white dark:border-gray-900 z-10
                            shadow-lg group-hover:scale-150 transition-all duration-500 ease-out"></div>
                    </div>
                    
                    {{-- Enhanced Vertical Line --}}
                    <div class="absolute h-full w-[2px] -bottom-16 -z-10">
                        <div class="h-full w-full bg-gradient-to-b from-primary-500 via-primary-400/50 to-transparent
                            group-hover:from-primary-400 group-hover:via-primary-500 transition-colors duration-500"></div>
                        <div class="absolute top-0 h-full w-full bg-gradient-to-b from-primary-500/50 to-transparent
                            animate-pulse"></div>
                    </div>
                </div>
            
                {{-- Main Content Card with Advanced Effects --}}
                <div class="relative ml-4 group-hover:translate-x-2 transition-transform duration-500 ease-out">
                    {{-- Glowing Border Effect --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500/20 via-primary-400/20 to-transparent
                        rounded-lg blur-xl opacity-0 group-hover:opacity-70 transition-opacity duration-500"></div>
                        
                    {{-- Content Container --}}
                    <div class="relative p-6 bg-white dark:bg-gray-800/95 rounded-lg border border-gray-100/50 
                        dark:border-gray-700/50 backdrop-blur-sm shadow-lg overflow-hidden
                        hover:shadow-primary-500/10 transition-all duration-500">
                        
                        {{-- Decorative Corner Elements --}}
                        <div class="absolute top-0 left-0 w-2 h-2 border-t-2 border-l-2 border-primary-500/30"></div>
                        <div class="absolute top-0 right-0 w-2 h-2 border-t-2 border-r-2 border-primary-500/30"></div>
                        <div class="absolute bottom-0 left-0 w-2 h-2 border-b-2 border-l-2 border-primary-500/30"></div>
                        <div class="absolute bottom-0 right-0 w-2 h-2 border-b-2 border-r-2 border-primary-500/30"></div>
            
                        {{-- Enhanced Date Badge --}}
                        <div class="flex items-center gap-3 mb-4">
                            <time class="px-4 py-1.5 text-sm font-medium text-primary-600 dark:text-primary-400
                                bg-primary-50 dark:bg-primary-900/30 rounded-full border border-primary-100 dark:border-primary-800
                                shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4 opacity-70" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $timeline->date->format(Setting::get('format_date')) }}
                            </time>
                            <div class="flex-grow h-[1px] bg-gradient-to-r from-primary-500/50 to-transparent"></div>
                        </div>
            
                        {{-- Enhanced Title Section --}}
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center gap-2
                                group-hover:text-primary-500 transition-colors duration-300">
                                {{ $timeline->name }}
                                <div class="h-px flex-grow bg-gradient-to-r from-primary-500/50 to-transparent"></div>
                            </h3>
                        </div>
            
                        {{-- Description with Better Typography --}}
                        <div class="relative">
                            <p class="text-base text-gray-600 dark:text-gray-300 leading-relaxed
                                group-hover:text-gray-700 dark:group-hover:text-gray-200 transition-colors duration-300">
                                {{ $timeline->description }}
                            </p>
                            
                            {{-- Subtle Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-white/20 
                                dark:to-gray-800/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
            
                        {{-- Enhanced Interactive Elements --}}
                        <div class="mt-6 flex items-center justify-between
                            opacity-0 transform translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 
                            transition-all duration-500 ease-out">
                            
                            {{-- Right Side Info --}}
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $timeline->date->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ol>
                    </div>
                </div>
            </div>
        @else
        <div class="bg-white rounded-xl shadow-sm drop-shadow-2xl border border-gray-100 p-8 text-center">
            <div class="max-w-md mx-auto">
                <div class="flex justify-center mb-4">
                    <div class="p-3 bg-gray-100 rounded-full">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    {{ __('general.no_content_provided') }}
                </h3>
                <p class="text-gray-500 text-sm">
                    {{ __('general.check_back_later') }}
                </p>
            </div>
        </div>
        @endif
    </div>
</x-website::layouts.main>
