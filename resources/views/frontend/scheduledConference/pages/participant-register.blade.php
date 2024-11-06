@use('Illuminate\Support\Str')
@use('Carbon\Carbon')

<x-tempest::layouts.main>
    <div class="min-h-screen">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Enhanced Breadcrumbs -->
            <div class="mb-8">
                <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
            </div>

            @if ($registrationOpen)
            <div class="space-y-6">
                <div class="ann-title bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">
                                {{ __('general.participant_registration') }}
                            </h1>
                            <p class="text-gray-500 text-lg">Select your registration type and complete your registration</p>
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

                @if (!$isSubmit)
                    <form wire:submit='register' class="bg-white rounded-2xl shadow-xl border border-gray-100">
                        <!-- Registration Types Table with Enhanced Design -->
                        <div class="p-6">
                            <div class="overflow-hidden rounded-xl border border-gray-100">
                                <table class="w-full">
                                    <thead>
                                        <tr class="head-table bg-gray-50">
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('general.registration_type') }}</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('general.quota') }}</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('general.level') }}</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('general.cost') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach ($registrationTypeList as $index => $type)
                                            @if ($type->active)
                                                <tr class="hover:bg-gray-50/50 transition-all duration-200">
                                                    <td class="px-6 py-4">
                                                        <div class="font-semibold text-gray-900">{{ $type->type }}</div>
                                                        <p class="text-sm text-gray-500 mt-1">{{ $type->getMeta('description') }}</p>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="flex items-center gap-2">
                                                            <div class="font-medium text-gray-900">
                                                                {{ $type->getPaidParticipantCount() }}/{{ $type->quota }}
                                                            </div>
                                                            @if (!$type->isOpen())
                                                                <span class="px-3 py-1 text-xs font-semibold bg-red-50 text-red-600 rounded-full">
                                                                    {{ __('general.closed') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full
                                                            @if($type->level === App\Models\RegistrationType::LEVEL_PARTICIPANT)
                                                                bg-blue-50 text-blue-600
                                                            @elseif($type->level === App\Models\RegistrationType::LEVEL_AUTHOR)
                                                                bg-purple-50 text-purple-600
                                                            @else
                                                                bg-gray-50 text-gray-600
                                                            @endif
                                                        ">
                                                            {{ 
                                                                match ($type->level) {
                                                                    App\Models\RegistrationType::LEVEL_PARTICIPANT => 'Participant',
                                                                    App\Models\RegistrationType::LEVEL_AUTHOR => 'Author',
                                                                    default => 'None',
                                                                }    
                                                            }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @php
                                                            $typeCostFormatted = moneyOrFree($type->cost, $type->currency, true);
                                                            $elementID = Str::slug($type->type)
                                                        @endphp
                                                        <div class="flex items-center gap-3">
                                                            @if($isLogged)
                                                                @if ($type->level !== App\Models\RegistrationType::LEVEL_AUTHOR)
                                                                    <label class="relative flex items-center cursor-pointer">
                                                                        <input 
                                                                            class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-indigo-600 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-indigo-600 before:opacity-0 before:transition-opacity checked:border-indigo-600 checked:before:bg-indigo-600 hover:before:opacity-10"
                                                                            id="{{ $elementID }}" 
                                                                            type="radio" 
                                                                            wire:model="type" 
                                                                            value="{{ $type->id }}" 
                                                                            @disabled(!$type->isOpen())
                                                                        >
                                                                        <span class="absolute text-indigo-600 transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16" fill="currentColor">
                                                                                <circle data-name="ellipse" cx="8" cy="8" r="8"></circle>
                                                                            </svg>
                                                                        </span>
                                                                    </label>
                                                                @else
                                                                    <div class="tooltip" data-tip="This registration type is for information only">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                        </svg>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                            <label @class([
                                                                'font-medium text-gray-900',
                                                                'cursor-pointer' => $type->isOpen() && $type->level !== App\Models\RegistrationType::LEVEL_AUTHOR
                                                            ]) for="{{ $elementID }}">
                                                                {{ $typeCostFormatted }}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @if ($registrationTypeList->isEmpty())
                                            <tr>
                                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                                    {{ __('general.registration_type_are_empty') }}
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @error('type')
                                <div class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @empty(!$currentScheduledConference->getMeta('registration_policy'))
                            <div class="border-t border-gray-100 p-6">
                                <div class="prose prose-sm max-w-none user-content">
                                    {!! new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('registration_policy')) !!}
                                </div>
                            </div>
                        @endempty

                        <!-- User Information Section -->
                        <div class="border-t border-gray-100 p-6">
                            @if ($isLogged)
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                        {{ __('general.this_is_your_detailed_account_information') }}
                                    </h3>
                                    <div class="grid gap-4">
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.name') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $userModel->full_name }}</div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.email') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $userModel->email }}</div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.affiliation') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $userModel->getMeta('affiliation') ?? '-' }}</div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.phone') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $userModel->getMeta('phone') ?? '-' }}</div>
                                        </div>
                                        @if($userCountry)
                                            <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                                <div class="col-span-3 text-gray-500">{{ __('general.country') }}</div>
                                                <div class="col-span-9 font-medium text-gray-900">{{ $userCountry->flag . ' ' . $userCountry->name }}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mt-4 text-sm text-gray-500">
                                        {{ __('general.if_you_feel_this_is_not_your_account_please_log_out_and_use_your_account') }}
                                    </p>
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-600">
                                            {!! __('general.currently_not_logged_in', ['url' => app()->getLoginUrl() ]) !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="border-t border-gray-100 p-6 bg-gray-50 rounded-b-2xl">
                            <div class="flex justify-end gap-3">
                                <button 
                                    type="submit" 
                                    @class([
                                        'inline-flex items-center px-6 py-3 rounded-lg text-sm font-semibold transition-all duration-200',
                                        'read-more text-white hover:bg-indigo-700' => $isLogged && !$registrationTypeList->isEmpty(),
                                        'bg-gray-100 text-gray-400 cursor-not-allowed' => !$isLogged || $registrationTypeList->isEmpty(),
                                    ]) 
                                    x-data 
                                    x-on:click="window.scrollTo(0, 0)" 
                                    wire:loading.attr="disabled"
                                    {{ !$isLogged || $registrationTypeList->isEmpty() ? 'disabled' : '' }}
                                >
                                    <span class="loading loading-spinner loading-sm mr-2" wire:loading></span>
                                    {{ __('general.register_now') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @else
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                            <div class="space-y-6">
                                <div>
                                    <p class="text-gray-600">
                                        {{ __('general.these_are_your_registration_details') }}
                                    </p>
                                    <div class="mt-4 space-y-3">
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.type') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $registrationType->type }}</div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.description') }}</div>
                                            <div class="col-span-9">{{ $registrationType->getMeta('description') ?? '-' }}</div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.cost') }}</div>
                                            <div class="col-span-9">{{ moneyOrFree($registrationType->cost, $registrationType->currency, true) }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="prose prose-sm max-w-none">
                                    <p>{!! __('general.is_mistake_you_can_cancel') !!}</p>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                        {{ __('general.please_double_check_your_account') }}
                                    </h3>
                                    <div class="grid gap-4">
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.name') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $userModel->full_name }}</div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.email') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $userModel->email }}</div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.affiliation') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $userModel->getMeta('affiliation') ?? '-' }}</div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                            <div class="col-span-3 text-gray-500">{{ __('general.phone') }}</div>
                                            <div class="col-span-9 font-medium text-gray-900">{{ $userModel->getMeta('phone') ?? '-' }}</div>
                                        </div>
                                        @if($userCountry)
                                            <div class="grid grid-cols-12 gap-4 p-4 bg-white rounded-lg">
                                                <div class="col-span-3 text-gray-500">{{ __('general.country') }}</div>
                                                <div class="col-span-9 font-medium text-gray-900">{{ $userCountry->flag . ' ' . $userCountry->name }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @empty(!$currentScheduledConference->getMeta('payment_policy'))
                                    <div class="rounded-xl border border-gray-100 p-6">
                                        <div class="prose prose-sm max-w-none user-content">
                                            {!! $currentScheduledConference->getMeta('payment_policy') !!}
                                        </div>
                                    </div>
                                @endempty

                                <div class="flex justify-end gap-3">
                                    <button 
                                        type="button" 
                                        class="inline-flex items-center px-6 py-3 rounded-lg text-sm font-semibold bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200" 
                                        wire:click="cancel" 
                                        x-data 
                                        x-on:click="window.scrollTo(0, 0)"
                                    >
                                        {{ __('general.cancel') }}
                                    </button>
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center px-6 py-3 rounded-lg text-sm font-semibold read-more text-white hover:bg-indigo-700 transition-all duration-200" 
                                        wire:click="confirm" 
                                        wire:loading.attr="disabled"
                                    >
                                        <span class="loading loading-spinner loading-sm mr-2" wire:loading></span>
                                        {{ __('general.confirm') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
        @else
            <div class="mt-8 p-8 bg-white rounded-2xl shadow-xl border border-gray-100 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <p class="text-xl font-semibold text-gray-900">
                    {{ __('general.registration_are_closed') }}
                </p>
            </div>
        @endif
    </div>
</x-tempest::layouts.main>