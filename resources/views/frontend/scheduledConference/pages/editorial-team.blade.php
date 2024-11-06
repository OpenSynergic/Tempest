<x-website::layouts.main>
    <main class="min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-6xl space-y-6">
            <nav class="bg-white rounded-lg shadow-sm">
                <div class="mb-8">
                    <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
                </div>
            </nav>
        <header class="bg-white rounded-xl p-6 shadow-sm drop-shadow-2xl border border-gray-100">
            <div class="flex items-center gap-6">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-primary-50 rounded-xl">
                        <svg 
    viewBox="0 0 24 24" 
    fill="none" 
    stroke="currentColor" 
    class="w-7 h-7 text-primary-600"
>
    <!-- Center Person (Slightly Larger) -->
    <path 
        d="M12 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM12 11c-2.5 0-4.5 1.8-4.5 4v3h9v-3c0-2.2-2-4-4.5-4z"
        stroke-width="1.5"
        stroke-linecap="round"
        stroke-linejoin="round"
    />
    
    <!-- Left Person -->
    <path 
        d="M6.5 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM4 17v-3c0-1.8 1.5-3.3 3.5-3.8"
        stroke-width="1.5"
        stroke-linecap="round"
        stroke-linejoin="round"
    />
    
    <!-- Right Person -->
    <path 
        d="M17.5 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM20 17v-3c0-1.8-1.5-3.3-3.5-3.8"
        stroke-width="1.5"
        stroke-linecap="round"
        stroke-linejoin="round"
    />
    
    <!-- Document/Paper Elements -->
    <path 
        d="M12 15.5v2M9 18h6"
        stroke-width="1.5"
        stroke-linecap="round"
    />
</svg>
                    </div>
        
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                        {{ $this->getTitle() }}
                    </h1>
                </div>
            </div>
        </header>
        @if ($editorialTeam)
        <div class="bg-white rounded-xl shadow-sm drop-shadow-2xl border border-gray-100 overflow-hidden">
            <div class="p-8">
                <div class="user-content prose prose-lg max-w-none">
                {{ new Illuminate\Support\HtmlString($editorialTeam) }}
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
