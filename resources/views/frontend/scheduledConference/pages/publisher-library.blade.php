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
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 break-words sm:break-normal">
                                {{ $this->getTitle() }}
                            </h1>
                        </div>
                    </div>
                </div>

               
                <div class="library-container">
                    @if($publisherLibraries->isNotEmpty())
                        <ul class="library-list">
                            @foreach($publisherLibraries as $media)
                                <li class="library-item">
                                    <a href="{{ route(App\Frontend\ScheduledConference\Pages\PublisherLibraryDownload::getRouteName(), ['media' => $media->uuid]) }}" 
                                       class="library-link">
                                        <div class="icon-wrapper">
                                            <svg class="download-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div class="content-wrapper">
                                            <span class="media-name">{{ $media->name }}</span>
                                            <span class="download-badge">Download</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-content">
                                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p class="empty-text">{{ __('general.no_publisher_library_available') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                
                <style>
                .library-container {
                    max-width: 64rem;
                    margin: 0 auto;
                    padding: 1rem;
                    background: white;
                    border-radius: 0.75rem;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                }
                
                .library-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    border-radius: 0.5rem;
                }
                
                .library-item {
                    border-bottom: 1px solid #f3f4f6;
                }
                
                .library-item:last-child {
                    border-bottom: none;
                }
                
                .library-link {
                    display: flex;
                    align-items: center;
                    padding: 1rem;
                    gap: 1rem;
                    text-decoration: none;
                    transition: background-color 0.2s;
                    border-radius: 0.5rem;
                }
                
                .library-link:hover {
                    background-color: #f9fafb;
                }
                
                .icon-wrapper {
                    flex-shrink: 0;
                    padding: 0.75rem;
                    background-color: #eef2ff;
                    border-radius: 0.5rem;
                    transition: background-color 0.2s;
                }
                
                .library-link:hover .icon-wrapper {
                    background-color: #e0e7ff;
                }
                
                .download-icon {
                    width: 1.5rem;
                    height: 1.5rem;
                    color: #4f46e5;
                }
                
                .content-wrapper {
                    flex: 1;
                    min-width: 0;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 1rem;
                }
                
                .media-name {
                    font-size: 0.975rem;
                    font-weight: 500;
                    color: #111827;
                    word-break: break-word;
                    transition: color 0.2s;
                }
                
                .library-link:hover .media-name {
                    color: #4f46e5;
                }
                
                .download-badge {
                    flex-shrink: 0;
                    padding: 0.375rem 0.75rem;
                    font-size: 0.75rem;
                    font-weight: 500;
                    color: #4f46e5;
                    background-color: #eef2ff;
                    border-radius: 9999px;
                    transition: background-color 0.2s;
                }
                
                .library-link:hover .download-badge {
                    background-color: #e0e7ff;
                }
                
                .empty-state {
                    padding: 3rem 1rem;
                }
                
                .empty-state-content {
                    max-width: 32rem;
                    margin: 0 auto;
                    padding: 2rem;
                    background-color: #f9fafb;
                    border-radius: 1rem;
                    text-align: center;
                }
                
                .empty-icon {
                    width: 3rem;
                    height: 3rem;
                    margin: 0 auto;
                    color: #9ca3af;
                }
                
                .empty-text {
                    margin-top: 1rem;
                    font-size: 1rem;
                    font-weight: 500;
                    color: #6b7280;
                }
                
                @media (max-width: 640px) {
                    .library-container {
                        padding: 0.75rem;
                    }
                    
                    .library-link {
                        padding: 0.75rem;
                    }
                    
                    .icon-wrapper {
                        padding: 0.5rem;
                    }
                    
                    .download-icon {
                        width: 1.25rem;
                        height: 1.25rem;
                    }
                    
                    .media-name {
                        font-size: 0.875rem;
                    }
                    
                    .download-badge {
                        padding: 0.25rem 0.625rem;
                        font-size: 0.75rem;
                    }
                    
                    .empty-state {
                        padding: 2rem 0.75rem;
                    }
                    
                    .empty-icon {
                        width: 2.5rem;
                        height: 2.5rem;
                    }
                    
                    .empty-text {
                        font-size: 0.875rem;
                    }
                }
                </style>
                </div>
        </main>
    </div>
</x-tempest::layouts.main>