<x-tempest::layouts.main>
    <div class="min-h-screen">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Enhanced Breadcrumbs -->
            <div class="mb-8">
            <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
            </div>

            <div class="relative space-y-8">
                @if ($mailing_address)
                    <div id="mailing-address">
                        {{ $mailing_address }}
                    </div>
                @endif
                <div class="grid sm:grid-cols-2 justify-items-start gap-y-8">
                    <div id="chair-contact" class="space-y-2">
                        <h2 class="font-bold">{{ __('general.principal_contact') }}</h2>
                        <div class="text-sm">
                            <p>{{ $principal_contact_name }}</p>
                            @if ($principal_contact_affiliation)
                                <p>{{ $principal_contact_affiliation }}</p>
                            @endif
                        </div>
                        @if ($principal_contact_phone)
                            <div class="text-sm">
                                <p class="font-bold">{{ __('general.phone') }}</p>
                                <p>
                                    {{ $principal_contact_phone }}
                                </p>
                            </div>
                        @endif
                        @if ($principal_contact_email)
                            <div class="text-sm">
                                <p class="font-bold">{{ __('general.email') }}</p>
                                <p>
                                    {{ $principal_contact_email }}
                                </p>
                            </div>
                        @endif
                    </div>
                    <div id="support-contact" class="space-y-2">
                        <h2 class="font-bold">{{ __('general.technical_support_contact') }}</h2>
                        <div class="text-sm">
                            <p>{{ $support_contact_name }}</p>
                        </div>
                        @if ($support_contact_phone)
                            <div class="text-sm">
                                <p class="font-bold">{{ __('general.phone') }}</p>
                                <p>
                                    {{ $support_contact_phone }}
                                </p>
                            </div>
                        @endif
                        @if ($support_contact_email)
                            <div class="text-sm">
                                <p class="font-bold">{{ __('general.email') }}</p>
                                <p>
                                    {{ $support_contact_email }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tempest::layouts.main>