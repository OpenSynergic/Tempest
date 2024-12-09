<x-tempest::layouts.main>
    <div class="mb-8">
    <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
    </div>
    <div class="relative">
        <div class="flex mb-5 space-x-4">
            <h1 class="text-xl font-semibold min-w-fit">{{ $title }}</h1>
            <hr class="w-full h-px my-auto bg-gray-200 border-0 dark:bg-gray-700">
        </div>
        @if ($content)
            <div class="user-content">
                {{ new Illuminate\Support\HtmlString($content) }}
            </div>
        @else
            <div>
                No content provided.
            </div>
        @endif
    </div>
</x-tempest::layouts.main>
