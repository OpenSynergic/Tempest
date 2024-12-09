<x-tempest::layouts.main>
    <div class="min-h-screen">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="mb-8">
            <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
            </div>

            <div class="ann-title bg-white space-y-4 sm:space-y-6">
                <!-- Header Section -->
                <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-4 sm:p-6 md:p-8 border border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="space-y-2">
                            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold pb-2 sm:pb-3 md:pb-5">
                                <span class="bg-clip-text">
                                    Announcements
                                </span>
                            </h1>
                            <p class="text-gray-500 text-sm sm:text-base md:text-lg">Check out the latest announcements and stay updated with important information.</p>
                        </div>
                        <!-- Icon container - Hidden pada mobile -->
                        <div class="hidden md:flex items-center justify-center w-24 h-24 lg:w-32 lg:h-32 bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-2xl lg:rounded-3xl shadow-lg border border-blue-100/50 group hover:scale-105 transition-transform duration-300">
                            <div class="hidden md:block">
                                <svg class="w-8 h-8 lg:w-12 lg:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                </svg>
                            </div>   
                        </div>
                    </div>
                </div>

                <!-- Announcements List -->
                <div class="space-y-4 sm:space-y-6 md:space-y-8">
                    <div class="space-y-4 sm:space-y-6 md:space-y-8">
                    @forelse ($announcements as $announcement)
                        @if (!$announcement->expired_at || $announcement->expired_at > now())
                            <div class="ann-item group p-4 sm:p-5 md:p-6 rounded-lg md:rounded-xl shadow-sm drop-shadow-2xl border-l-4 hover:shadow-xl transition-all duration-300 transform hover:scale-102 bg-white">
                                <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                    <!-- Icon -->
                                    <div class="flex-shrink-0">
                                        <div class="icon-read w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Content -->
                                    <div class="flex-grow">
                                        <x-scheduledConference::announcement-summary :announcement="$announcement" />
                                        <div class="mt-4 flex items-center justify-end">
                                            <a href="{{ route('livewirePageGroup.scheduledConference.pages.announcement-page', ['announcement' => $announcement->id]) }}" 
                                               class="read-more inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 border text-sm font-medium rounded-full text-white transition-all duration-300 group">
                                                Read more
                                                <svg class="ml-2 -mr-1 h-4 w-4 transform group-hover:translate-x-1 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <!-- Empty State - Responsif -->
                        <div class="text-center py-8 sm:py-12 md:py-16 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl shadow-inner">
                            <div class="relative inline-block">
                                <svg class="mx-auto h-16 w-16 sm:h-20 sm:w-20 md:h-24 md:w-24 text-indigo-400 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center animate-ping">
                                    <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-indigo-100 rounded-full opacity-75"></div>
                                </div>
                            </div>
                            <h3 class="mt-4 sm:mt-6 text-xl sm:text-2xl font-semibold text-indigo-900">No announcements yet</h3>
                            <p class="mt-2 sm:mt-3 text-indigo-600 max-w-md mx-auto text-sm sm:text-base">Stay tuned for exciting updates! We're working on bringing you the latest news and information.</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tempest::layouts.main>