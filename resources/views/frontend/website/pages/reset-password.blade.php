<x-tempest::layouts.main class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="container mx-auto px-4 max-w-lg">
        <div class="mb-8">
            <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 space-y-6">
            <div class="relative">
                <div class="flex items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">{{ __('general.reset_password') }}</h1>
                </div>
            </div>

            @if(!$success)
                <form wire:submit='submit' class="space-y-6">
                    @error('throttle')
                        <div class="p-4 rounded-md bg-red-50">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ $message }}</p>
                                </div>
                            </div>
                        </div>
                    @enderror

                    <p class="text-sm text-gray-600">
                        {{ __('general.please_enter_email_to_reset_password') }}
                    </p>

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            {{ __('general.email') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            wire:model="email"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                            required 
                        />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button 
                            type="submit" 
                            class="inline-flex bg-gray-600 justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed"
                            wire:loading.attr="disabled"
                        >
                            <span class="loading loading-spinner loading-xs mr-2" wire:loading></span>
                            {{ __('general.reset_password') }}
                        </button>

                        @if($registerUrl)
                            <x-tempest::link 
                                class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                                :href="$registerUrl"
                            >
                                {{ __('general.register') }}
                            </x-tempest::link>
                        @endif
                    </div>
                </form>
            @else 
                <div class="space-y-6">
                    <div class="rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    {{ __('general.reset_password_mail_sent') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <x-tempest::link 
                        class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                        :href="app()->getLoginUrl()"
                    >
                        {{ __('general.login') }}
                    </x-tempest::link>
                </div>
            @endif
        </div>
    </div>
</x-tempest::layouts.main>