@use('App\Models\Enums\RegistrationPaymentState')
@use('App\Facades\Setting')

<x-tempest::layouts.main>
    <div class="min-h-screen">
        <div class="container mx-auto px-2 sm:px-4 max-w-6xl">
            <!-- Enhanced Breadcrumbs -->
            <div class="mb-4 sm:mb-8">
                <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
            </div>

            <div class="ann-title bg-white space-y-4 sm:space-y-6">
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl p-4 sm:p-8 border border-gray-100">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="space-y-2">
                            <h1 class="text-2xl sm:text-4xl md:text-5xl font-extrabold pb-2 sm:pb-5">
                                <span class="bg-clip-text">Agenda</span>
                            </h1>
                            @if ($isParticipant)
                            <p class="text-gray-500 text-base sm:text-lg">Please select the event below to confirm your attendance.</p>
                            @endif
                        </div>
                        <div class="hidden md:flex items-center justify-center w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-2xl sm:rounded-3xl shadow-lg border border-blue-100/50 group hover:scale-105 transition-transform duration-300">
                            <div class="hidden md:block">
                                <svg class="ann-icon w-8 h-8 sm:w-12 sm:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></rect>
                                    <path d="M16 2v4M8 2v4M3 10h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border border-gray-100">
                    <div class="p-2 sm:p-6">
                        <div class="overflow-x-auto">
                            <div class="overflow-hidden rounded-xl border border-gray-100">
                                <table class="w-full text-xs sm:text-sm text-left rtl:text-right text-gray-500 border" lazy>
                                    <thead>
                                        <tr class="head-table text-white">
                                            <td class="px-2 sm:px-6 py-2 text-left">Time</td>
                                            <td class="px-2 sm:px-6 py-2 text-center">Session Name</td>
                                            @if ($isParticipant)
                                                <td class="px-2 sm:px-6 py-2 text-center">Status</td>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($timelines->isEmpty())
                                            <tr>
                                                <td class="px-2 sm:px-6 py-4 text-center" colspan="3">
                                                    Agenda are empty.
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach ($timelines as $timeline)
                                            <tr class="bg-gray-50 border-b">
                                                <td class="px-2 sm:px-6 py-4" {!! (!$timeline->canShown() || !$isParticipant) ? "colspan='3'" : "colspan='2'" !!}>
                                                    <strong class="block font-medium text-gray-900 text-sm sm:text-base">
                                                        {{ $timeline->name }}
                                                        @if ($isParticipant)
                                                            @if ($timeline->isOngoing())
                                                                <span class="badge text-[10px] sm:text-xs badge-success text-white mx-1">
                                                                    On going
                                                                </span>
                                                            @elseif ($timeline->getEarliestTime()->isFuture())
                                                                <span class="badge text-[10px] sm:text-xs badge-info text-white mx-1">
                                                                    Not started
                                                                </span>
                                                            @elseif ($timeline->getLatestTime()->isPast())
                                                                <span class="badge text-[10px] sm:text-xs mx-1">
                                                                    Over
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </strong>
                                                    <p class="text-gray-500 text-xs sm:text-sm">
                                                        {{ $timeline->date->format(Setting::get('format_date')) }}
                                                    </p>
                                                </td>
                                                @if ($timeline->canShown() && $isParticipant)
                                                    <td class="px-2 sm:px-6 py-4 text-right text-[10px] sm:text-xs font-normal w-fit">
                                                        @if ($timeline->canAttend())
                                                            @if ($userRegistration->isAttended($timeline))
                                                                <button class="btn-xs sm:btn-sm bg-green-600 rounded-md btn-disabled no-animation !text-white hover:text-white">
                                                                    Confirmed
                                                                </button>
                                                            @else
                                                                <button class="btn btn-xs sm:btn-sm btn-info no-animation text-white rounded" 
                                                                wire:click="attend({{ $timeline->id }}, '{{ static::ATTEND_TYPE_TIMELINE }}')">
                                                                    Attend
                                                                </button>
                                                            @endif
                                                        @else
                                                            @if ($userRegistration->isAttended($timeline))
                                                                <button class="btn-xs sm:btn-sm bg-green-600 rounded-md btn-disabled no-animation !text-white hover:text-white">
                                                                    Confirmed
                                                                </button>
                                                            @else
                                                                @if ($timeline->getEarliestTime()->isFuture())
                                                                    <button class="btn btn-xs sm:btn-sm btn-disabled no-animation !text-white hover:text-white">
                                                                        Incoming
                                                                    </button>
                                                                @elseif ($timeline->getEarliestTime()->isPast())
                                                                    <button class="btn btn-xs sm:btn-sm btn-disabled no-animation !text-white hover:text-white">
                                                                        Expired
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                            @php
                                                $sessions = $timeline->sessions;
                                            @endphp
                                            @foreach ($sessions as $session)
                                                <tr class="bg-white border-b">
                                                    <td class="px-2 sm:px-6 pl-4 sm:pl-8 py-4 text-left w-fit text-nowrap text-xs sm:text-sm">
                                                        {{ $session->time_span }}
                                                        @if ($isParticipant)
                                                            @if ($session->isOngoing())
                                                                <span class="badge text-[10px] sm:text-xs badge-success text-white mx-1">
                                                                    On going
                                                                </span>
                                                            @elseif ($session->isFuture())
                                                                <span class="badge text-[10px] sm:text-xs badge-info text-white mx-1">
                                                                    Not Started
                                                                </span>
                                                            @elseif ($session->isPast())
                                                                <span class="badge text-[10px] sm:text-xs mx-1">
                                                                    Over
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td scope="row" class="px-2 sm:px-6 py-4 text-left text-wrap w-full"
                                                    x-data="{ open: false }">
                                                        <strong class="font-medium text-gray-900 text-sm sm:text-base">
                                                            {{ $session->name }}
                                                        </strong>

                                                        <p class="font-normal text-[10px] sm:text-xs text-gray-500">
                                                            {{ new Illuminate\Support\HtmlString($session->public_details) }}
                                                        </p>

                                                        @if (!empty($session->details) && $isParticipant)
                                                            <div class="flex w-full mt-2 px-2 sm:px-4 py-2 rounded hover:!bg-yellow-100 cursor-pointer text-xs sm:text-sm" style="background-color: #fff8e8;" @click="open = !open">
                                                                <x-filament::icon
                                                                    icon="heroicon-m-lock-open"
                                                                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500"
                                                                />
                                                                    
                                                                <span class="flex-1 mx-2 w-auto">
                                                                    Participant Information
                                                                </span>

                                                                <div class="flex-1 text-right">
                                                                    <x-filament::icon
                                                                        icon="heroicon-m-chevron-down"
                                                                        class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 float-end"
                                                                        x-show="!open" 
                                                                    />
                                                                    <x-filament::icon
                                                                        icon="heroicon-m-chevron-up"
                                                                        class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 float-end"
                                                                        x-show="open" 
                                                                    />
                                                                </div>
                                                            </div>

                                                            <div 
                                                                class="w-full p-2 sm:p-4 rounded cursor-pointer border-t text-xs sm:text-sm" 
                                                                style="background-color: #fff8e8;" 
                                                                x-show="open" 
                                                                @click.away="open = false"
                                                            >
                                                                {{ new Illuminate\Support\HtmlString($session->details) }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    @if ($session->require_attendance && !$timeline->isRequireAttendance() && $isParticipant)
                                                        <td class="px-2 sm:px-4 py-4 text-right align-middle w-fit">
                                                            @if ($session->isOngoing())
                                                                @if ($userRegistration->isAttended($session))
                                                                    <button class="btn-xs sm:btn-sm bg-green-600 rounded-md btn-disabled no-animation !text-white hover:text-white">
                                                                        Confirmed
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-xs sm:btn-sm btn-info no-animation text-white hover:text-white" 
                                                                    wire:click="attend({{ $session->id }}, '{{ static::ATTEND_TYPE_SESSION }}')">
                                                                        Attend
                                                                    </button>
                                                                @endif
                                                            @else
                                                                @if ($userRegistration->isAttended($session))
                                                                    <button class="btn-xs sm:btn-sm bg-green-600 rounded-md btn-disabled no-animation !text-white hover:text-white">
                                                                        Confirmed
                                                                    </button>
                                                                @else
                                                                    @if ($session->isFuture())
                                                                        <button class="btn btn-xs sm:btn-sm btn-disabled no-animation !text-white hover:text-white">
                                                                            Incoming
                                                                        </button>
                                                                    @elseif ($session->isPast())
                                                                        <button class="btn btn-xs sm:btn-sm btn-disabled no-animation !text-white hover:text-white">
                                                                            Expired
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @if ($timelineData || $sessionData)
        <div x-data="{ open: @entangle('isOpen') }" x-show="open" class="fixed inset-0 flex items-center justify-center z-50">
            <div wire:click="cancel" class="fixed inset-0 bg-gray-800 opacity-75"></div>

            <div x-show="open" x-transition class="bg-white rounded shadow-lg p-4 sm:p-6 w-11/12 sm:w-2/3 md:w-1/3 mx-auto z-50 transform transition-all duration-300 ease-in-out">
                <div class="flex justify-between items-center border-b pb-3">
                    <h2 class="text-base sm:text-lg font-semibold">
                        Attendance Confirmation
                    </h2>
                </div>

                <div class="mt-4">
                    @if ($typeData === self::ATTEND_TYPE_TIMELINE)
                        <p class="text-gray-600 text-sm sm:text-base">
                            Are you sure you want attend on <strong>{{ $timelineData->name }}</strong> in <strong>{{ $currentScheduledConference->title }}</strong>?
                        </p>
                    @elseif($typeData === self::ATTEND_TYPE_SESSION)
                        <p class="text-gray-600 text-sm sm:text-base">
                            Are you sure you want attend on <strong>{{ $sessionData->name }}</strong> from <strong>{{ $sessionData->timeline->name }}</strong> in <strong>{{ $currentScheduledConference->title }}</strong>?
                        </p>
                    @else
                        INVALID!
                    @endif

                    @if (!empty($errorMessage))
                        <small class="block text-red-500 text-xs sm:text-sm">
                            *{{ $errorMessage }}
                        </small>
                    @endif
                </div>

                <div class="mt-4 sm:mt-6 flex justify-end space-x-2">
                    <button wire:click="cancel" 
                            class="bg-gray-200 text-gray-700 px-3 sm:px-4 py-1.5 sm:py-2 rounded text-xs sm:text-sm hover:bg-gray-300" 
                            wire:loading.attr="disabled">
                        Cancel
                    </button>

                    <button wire:click="confirm" 
                            class="bg-blue-600 text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded text-xs sm:text-sm hover:bg-blue-700" 
                            wire:loading.attr="disabled">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-tempest::layouts.main>