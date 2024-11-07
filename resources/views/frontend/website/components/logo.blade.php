@props([
    'homeUrl' => url('/'),
    'headerLogo' => null,
    'headerLogoAltText' => config('app.name'),
])

@if ($headerLogo)
    <x-tempest::link {{ $attributes }} :href="$homeUrl">
        <img
            src="{{ $headerLogo }}"
            alt="{{ $headerLogoAltText }}"
            class="max-h-12 w-auto"
        />
    </x-tempest::link>
@else
    <x-tempest::link
        :href="$homeUrl"
        {{ $attributes->merge(['class' => 'text-lg sm:text-lg']) }}
    >
        {{ $headerLogoAltText }}
    </x-tempest::link>
@endif