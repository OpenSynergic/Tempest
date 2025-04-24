<x-tempest::layouts.main>
    <div class="min-h-screen">
        <div class="relative mt-10">
            <div class="container flex mb-5 space-x-4">
                <h1 class="text-3xl font-semibold min-w-fit">{{ $this->getTitle() }}</h1>
                <hr class="w-full h-px my-auto bg-gray-200 border-0 dark:bg-gray-700">
            </div>
            @php
                $layouts = App\Facades\Plugin::getPlugin('Tempest')->getSetting('layouts');

            @endphp
            @if ($layouts)
                @foreach ($layouts as $layout)
                    <div class="contents-container mt-10">
                        {{ new Illuminate\Support\HtmlString($layout['data']['about']) }}
                    </div>
                @endforeach
            @else
                <div class="max-w-md mx-auto">
                    <div class="flex justify-center mb-4">
                        <div class="p-3 bg-gray-100 rounded-full">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-tempest::layouts.main>
