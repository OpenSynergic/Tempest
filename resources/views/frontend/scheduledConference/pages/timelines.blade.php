<x-tempest::layouts.main>
    <div class="min-h-screen">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="mb-8">
                <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
            </div>

            <div class="ann-title bg-white space-y-4 sm:space-y-6">
                <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-4 sm:p-6 md:p-8 border border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="space-y-2 flex-grow">
                            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold pb-2 sm:pb-3 md:pb-5">
                                <span class="bg-clip-text text-transparent">
                                    Timeline
                                </span>
                            </h1>
                            <p class="text-gray-500 text-sm sm:text-base md:text-lg">
                                Track the journey of our key events and milestones.
                            </p>
                        </div>
                        <div class="hidden md:flex items-center justify-center w-24 h-24 lg:w-32 lg:h-32 bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-2xl lg:rounded-3xl shadow-lg border border-blue-100/50 group hover:scale-105 transition-transform duration-300">
                            <div class="hidden md:block">
                                <svg class="w-8 h-8 lg:w-12 lg:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>   
                        </div>
                    </div>
                </div>

                @if($timelines->isNotEmpty())
                <div class="space-y-6">
                    @foreach ($timelines as $index => $timeline)
                    <div class="relative group">
                        <div class="absolute -left-4 sm:-left-8 top-0 w-0.5 bg-gray-200 h-full origin-top 
                            group-last:h-[30px] transition-all duration-300"></div>
                        
                        <div class="relative pl-4 sm:pl-8 mb-6">
                            <div class="absolute -left-[10px] sm:-left-[14px] top-0 w-4 h-4 bg-white rounded-full 
                                border-2 border-gray-200 group-hover:background-color transition-all duration-300 
                                flex items-center justify-center">
                                <div class="w-2 h-2 background-color rounded-full transition-all duration-300"></div>
                            </div>
                            
                            <div class="bg-white rounded-xl border border-gray-50/50 shadow-lg 
                                hover:shadow-xl transition-all duration-300 ease-in-out 
                                overflow-hidden">
                                <div class="p-4 sm:p-6 space-y-4">
                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 sm:gap-4">
                                        <div class="flex-grow pr-0 sm:pr-4">
                                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">
                                                {{ $timeline->name }}
                                            </h3>
                                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                                                {{ $timeline->description }}
                                            </p>
                                        </div>
                                        <time class="text-xs sm:text-sm font-medium text-color
                                            bg-gray-50 px-2 sm:px-3 py-1 rounded-full whitespace-nowrap">
                                            {{ $timeline->date->format(Setting::get('format_date')) }}
                                        </time>
                                    </div>
                                    
                                    <div class="flex items-center justify-between pt-4 
                                        border-t border-gray-50/50 text-xs sm:text-sm text-gray-500">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-color" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span>{{ $timeline->date->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-white border border-blue-50/50 rounded-xl shadow-lg p-6 sm:p-8 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="flex justify-center mb-4">
                            <div class="p-3 bg-blue-50 rounded-full">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        </div>
    </div>
</x-tempest::layouts.main>