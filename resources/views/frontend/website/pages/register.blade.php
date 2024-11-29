<x-tempest::layouts.main class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-green-50 py-12">
    <div class="container mx-auto px-4 max-w-lg">
        <div class="mb-8">
            <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
            <div class="reglog-head relative px-8 pt-8 pb-6">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-2xl font-bold bg-clip-text text-transparent">
                        {{ $this->getTitle() }}
                    </h1>
                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Create your account to get started.</p>
                <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
            </div>

            <div class="p-8">
                @if (!$registerComplete)
                    @if ($allowRegistration)
                    <form wire:submit='register' class="space-y-4">
                        @error('throttle')
                            <div class="text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror

                            <div class="grid gap-6 sm:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ __('general.given_name') }} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            wire:model="given_name"
                                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                            required
                                        />
                                    </div>
                                    @error('given_name')
                                        <p class="text-sm text-red-600 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ __('general.family_name') }}
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            wire:model="family_name"
                                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                        />
                                    </div>
                                    @error('family_name')
                                        <p class="text-sm text-red-600 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ __('general.affiliation') }}
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            wire:model="affiliation"
                                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                        />
                                    </div>
                                    @error('affiliation')
                                        <p class="text-sm text-red-600 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ __('general.country') }}
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <select 
                                            wire:model='country'
                                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300"
                                        >
                                            <option value="none" selected disabled>{{ __('general.select_country') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->flag . ' ' . $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('country')
                                        <p class="text-sm text-red-600 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ __('general.phone') }}
                                    </label>
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.7 2.3c.2-.2.5-.3.7-.3h3.4c.4 0 .7.3.7.7 0 1.2.2 2.3.7 3.3.1.3 0 .6-.2.8L6.4 8.5c1.1 2.2 2.8 3.9 5 5l1.7-1.7c.2-.2.5-.3.8-.2 1 .4 2.1.7 3.3.7.4 0 .7.3.7.7v3.4c0 .3-.1.5-.3.7s-.4.3-.7.3c-4.3 0-8.3-1.7-11.3-4.7S2 6.9 2 2.6c0-.3.1-.5.3-.7z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="tel" 
                                        class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                        wire:model="phone" 
                                    />
                                    @error('phone')
                                        <p class="text-sm text-red-600 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="text-xs text-gray-500">{{ __('general.phone_format_international') }}</p>
                                </div>
                                <label class="block text-sm font-medium text-gray-700">
                                    {{ __('general.email') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input 
                                        type="email" 
                                        wire:model="email"
                                        class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2  focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                        required
                                    />
                                </div>
                                @error('email')
                                    <p class="text-sm text-red-600 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="grid gap-6 sm:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ __('general.password') }} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input 
                                            type="password" 
                                            wire:model="password"
                                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                            required 
                                        />
                                    </div>
                                    @error('password')
                                        <p class="text-sm text-red-600 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ __('general.password_confirmation') }} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input 
                                            type="password" 
                                            wire:model="password_confirmation"
                                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                            required 
                                        />
                                    </div>
                                    @error('password_confirmation')
                                        <p class="text-sm text-red-600 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                             @if (isset($scheduledConference) && $scheduledConference)
                             <div class="space-y-3">
                                 <label class="block text-sm font-medium text-gray-700">
                                     {{ __('general.register_as') }} <span class="text-red-500">*</span>
                                 </label>
                                 <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                     @foreach ($roles as $role)
                                         <label class="flex items-center gap-2 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer transition-colors">
                                             <input 
                                                 type="checkbox" 
                                                 wire:model='selfAssignRoles' 
                                                 value="{{ $role }}"
                                                 class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500"
                                             />
                                             <span class="text-sm text-gray-700">{{ $role }}</span>
                                         </label>
                                     @endforeach
                                 </div>
                                 @error('selfAssignRoles')
                                     <p class="text-sm text-red-600">{{ $message }}</p>
                                 @enderror
                             </div>
                         @endif

                         @if (isset($scheduledConference) && !$scheduledConference)
                             <div class="space-y-6">
                                 <h3 class="text-sm font-medium text-gray-700">
                                     {{ __('general.which_conference_interested_for') }}
                                 </h3>
                                 <div class="space-y-4">
                                     @foreach ($conferences as $conference)
                                         <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                                             <label class="block font-medium text-gray-800 mb-3">
                                                 {{ $conference->name }}
                                             </label>
                                             <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                                 @foreach ($roles as $role)
                                                     <label class="flex items-center gap-2 p-3 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer transition-colors">
                                                         <input 
                                                             type="checkbox"
                                                             wire:model='selfAssignRoles.{{ $conference->id }}.{{ $role }}'
                                                             value="{{ $role }}"
                                                             class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500"
                                                         />
                                                         <span class="text-sm text-gray-700">{{ $role }}</span>
                                                     </label>
                                                 @endforeach
                                             </div>
                                         </div>
                                     @endforeach
                                 </div>
                             </div>
                         @endif

                         <div class="space-y-4">
                             <label class="flex items-center gap-3">
                                 <input 
                                     type="checkbox"
                                     wire:model="privacy_statement_agree"
                                     required   
                                     class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500"
                                 />
                                 <span class="text-sm text-gray-600">
                                     {!! __('general.privacy_statement_agree', ['url' => $privacyStatementUrl]) !!}
                                 </span>
                             </label>
                         </div>

                            <div class="space-y-3 pt-2">
                                <button 
                                    type="submit" 
                                    class="reglog-button w-full flex items-center justify-center px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200"
                                    wire:loading.attr="disabled"
                                >
                                    <span wire:loading class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin mr-2"></span>
                                    <span wire:loading.remove>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                        </svg>
                                    </span>
                                    {{ __('general.register') }}
                                </button>
                                
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-200"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-2 bg-white text-gray-500">or</span>
                                    </div>
                                </div>

                                <x-tempest::link 
                                    class="w-full flex items-center justify-center px-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium transition-all duration-200"
                                    :href="$loginUrl"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('general.login') }}
                                </x-tempest::link>
                            </div>
                        </form>
                    @else
                        <p class="text-center text-gray-600">{{ __('general.registration_closed') }}</p>
                    @endif
                @else
                    <div class="space-y-4">
                        <p class="text-center text-gray-600">{{ __('general.registration_complete_message') }}</p>
                        <ul class='list-disc list-inside space-y-2'>
                            <li>
                                <x-tempest::link class="text-green-600 hover:text-green-700 hover:underline" href="{{ route('filament.scheduledConference.pages.profile') }}">
                                    {{ __('general.edit_my_profile') }}
                                </x-tempest::link>
                            </li>
                            <li>
                                <x-tempest::link class="text-green-600 hover:text-green-700 hover:underline" href="{{ $homeUrl }}">
                                    {{ __('general.continue_browsing') }}
                                </x-tempest::link>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-tempest::layouts.main>