<x-tempest::layouts.main>
    <div class="min-h-screen">
        <main class="min-h-screen py-8">
            <div class="container mx-auto px-4 max-w-6xl space-y-6">
                
                <nav class="bg-white rounded-lg shadow-sm">
                    <div class="mb-8">
                    <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
                    </div>
                </nav>

                
                <div class="bg-white rounded-xl p-4 sm:p-6 lg:p-8 shadow-lg border border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">
                        <div class="flex-shrink-0 inline-flex">
                            <div class="p-2 sm:p-3 bg-primary-100 rounded-xl">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 break-words sm:break-normal">
                                {{ $this->getTitle() }}
                            </h1>
                        </div>
                    </div>
                </div>

               
                <div class="bg-white rounded-xl p-4 sm:p-6 lg:p-8 shadow-lg">
                    <div class="user-content max-w-4xl mx-auto">
                        @if($publisherLibraries->isNotEmpty())
                            <ul class="divide-y divide-gray-100">
                                @foreach($publisherLibraries as $media)
                                    <li class="group">
                                        <a href="{{ route(App\Frontend\ScheduledConference\Pages\PublisherLibraryDownload::getRouteName(), ['media' => $media->uuid]) }}"
                                        class="flex flex-col sm:flex-row items-start sm:items-center py-4 sm:py-6 px-3 sm:px-4 -mx-3 sm:-mx-4 rounded-lg hover:bg-gray-50 transition-all duration-200 gap-4 sm:gap-6">
                                            <div class="flex-shrink-0">
                                                <div class="p-2 sm:p-3 bg-primary-50 rounded-lg sm:rounded-xl group-hover:bg-primary-100 transition-colors">
                                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0 w-full">
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 sm:gap-4">
                                                    <span class="text-sm sm:text-base font-medium text-gray-900 break-all sm:truncate group-hover:text-primary-600 transition-colors">
                                                        {{ $media->name }}
                                                    </span>
                                                    <span class="flex-shrink-0">
                                                        <span class="inline-flex items-center px-2.5 sm:px-3 py-0.5 sm:py-1 text-xs sm:text-sm font-medium text-primary-700 bg-primary-50 rounded-full group-hover:bg-primary-100 transition-colors">
                                                            Download
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else 
                            <div class="text-center py-8 sm:py-12 lg:py-16">
                                <div class="bg-gray-50 rounded-xl sm:rounded-2xl p-6 sm:p-8 max-w-lg mx-auto">
                                    <svg class="mx-auto h-12 sm:h-16 w-12 sm:w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="mt-4 sm:mt-6 text-base sm:text-lg font-medium text-gray-500">
                                        {{ __('general.no_publisher_library_available') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
        </main>
    </div>
</x-tempest::layouts.main>