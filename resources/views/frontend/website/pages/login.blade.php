<x-tempest::layouts.main>
    <div class="container mx-auto px-4 max-w-lg mb-20">
        <div class="mb-8">
            <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-green-100 overflow-hidden">
            <div class="reglog-head relative px-8 pt-8 pb-6">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-2xl font-bold">
                        {{ __('general.login') }}
                    </h1>
                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Welcome back! Please enter your credentials.</p>
                <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
            </div>

            <div class="p-8">
                <form wire:submit='login' class="space-y-6">
                    @error('throttle')
                        <div class="p-4 rounded-lg bg-red-50 border border-red-100 text-sm text-red-600 flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="space-y-2">
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
                                name="email" 
                                wire:model="email"
                                class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                placeholder="Enter your email"
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
                                name="password" 
                                wire:model="password"
                                class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-colors" 
                                placeholder="Enter your password"
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

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2">
                            <input 
                                type="checkbox" 
                                wire:model='remember'
                                class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500"
                            />
                            <span class="text-sm text-gray-600">{{ __('general.remember_me') }}</span>
                        </label>
                        <x-tempest::link 
                            :href="$resetPasswordUrl" 
                            class="text-sm text-gray-600 hover:text-red-700 font-medium hover:underline transition-colors"
                        >
                            {{ __('general.forgot_password_question') }}
                        </x-tempest::link>
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
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            {{ __('general.login') }}
                        </button>
                        
                        @if($registerUrl)
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
                                :href="$registerUrl"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                                {{ __('general.register') }}
                            </x-tempest::link>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-tempest::layouts.main>