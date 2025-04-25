<x-tempest::layouts.main>
    <div class="min-h-screen container mx-auto px-4 max-w-6xl">
        <div class="relative mt-10">
            <div class="container flex mb-5 space-x-4">
                <h1 class="text-3xl font-semibold min-w-fit">{{ $this->getTitle() }}</h1>
                <hr class="w-full h-px my-auto bg-gray-200 border-0 dark:bg-gray-700">
            </div>
            @if ($about)
                <div class="user-content prose prose-lg max-w-none">
                    {{ new Illuminate\Support\HtmlString($about) }}
                </div>
            @else
                <div>
                    No information provided.
                </div>
            @endif
        </div>
    </div>
</x-tempest::layouts.main>
