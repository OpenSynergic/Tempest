@use('App\Models\Enums\RegistrationPaymentState')
<x-tempest::layouts.main>
    @if ($isLogged)
    <div class="min-h-screen">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Enhanced Breadcrumbs -->
            <div class="mb-8">
            <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
            </div>
            @if ($userRegistration)
            <div class="space-y-6">
                <div class="ann-title bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">
                                {{ __('general.registration_status') }}
                            </h1>
                            <p class="text-gray-500 text-lg">{{ __('general.this_your_pacticipant_retistration_details') }}</p>
                        </div>
                        <div class="hidden md:flex items-center justify-center w-32 h-32 bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-3xl shadow-lg border border-blue-100/50 group hover:scale-105 transition-transform duration-300">
                            <svg class="ann-icon w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                                <path d="M16 11h6M19 8v6" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-8 py-6">
                        <!-- Header Section with Status -->
                        <div class="flex items-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mr-2">{{ __('general.status') }}</h2>
                            <span @class([
                                'px-3 py-1.5 pr-5 rounded-full text-sm font-medium inline-flex items-center',
                                'bg-green-100 text-green-800' => $userRegistration->getState() === RegistrationPaymentState::Paid->value,
                                'bg-yellow-100 text-yellow-800' => $userRegistration->getState() === RegistrationPaymentState::Unpaid->value,
                                'bg-red-100 text-red-800' => $userRegistration->trashed(),
                            ])>
                                <span class="w-2 h-2 rounded-full inline-block" @class([
                                    'bg-green-500' => $userRegistration->getState() === RegistrationPaymentState::Paid->value,
                                    'bg-yellow-500' => $userRegistration->getState() === RegistrationPaymentState::Unpaid->value,
                                    'bg-red-500' => $userRegistration->trashed(),
                                ])></span>
                                {{ $userRegistration->trashed() ? 'Failed' : $userRegistration->getState() }}
                            </span>
                        </div>
                
                        <!-- Main Content Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div class="flex flex-col space-y-2">
                                    <span class="text-sm text-gray-500">{{ __('general.type') }}</span>
                                    <span class="text-base font-semibold text-gray-900">{{ $userRegistration->registrationPayment->name }}</span>
                                </div>
                                
                                <div class="flex flex-col space-y-2">
                                    <span class="text-sm text-gray-500">{{ __('general.level') }}</span>
                                    <span class="text-base text-gray-900">
                                        {{ 
                                            match ($userRegistration->registrationPayment->level) {
                                                App\Models\RegistrationType::LEVEL_PARTICIPANT => 'Participant',
                                                App\Models\RegistrationType::LEVEL_AUTHOR => 'Author',
                                                default => 'None',
                                            }    
                                        }}
                                    </span>
                                </div>
                            </div>
                
                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div class="flex flex-col space-y-2">
                                    <span class="text-sm text-gray-500">{{ __('general.cost') }}</span>
                                    <span class="text-base font-semibold text-gray-900">
                                        @php
                                            $userRegistrationCostFormatted = moneyOrFree($userRegistration->registrationPayment->cost, $userRegistration->registrationPayment->currency, true);
                                        @endphp
                                        {{ $userRegistrationCostFormatted }}
                                    </span>
                                </div>
                
                                <div class="flex flex-col space-y-2">
                                    <span class="text-sm text-gray-500">{{ __('general.registration_date') }}</span>
                                    <span class="text-base text-gray-900">{{ $userRegistration->created_at->format(Setting::get('format_date')) }}</span>
                                </div>
                
                                @if ($userRegistration->getState() === RegistrationPaymentState::Paid->value && $userRegistration->registrationType->currency !== 'free')
                                    <div class="flex flex-col space-y-2">
                                        <span class="text-sm text-gray-500">{{ __('general.payment_date') }}</span>
                                        <span class="text-base text-gray-900">{{ $userRegistration->registrationPayment->paid_at->format(Setting::get('format_date')) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                
                        <!-- Description Section -->
                        <div class="mt-8 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('general.description') }}</h3>
                            <div class="prose prose-gray max-w-none">
                                {!! $userRegistration->registrationPayment->description !!}
                            </div>
                        </div>
                
                        <!-- Action Buttons -->
                        <div class="mt-8 flex justify-start">
                            @if($userRegistration->getState() === RegistrationPaymentState::Paid->value && $userRegistration->registrationPayment->level === App\Models\RegistrationType::LEVEL_AUTHOR && !$userRegistration->trashed())
                                <a href="{{ App\Panel\ScheduledConference\Resources\SubmissionResource::getUrl('index', panel: App\Providers\PanelProvider::PANEL_SCHEDULED_CONFERENCE) }}" 
                                class="inline-flex items-center px-5 py-2.5 bg-green-600 hover:bg-green-700 transition-colors duration-200 text-white font-medium rounded-lg text-sm">
                                    {{ __('general.submission') }}
                                </a>
                            @elseif($userRegistration->getState() === RegistrationPaymentState::Unpaid->value || $userRegistration->trashed())
                                <div x-data="{ isCancelling: false }" class="w-full">
                                    <button x-show="!isCancelling" @click="isCancelling = true"
                                            class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 transition-colors duration-200 text-white font-medium rounded-lg text-sm">
                                        {{ __('general.cancel_registration') }}
                                    </button>
                                    
                                    <div x-show="isCancelling" x-cloak 
                                         class="mt-4 p-6 bg-gray-50 rounded-lg border border-gray-200">
                                        <p class="text-gray-700 mb-4">{{ __('general.are_you_sure_want_to_cancel_registration') }}</p>
                                        <div class="flex space-x-4">
                                            <button @click="isCancelling = false"
                                                    class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                                {{ __('general.no') }}
                                            </button>
                                            <button wire:click="cancel"
                                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                                {{ __('general.yes') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                    @if ($userRegistration->getState() === RegistrationPaymentState::Unpaid->value && !$userRegistration->trashed() && !empty($paymentDetails))
                        <div class="mt-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('general.payment_details') }}</h2>
                                <div class="space-y-4">
                                    @foreach($paymentDetails as $paymentTitle => $paymentDescription)
                                        <div x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }" class="border border-gray-200 dark:border-gray-700 rounded-md">
                                            <button @click="open = !open" class="flex justify-between items-center w-full px-4 py-2 text-left text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none">
                                                <span class="text-lg font-medium">{{ $paymentTitle }}</span>
                                                <svg class="w-5 h-5 transform transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="px-4 py-2 bg-white dark:bg-gray-800">
                                                <div class="prose dark:prose-invert max-w-none">
                                                    {!! new Illuminate\Support\HtmlString($paymentDescription) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($currentScheduledConference->getMeta('payment_policy')) || !empty($currentScheduledConference->getMeta('registration_policy')))
                        <div class="mt-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                            <div class="p-6">
                                @if(!empty($currentScheduledConference->getMeta('payment_policy')))
                                    <div class="mb-8">
                                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('general.payment_policy') }}</h2>
                                        <div class="prose dark:prose-invert max-w-none">
                                            {!! new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('payment_policy')) !!}
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($currentScheduledConference->getMeta('registration_policy')))
                                    <div>
                                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('general.registration_policy') }}</h2>
                                        <div class="prose dark:prose-invert max-w-none">
                                            {!! new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('registration_policy')) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    @else
        {{ abort(404) }}
    @endif
</x-tempest::layouts.main>