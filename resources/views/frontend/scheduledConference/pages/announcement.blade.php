<x-tempest::layouts.main>
    <div class="min-h-screen">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Enhanced Breadcrumbs -->
            <div class="mb-8">
                <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
            </div>

            <div class="space-y-8">
                <!-- Enhanced Header Card -->
                <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl p-10 border border-gray-100/50 hover:shadow-2xl transition-all duration-300">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                        <div class="space-y-6 flex-1">
                            <div class="flex flex-wrap items-center gap-4">
                                <span class="px-4 py-1.5 text-sm font-semibold text-blue-600 bg-blue-50 rounded-full ring-1 ring-blue-100">
                                    Announcement
                                </span>
                                <div class="flex items-center space-x-2 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm font-medium">
                                        {{ $announcement->created_at->format(Setting::get('format_date')) }}
                                    </span>
                                </div>
                            </div>
                            <h1 class="text-4xl md:text-5xl xl:text-5xl font-black text-gray-900 leading-tight">
                                {{ $announcement->title }}
                            </h1>
                            <!-- Optional subtitle or description if available -->
                            @if($announcement->description)
                            <p class="text-lg text-gray-600 leading-relaxed max-w-3xl">
                                {{ $announcement->description }}
                            </p>
                            @endif
                        </div>
                        
                        <!-- Enhanced Icon Container -->
                        <div class="hidden md:flex items-center justify-center w-32 h-32 bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-3xl shadow-lg border border-blue-100/50 group hover:scale-105 transition-transform duration-300">
                            <div class="hidden md:block">
                                <svg class="ann-icon w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                </svg>
                            </div>   
                        </div>
                    </div>
                </div>

                <!-- Enhanced Content Card -->
                <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl border border-gray-100/50 overflow-hidden">
                    @if ($announcement->hasMedia('featured_image'))
                    <div class="relative w-full aspect-video overflow-hidden bg-gray-100">
                        <img 
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                            src="{{ $announcement->getFirstMedia('featured_image')->getAvailableUrl(['thumb']) }}" 
                            alt="{{ $announcement->title }}"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    @endif

                    <div class="p-8 md:p-12">
                        <!-- Enhanced Content -->
                        <div class="user-content prose prose-lg max-w-none">
                            <div class="prose-headings:font-bold prose-headings:text-gray-900 prose-p:text-gray-600 prose-p:leading-relaxed prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-2xl prose-img:shadow-lg">
                                {{ new Illuminate\Support\HtmlString($announcement->getMeta('content')) }}
                            </div>
                        </div>

                        <!-- Footer Section -->
                        <div class="mt-12 pt-8 border-t border-gray-100">
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <!-- Back to top button -->
                                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                    </svg>
                                    <span>Back to top</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tempest::layouts.main>