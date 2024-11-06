<div class="banner relative overflow-hidden -mt-[5%] mb-[4%] z-10">
    @php
        $images = $currentScheduledConference->getMedia('tempest-banner')->first();
        $imageUrls = $images ? $images->getAvailableUrl(['thumb', 'thumb-xl']) : null;
        
        $imagess = $currentScheduledConference->getMedia('tempest-countdown')->first();
        $imagecountdown = $imagess ? $imagess->getAvailableUrl(['thumb', 'thumb-xl']) : null;
    @endphp

    <div class="animate-fadeIn">
        @if($imageUrls)
            <img src="{{ $imageUrls }}" alt="Conference Banner"     
                 class="w-full h-auto aspect-[16/7] object-cover banner-image">
        @else
            <div class="banner-bg w-full h-auto aspect-[16/8]"></div>
        @endif
    </div>

    @if(app()->getCurrentConference() || app()->getCurrentScheduledConference())
    <div class="conference-title relative z-10 flex flex-col text-white p-4 md:p-8 lg:p-12 xl:p-16 -mt-[4%] ml-[2%]">
        <!-- Conference Title -->
        <h1 class="animate-slideUp delay-100 text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 text-shadow-lg -mt-[28%] mr-[48%] md:mr-[30%] lg:mr-[40%] text-white z-20">
            {{ $currentScheduledConference->title ?? 'Conference Title' }}
        </h1>
        
        <!-- Date Information -->
        <p class="animate-slideUp delay-200 text-lg md:text-xl lg:text-2xl mb-6 opacity-90 flex items-center backdrop-blur-sm bg-black/10 rounded-lg px-4 py-2 w-fit">
            @if($currentScheduledConference->date_start)
            <svg class="w-6 h-6 inline-block mr-3 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m4 4H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"></path>
            </svg>
                @if($currentScheduledConference->date_end && $currentScheduledConference->date_start->format(Setting::get('format_date')) !== $currentScheduledConference->date_end->format(Setting::get('format_date')))
                    <span class="inline-block">{{ $currentScheduledConference->date_start->format(Setting::get('format_date')) }}</span>
                    <span class="inline-block"> -{{ $currentScheduledConference->date_end->format(Setting::get('format_date')) }}</span>
                @else
                    <span class="inline-block">{{ $currentScheduledConference->date_start->format(Setting::get('format_date')) }}</span>
                @endif
            @endif
        </p>
        
        <!-- Location Information -->
        <p class="animate-slideUp delay-300 text-lg md:text-xl lg:text-2xl mb-8 opacity-90 flex items-center backdrop-blur-sm bg-black/10 rounded-lg px-4 py-2 w-fit">
            <svg class="w-6 h-6 inline-block mr-3 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            {{ $currentScheduledConference->getMeta('location') ?? 'Location to be announced' }}
        </p>
        
        <!-- Action Buttons -->
        <div class="animate-slideUp delay-400 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            @php
                $submissionRoute = route(App\Panel\ScheduledConference\Resources\SubmissionResource\Pages\ManageSubmissions::getRouteName(App\Providers\PanelProvider::PANEL_SCHEDULED_CONFERENCE));
                $registerRoute = route(App\Frontend\ScheduledConference\Pages\ParticipantRegister::getRouteName('scheduledConference'));
            @endphp
            
            <a href="<?php echo $submissionRoute; ?>" 
               class="banner-submission group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden font-medium text-white bg-gradient-to-r from-purple-600 to-blue-500 rounded-lg shadow-md transition-all duration-300 ease-out hover:scale-105 hover:shadow-lg">
                <span class="flex items-center">
                    Submission
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </a>
            
            <a href="<?php echo $registerRoute; ?>" 
               class="banner-register group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden font-medium bg-white text-purple-600 rounded-lg shadow-md transition-all duration-300 ease-out hover:scale-105 hover:bg-purple-50">
                <span class="flex items-center">
                    Register
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </a>
        </div>

        <!-- Countdown Section -->
        <div class="animate-slideUp delay-500 countdown-con w-full max-w-5xl mx-auto mt-14 backdrop-blur-md bg-white rounded-2xl border border-white/20 shadow-2xl p-6"
             style="background-image: url('{{ $imagecountdown }}');">
             <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
                <!-- Days -->
                <div class="relative group animate-popIn delay-600">
                    <div class="p-4 sm:p-6 bg-white rounded-xl border border-purple-200 shadow-lg transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                        <div class="text-center">
                            <div id="days" class="text-4xl sm:text-5xl font-bold text-gradient mb-2">00</div>
                            <div class="uppercase tracking-wider text-sm font-semibold text-gray-600">Days</div>
                        </div>
                    </div>
                </div>
            
                <!-- Hours -->
                <div class="relative group animate-popIn delay-700">
                    <div class="p-4 sm:p-6 bg-white rounded-xl border border-purple-200 shadow-lg transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                        <div class="text-center">
                            <div id="hours" class="text-4xl sm:text-5xl font-bold text-gradient mb-2">00</div>
                            <div class="uppercase tracking-wider text-sm font-semibold text-gray-600">Hours</div>
                        </div>
                    </div>
                </div>
            
                <!-- Minutes -->
                <div class="relative group animate-popIn delay-800">
                    <div class="p-4 sm:p-6 bg-white rounded-xl border border-purple-200 shadow-lg transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                        <div class="text-center">
                            <div id="minutes" class="text-4xl sm:text-5xl font-bold text-gradient mb-2">00</div>
                            <div class="uppercase tracking-wider text-sm font-semibold text-gray-600">Minutes</div>
                        </div>
                    </div>
                </div>
            
                <div class="relative group animate-popIn delay-900">
                    <div class="p-4 sm:p-6 bg-white rounded-xl border border-purple-200 shadow-lg transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                        <div class="text-center">
                            <div id="seconds" class="text-4xl sm:text-5xl font-bold text-gradient mb-2">00</div>
                            <div class="uppercase tracking-wider text-sm font-semibold text-gray-600">Seconds</div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    @endif
</div>

<style>
@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 15s ease infinite;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-fadeIn {
    animation: fadeIn 1s ease-out forwards;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slideUp {
    opacity: 0;
    animation: slideUp 0.6s ease-out forwards;
}

@keyframes popIn {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    80% {
        transform: scale(1.1);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-popIn {
    opacity: 0;
    animation: popIn 0.5s ease-out forwards;
}

.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }
.delay-700 { animation-delay: 0.7s; }
.delay-800 { animation-delay: 0.8s; }
.delay-900 { animation-delay: 0.9s; }
</style>