@if ($currentScheduledConference)
	<div class="py-6 sm:py-12">
		<div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
			<div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-200 pb-4 sm:pb-6 mb-6 sm:mb-10 space-y-3 sm:space-y-0">
				<div>
					<div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
						<h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Latest News</h1>
						<span class="tag-ann inline-flex items-center px-2.5 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium w-fit">
							Latest Updates
						</span>
					</div>
				</div>
				
				<a href="{{ route('livewirePageGroup.scheduledConference.pages.announcements') }}" 
				class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-md bg-white border border-gray-300 hover:bg-gray-50 transition duration-150 text-xs sm:text-sm font-medium text-gray-700 w-fit">
					View All
					<svg class="ml-1.5 sm:ml-2 w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</a>
			</div>
			
			<div class="grid gap-4 sm:gap-6 lg:gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
			@php
				$latestAnnouncements = $currentScheduledConference->announcements
					->filter(function ($announcement) {
						return is_null($announcement->expires_at) || $announcement->expires_at > now();
					})
					->sortByDesc('created_at')
					->take(3);
			@endphp
			



				@forelse ($latestAnnouncements as $announcement)
					@php
						$content = $announcement->getMeta('content');
						preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);
						$imageUrl = $matches[1] ?? '/storage/default-image.jpg';
					@endphp

					<div class="group bg-white rounded-lg sm:rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100">
						<div class="relative">
							<div class="aspect-w-16 aspect-h-9">
								<?php if($imageUrl): ?>
									<img src="{{ $imageUrl }}" 
										alt="{{ $announcement->title }}"
										class="w-full h-40 sm:h-48 object-cover object-center transform group-hover:scale-105 transition duration-500"
										onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
									<div class="hidden w-full h-40 sm:h-48 bg-gray-200 items-center justify-center">
										<div class="metallic-container">
											<i class="fas fa-image metallic-icon"></i>
											<span class="metallic-text">Image Not Available</span>
										</div>
									</div>
								<?php else: ?>
									<div class="w-full h-40 sm:h-48 bg-gray-600 flex items-center justify-center">
										<div class="metallic-container">
											<i class="fas fa-image metallic-icon"></i>
											<span class="metallic-text">Image Not Available</span>
										</div>
									</div>
								<?php endif; ?>
							</div>
							<div class="absolute top-0 right-0 mt-2 sm:mt-4 mr-2 sm:mr-4">
								@if($announcement->getMeta('important', false))
									<span class="inline-flex items-center px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-xs font-medium bg-red-100 text-red-800">
										Important
									</span>
								@endif
							</div>
						</div>

						<div class="group p-4 sm:p-6">
							<div class="flex items-center text-xs sm:text-sm text-gray-500 mb-2 sm:mb-3">
								<svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
										d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
								</svg>
								{{ $announcement->created_at->format(Setting::get('format_date')) }}
							</div>

							<div class="group">
								<h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2 sm:mb-3 transition duration-300">
								<a href="{{ route('livewirePageGroup.scheduledConference.pages.announcement-page', ['announcement' => $announcement->id]) }}" 
									class="hover:underline decoration-2 decoration-blue-500 underline-offset-2">
									{{ $announcement->title }}
								</a>
								</h2>
							</div>
							

							<p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-3 sm:mb-4 line-clamp-3">
								{{ $announcement->getMeta('summary') }}
							</p>

							<div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-gray-100">
								<a href="{{ route('livewirePageGroup.scheduledConference.pages.announcement-page', ['announcement' => $announcement->id]) }}" 
								class="read-full-ann inline-flex items-center font-medium text-sm group/link">
									Read full
									<svg class="ml-1.5 sm:ml-2 w-3 h-3 sm:w-4 sm:h-4 transform group-hover/link:translate-x-1 transition-transform duration-200" 
										fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
									</svg>
								</a>
							</div>
						</div>
					</div>
				@empty
					<div class="col-span-full flex flex-col items-center justify-center py-8 sm:py-12 text-center">
						<svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-400 mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
								d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
						</svg>
						<h3 class="text-base sm:text-lg font-medium text-gray-900 mb-1 sm:mb-2">No announcements available</h3>
						<p class="text-gray-500 text-xs sm:text-sm">Check back later for new updates and announcements.</p>
					</div>
				@endforelse
			</div>
		</div>
	</div>
@endif
