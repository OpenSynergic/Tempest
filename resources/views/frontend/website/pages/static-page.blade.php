<x-tempest::layouts.main>
    <div class="min-h-screen">
        <main class="min-h-screen py-8">
            <div class="container mx-auto px-4 max-w-6xl space-y-6">
               
                <nav class="bg-white rounded-lg shadow-sm">
                    <div class="mb-8">
                    <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="text-xs sm:text-sm bg-white rounded-lg shadow-sm px-2 sm:px-4 py-2 sm:py-3 font-medium overflow-x-auto" />
                    </div>
                </nav>
           
                <div class="bg-white rounded-xl p-4 sm:p-6 lg:p-8 shadow-lg border border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">
                        <div class="flex-shrink-0 inline-flex">
                            <div class="p-2 sm:p-3 bg-primary-100 rounded-xl">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 break-words sm:break-normal">{{ $title }}</h1>
                        </div>
                    </div>
                </div>

            @if ($content)
                <div class="bg-white rounded-xl shadow-sm drop-shadow-2xl border border-gray-100 overflow-hidden">
                    <div class="p-8">
                        <div class="user-content prose prose-lg max-w-none">
                            {{ new Illuminate\Support\HtmlString($content) }}
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm drop-shadow-2xl border border-gray-100 p-8 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="flex justify-center mb-4">
                            <div class="p-3 bg-gray-100 rounded-full">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            {{ __('general.no_content_provided') }}
                        </h3>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .user-content {
            color: #1a1a1a;
        }
        
        .user-content h1 {
            @apply text-3xl font-bold mb-6 text-gray-900;
        }
        
        .user-content h2 {
            @apply text-2xl font-semibold mb-4 mt-8 text-gray-900;
        }
        
        .user-content h3 {
            @apply text-xl font-semibold mb-3 mt-6 text-gray-900;
        }
        
        .user-content p {
            @apply mb-4 leading-relaxed text-gray-700;
        }
        
        .user-content ul {
            @apply mb-4 list-disc list-inside text-gray-700;
        }
        
        .user-content ol {
            @apply mb-4 list-decimal list-inside text-gray-700;
        }
        
        .user-content li {
            @apply mb-2;
        }
        
        .user-content a {
            @apply text-primary-600 hover:text-primary-700 underline;
        }
        
        .user-content blockquote {
            @apply pl-4 border-l-4 border-gray-200 italic my-4 text-gray-600;
        }
        
        .user-content code {
            @apply bg-gray-100 rounded px-1 py-0.5 text-sm font-mono text-gray-800;
        }
        
        .user-content pre {
            @apply bg-gray-100 rounded-lg p-4 overflow-x-auto mb-4;
        }
        
        .user-content img {
            @apply rounded-lg shadow-sm max-w-full h-auto my-4;
        }
        
        .user-content table {
            @apply w-full border-collapse mb-4;
        }
        
        .user-content th,
        .user-content td {
            @apply border border-gray-200 px-4 py-2 text-left;
        }
        
        .user-content th {
            @apply bg-gray-50 font-semibold;
        }

        .user-content {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-tempest::layouts.main>
