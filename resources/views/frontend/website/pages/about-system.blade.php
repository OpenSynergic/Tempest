<x-tempest::layouts.main>
    <nav class="bg-white rounded-lg shadow-sm">
        <div class="mb-8">
        <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
        </div>
    </nav>
    <div class="relative">
        <div class="flex mb-5 space-x-4">
            <h1 class="text-xl font-semibold min-w-fit">{{ $this->getTitle() }}</h1>
            <hr class="w-full h-px my-auto bg-gray-200 border-0 dark:bg-gray-700">
        </div>
        <div class="user-content">
            This {{ $name }} utilizes the <a href="https://leconfe.com">Leconfe</a> platform, an open-source conference management software. Developed, maintained, and freely distributed by Open Synergic under the GNU General Public License, Leconfe offers a robust solution for organizing and managing conferences. For more information about the platform, please visit the <a href="https://leconfe.com">Leconfe</a> website.
        </div>
    </div>
</x-tempest::layouts.main>
