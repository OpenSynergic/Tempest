@props([
    'sidebars' => \App\Facades\SidebarFacade::get(),
])


<div class="page-container">
    @if(Route::currentRouteName() == 'livewirePageGroup.scheduledConference.pages.home')
        <x-tempest::layouts.banner/>
    @endif
    <div class="mt-5 mb-20">    
        {{ $slot }}
    </div>

    @if ($sidebars->isNotEmpty())
        <x-website::layouts.sidebar :sidebars="$sidebars"/>
    @endif

    <script>
        function updateCountdown() {
            const endDate = new Date("{{ $currentScheduledConference->date_start->format('Y-m-d H:i:s') }}").getTime();
            const now = new Date().getTime();
            const timeLeft = endDate - now;
    
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
    
            document.getElementById('days').innerText = days.toString().padStart(2, '0');
            document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
            document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
    
            if (timeLeft < 0) {
                clearInterval(countdownTimer);
                document.querySelector('.countdown-container').innerHTML = '<div class="text-2xl text-center text-gray-600">Event has started!</div>';
            }
        }
    
        const countdownTimer = setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call
    </script>
</div>
