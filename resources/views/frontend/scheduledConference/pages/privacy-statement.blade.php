<x-tempest::layouts.main>
    <main class="min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-6xl space-y-6">
            <!-- Breadcrumbs -->
            <nav class="bg-white rounded-lg shadow-sm">
                <div class="mb-8">
                <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
                </div>
            </nav>

            <!-- Page Header -->
            <header class="bg-white rounded-xl p-6 shadow-sm drop-shadow-2xl border border-gray-100">
                <div class="flex items-center gap-6">
                    <div class="flex-shrink-0">
                        <div class="p-2 bg-primary-50 rounded-xl">
                            <svg 
                                class="w-7 h-7 text-primary-600" 
                                viewBox="0 0 24 26" 
                                fill="none" 
                                stroke="currentColor"
                            >
                                <!-- Shield Base -->
                                <path 
                                    d="M12 3L4 7.5v5.5a11 11 0 0 0 8 10.5 11 11 0 0 0 8-10.5V7.5L12 3z" 
                                    stroke-width="2" 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round"
                                />
                                
                                <!-- Lock Body -->
                                <rect 
                                    x="9" 
                                    y="11" 
                                    width="6" 
                                    height="5" 
                                    rx="1" 
                                    stroke-width="2"
                                />
                                
                                <!-- Lock Loop -->
                                <path 
                                    d="M10 11V9a2 2 0 0 1 4 0v2" 
                                    stroke-width="2" 
                                    stroke-linecap="round"
                                />
                                
                                <!-- Keyhole -->
                                <circle 
                                    cx="12" 
                                    cy="13.5" 
                                    r="0.75" 
                                    fill="currentColor"
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

            <!-- Content -->
            <section class="bg-white rounded-xl shadow-sm drop-shadow-2xl border border-gray-100 overflow-hidden">
                <div class="p-8 md:p-10">
                    <div class="user-content prose prose-lg max-w-none prose-headings:font-semibold prose-p:text-gray-600 prose-a:text-primary-600 prose-a:no-underline hover:prose-a:underline">
                        {{ new Illuminate\Support\HtmlString($privacyStatement) }}
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-tempest::layouts.main>