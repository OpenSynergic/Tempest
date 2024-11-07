@props([
    'breadcrumbs' => [],
])

@if(!empty($breadcrumbs))
<nav {{ $attributes->class(['bg-white shadow-sm rounded-lg px-4 py-3']) }} aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-2 text-sm">
        @foreach ($breadcrumbs as $url => $label)
            <li class="flex items-center">
                @if(!is_int($url))
                    <x-tempest::link 
                        :href="$url" 
                        class="text-gray-600 transition-colors duration-200"
                        {{-- wire:navigate --}}
                    >
                        {{ $label }}
                    </x-tempest::link>
                @else
                    <span class="">{{ $label }}</span>
                @endif

                @if(!$loop->last)
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif