<x-tempest::layouts.main>
    <div class="space-y-8">
        <section id="highlight" class="space-y-4">
            <div class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 gap-4">
                <div class="flex flex-col gap-4 flex-1">
                    @if ($currentScheduledConference->hasMedia('cover'))
                        <div class="cf-cover">
                            <img class="h-full"
                                src="{{ $currentScheduledConference->getFirstMedia('cover')->getAvailableUrl(['thumb', 'thumb-xl']) }}"
                                alt="{{ $currentScheduledConference->title }}" />
                        </div>
                    @endif
                    @php 
                    $layouts = App\Facades\Plugin::getPlugin('Tempest')->getSetting('layouts');
                    
                    @endphp
                        <div class="contents-container">
                            @if ($layouts)
                            @foreach ($layouts as $layout)
                                {{ new Illuminate\Support\HtmlString($layout['data']['about']) }}              
                            @endforeach
                            @endif
                        </div>
                    @if ($currentScheduledConference->getMeta('additional_content'))
                        <div class="user-content">
                            {{ new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('additional_content')) }}
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @if ($currentScheduledConference?->speakers->isNotEmpty())
            <section id="speakers" class="py-6 sm:py-8 md:py-12 bg-white">
                <div class="container mx-auto px-4">
                    <div class="max-w-7xl mx-auto">
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-6 sm:mb-8 md:mb-10 relative inline-block w-full text-gray-900">
                            Speakers
                            <span class="garis absolute left-1/2 -bottom-3 sm:-bottom-4 transform -translate-x-1/2 w-16 sm:w-20 md:w-24 h-1 bg-purple-600"></span>
                        </h3>
                        
                        <div class="space-y-12 sm:space-y-16 md:space-y-20">
                            @foreach ($currentScheduledConference->speakerRoles as $role)
                            @if ($role->speakers->isNotEmpty())
                            <div class="speak-title bg-white rounded-2xl sm:rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] p-6 sm:p-8 md:p-2 lg:p-16 transform hover:shadow-[0_8px_30px_rgba(0,0,0,0.12)] transition-all duration-500">
                                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-8 sm:mb-12 md:mb-16 flex items-center justify-center text-gray-900 md:mt-8 lg:mt-2">
                                    <span class="relative">
                                        {{ $role->name }}
                                        <span class="garis absolute -bottom-1 sm:-bottom-2 left-0 w-full h-0.5"></span>
                                    </span>
                                    <svg class="speak-icon w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 ml-2 sm:ml-3" fill="currentColor" viewBox="0 0 100 100">
                                        <path d="M100 34.2c-.4-2.6-3.3-4-5.3-5.3-3.6-2.4-7.1-4.7-10.7-7.1-8.5-5.7-17.1-11.4-25.6-17.1-2-1.3-4-2.7-6-4-1.4-1-3.3-1-4.8 0-5.7 3.8-11.5 7.7-17.2 11.5L5.2 29C3 30.4.1 31.8 0 34.8c-.1 3.3 0 6.7 0 10v16c0 2.9-.6 6.3 2.1 8.1 6.4 4.4 12.9 8.6 19.4 12.9 8 5.3 16 10.7 24 16 2.2 1.5 4.4 3.1 7.1 1.3 2.3-1.5 4.5-3 6.8-4.5 8.9-5.9 17.8-11.9 26.7-17.8l9.9-6.6c.6-.4 1.3-.8 1.9-1.3 1.4-1 2-2.4 2-4.1V37.3c.1-1.1.2-2.1.1-3.1 0-.1 0 .2 0 0zM54.3 12.3L88 34.8 73 44.9 54.3 32.4V12.3zm-8.6 0v20L27.1 44.8 12 34.8l33.7-22.5zM8.6 42.8L19.3 50 8.6 57.2V42.8zm37.1 44.9L12 65.2l15-10.1 18.6 12.5v20.1zM50 60.2L34.8 50 50 39.8 65.2 50 50 60.2zm4.3 27.5v-20l18.6-12.5 15 10.1-33.6 22.4zm37.1-30.5L80.7 50l10.8-7.2-.1 14.4z"/>
                                    </svg>
                                </h2>
                                <div class="items-center justify-center gap-6 sm:gap-8 md:gap-12 flex flex-wrap">
                                    @foreach ($role->speakers as $speaker)
                                    <div class="w-full max-w-xs flex">
                                        <div class="bg-gradient-to-b from-white to-gray-50/50 rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 transition duration-500 transform hover:-translate-y-2 hover:shadow-[0_8px_30px_rgba(0,0,0,0.12)] border border-gray-100 flex flex-col w-full">
                                            <div class="relative mb-4 sm:mb-5 md:mb-6 flex justify-center">
                                                <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 flex-shrink-0">
                                                    <img class="w-full h-full rounded-full object-cover shadow-lg border-2 sm:border-3 md:border-4 border-white ring-2 sm:ring-3 md:ring-4 ring-gray-100 group-hover:ring-indigo-300 transition-all duration-300"
                                                        src="{{ $speaker->getFilamentAvatarUrl() }}"
                                                        alt="{{ $speaker->fullName }}" />
                                                </div>
                                            </div>
                                            <div class="text-center flex-grow flex flex-col justify-between min-h-[200px]">
                                                <div>
                                                    <h4 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-gray-900 line-clamp-2 min-h-[2.5em]">{{ $speaker->fullName }}</h4>
                                                    @if ($speaker->getMeta('affiliation'))
                                                    <p class="text-xs sm:text-sm text-gray-600 px-2 sm:px-3 md:px-4 leading-relaxed mb-3 line-clamp-3 min-h-[3em]">{{ $speaker->getMeta('affiliation') }}</p>
                                                    @endif
                                                </div>
                                                @if($speaker->getMeta('scopus_url') || $speaker->getMeta('google_scholar_url') || $speaker->getMeta('orcid_url'))
                                                <div class="flex justify-center items-center space-x-4 pt-4 border-t border-gray-100">
                                                    @if($speaker->getMeta('orcid_url'))
                                                    <a href="{{ $speaker->getMeta('orcid_url') }}" target="_blank" 
                                                        class="text-lime-600 hover:text-lime-700 transition-all duration-300 transform hover:-translate-y-1">
                                                        <x-academicon-orcid class="w-7 h-7 opacity-80 hover:opacity-100" />
                                                    </a>
                                                    @endif

                                                    @if($speaker->getMeta('google_scholar_url'))
                                                    <a href="{{ $speaker->getMeta('google_scholar_url') }}" target="_blank" 
                                                        class="text-blue-600 hover:text-blue-700 transition-all duration-300 transform hover:-translate-y-1">
                                                        <x-academicon-google-scholar class="w-7 h-7 opacity-80 hover:opacity-100" />
                                                    </a>
                                                    @endif

                                                    @if($speaker->getMeta('scopus_url'))
                                                    <a href="{{ $speaker->getMeta('scopus_url') }}" target="_blank" 
                                                        class="text-orange-600 hover:text-orange-700 transition-all duration-300 transform hover:-translate-y-1">
                                                        <x-academicon-scopus class="w-7 h-7 opacity-80 hover:opacity-100" />
                                                    </a>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif

            @if($sponsorLevels->isNotEmpty() || $sponsorsWithoutLevel->isNotEmpty())
            <section class="bg-white py-12 sm:py-16 md:py-20">
                <div class="container mx-auto px-4">
                    <div class="max-w-[1400px] mx-auto">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-8 sm:mb-10 relative inline-block w-full text-gray-900">
                            Sponsors
                            <span class="garis absolute left-1/2 -bottom-3 sm:-bottom-4 transform -translate-x-1/2 w-16 sm:w-20 md:w-24 h-1 bg-purple-600"></span>
                        </h2>
                        
                        <div class="space-y-12 sm:space-y-16 md:space-y-20">
                            @if($sponsorsWithoutLevel->isNotEmpty())
                            <div class="bg-white p-4 sm:p-6 md:p-8 lg:p-12 rounded-2xl sm:rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                                <div class="flex flex-wrap justify-center gap-4 sm:gap-6 md:gap-8">
                                    @foreach($sponsorsWithoutLevel as $sponsor)
                                    @if(!$sponsor->getFirstMedia('logo'))
                                    @continue
                                    @endif
                                    <div class="w-[calc(100%-2rem)] sm:w-[calc(50%-2rem)] md:w-[calc(33.333%-2rem)] lg:w-[calc(25%-2rem)] xl:w-[calc(20%-2rem)] flex items-center justify-center p-4 aspect-[4/3]">
                                        <img class="w-full h-full object-contain hover:-translate-y-1 transition-all duration-300" 
                                            src="{{ $sponsor->getFirstMediaUrl('logo') }}"
                                            alt="{{ $sponsor->name }}"
                                            loading="lazy" />
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        
                            @foreach ($sponsorLevels as $sponsorLevel)
                            <div class="bg-white p-4 sm:p-6 md:p-8 lg:p-12 rounded-2xl sm:rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                                <h3 class="text-xl sm:text-2xl font-bold mb-6 sm:mb-8 md:mb-10 relative inline-block text-gray-900">
                                    {{ $sponsorLevel->name }}
                                    <span class="absolute -bottom-2 left-0 w-full h-0.5 bg-purple-500"></span>
                                </h3>
                                <div class="flex flex-wrap justify-center gap-4 sm:gap-6 md:gap-8">
                                    @foreach($sponsorLevel->stakeholders as $sponsor)
                                    @if(!$sponsor->getFirstMedia('logo'))
                                    @continue
                                    @endif
                                    <div class="w-[calc(100%-2rem)] sm:w-[calc(50%-2rem)] md:w-[calc(33.333%-2rem)] lg:w-[calc(25%-2rem)] xl:w-[calc(20%-2rem)] flex items-center justify-center p-4 aspect-[4/3]">
                                        <img class="w-full h-full object-contain hover:-translate-y-1 transition-all duration-300" 
                                            src="{{ $sponsor->getFirstMediaUrl('logo') }}"
                                            alt="{{ $sponsor->name }}"
                                            loading="lazy" />
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif

            @if($partners->isNotEmpty())
            <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-white">
                <div class="px-4 mx-auto container">
                    <div class="max-w-7xl mx-auto">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-6 sm:mb-8 md:mb-10 relative inline-block w-full text-gray-900">
                            Partners
                            <span class="garis absolute left-1/2 -bottom-3 sm:-bottom-4 transform -translate-x-1/2 w-16 sm:w-20 md:w-24 h-1 bg-purple-600"></span>
                        </h2>
                        
                        <div class="bg-white p-6 sm:p-8 md:p-10 lg:p-12 rounded-2xl sm:rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                            <div class="flex flex-wrap justify-center gap-6 sm:gap-8">
                                @foreach($partners as $partner)
                                <div class="w-[calc(100%-2rem)] sm:w-[calc(50%-2rem)] md:w-[calc(33.333%-2rem)] lg:w-[calc(25%-2rem)] xl:w-[calc(20%-2rem)] flex items-center justify-center p-4 aspect-[4/3]">
                                    <img class="w-full h-full object-contain hover:-translate-y-1 transition-all duration-300"
                                        src="{{ $partner->getFirstMediaUrl('logo') }}"
                                        alt="{{ $partner->name }}" 
                                        loading="lazy"/>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif

                <div class="py-6 sm:py-12">
                    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-200 pb-4 sm:pb-6 mb-6 sm:mb-10 space-y-3 sm:space-y-0">
                            <div>
                                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Latest News</h1>
                                    <span class="tag-ann inline-flex items-center px-2.5 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium w-fit">
                                        Latest Updates
                                    </span>
                                </div>
                            </div>
                            
                            <a href="{{ route('livewirePageGroup.scheduledConference.pages.announcements') }}" 
                            class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-md bg-white border border-gray-300 hover:bg-gray-50 transition duration-150 text-xs sm:text-sm font-medium text-gray-700 w-fit">
                                View All
                                <svg class="ml-1.5 sm:ml-2 w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="grid gap-4 sm:gap-6 lg:gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                        @php
                            $latestAnnouncements = $currentScheduledConference->announcements
                                ->filter(function ($announcement) {
                                    return is_null($announcement->expires_at) || $announcement->expires_at > now();
                                })
                                ->sortByDesc('created_at')
                                ->take(3);
                        @endphp
                        


                
                            @forelse ($latestAnnouncements as $announcement)
                                @php
                                    $content = $announcement->getMeta('content');
                                    preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);
                                    $imageUrl = $matches[1] ?? '/storage/default-image.jpg';
                                @endphp
                
                                <div class="group bg-white rounded-lg sm:rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100">
                                    <div class="relative">
                                        <div class="aspect-w-16 aspect-h-9">
                                            <?php if($imageUrl): ?>
                                                <img src="{{ $imageUrl }}" 
                                                    alt="{{ $announcement->title }}"
                                                    class="w-full h-40 sm:h-48 object-contain transform group-hover:scale-105 transition duration-500"
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="hidden w-full h-40 sm:h-48 bg-gray-200 items-center justify-center">
                                                    <div class="metallic-container">
                                                        <i class="fas fa-image metallic-icon"></i>
                                                        <span class="metallic-text">Image Not Available</span>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="w-full h-40 sm:h-48 bg-gray-600 flex items-center justify-center">
                                                    <div class="metallic-container">
                                                        <i class="fas fa-image metallic-icon"></i>
                                                        <span class="metallic-text">Image Not Available</span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="absolute top-0 right-0 mt-2 sm:mt-4 mr-2 sm:mr-4">
                                            @if($announcement->getMeta('important', false))
                                                <span class="inline-flex items-center px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-xs font-medium bg-red-100 text-red-800">
                                                    Important
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                
                                    <div class="group p-4 sm:p-6">
                                        <div class="flex items-center text-xs sm:text-sm text-gray-500 mb-2 sm:mb-3">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $announcement->created_at->format(Setting::get('format_date')) }}
                                        </div>
                
                                        <div class="group">
                                            <h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2 sm:mb-3 transition duration-300">
                                            <a href="{{ route('livewirePageGroup.scheduledConference.pages.announcement-page', ['announcement' => $announcement->id]) }}" 
                                                class="hover:underline decoration-2 decoration-blue-500 underline-offset-2">
                                                {{ $announcement->title }}
                                            </a>
                                            </h2>
                                        </div>
                                        
                
                                        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-3 sm:mb-4 line-clamp-3">
                                            {{ $announcement->getMeta('summary') }}
                                        </p>
                
                                        <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-gray-100">
                                            <a href="{{ route('livewirePageGroup.scheduledConference.pages.announcement-page', ['announcement' => $announcement->id]) }}" 
                                            class="read-full-ann inline-flex items-center font-medium text-sm group/link">
                                                Read full
                                                <svg class="ml-1.5 sm:ml-2 w-3 h-3 sm:w-4 sm:h-4 transform group-hover/link:translate-x-1 transition-transform duration-200" 
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full flex flex-col items-center justify-center py-8 sm:py-12 text-center">
                                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-400 mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-1 sm:mb-2">No announcements available</h3>
                                    <p class="text-gray-500 text-xs sm:text-sm">Check back later for new updates and announcements.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
</x-tempest::layouts.main>