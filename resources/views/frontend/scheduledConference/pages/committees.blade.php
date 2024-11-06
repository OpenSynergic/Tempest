<x-website::layouts.main>
    <div class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <x-tempest::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" class="breadcrumbs text-sm bg-white rounded-lg shadow-sm px-4 py-3 font-medium" />
        </div>
        <div class="flex mb-10 space-x-4 items-center">
            <h1 class="text-4xl font-extrabold text-gray-900 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">List Committee</h1>
            <hr class="flex-grow h-px bg-gradient-to-r from-blue-300 to-transparent border-0">
        </div>
        <div class="space-y-12">
            @forelse ($committeeRoles as $role)
                <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8 pb-3 border-b-2 border-gray-200 inline-block">{{ $role->name }}</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($role->committees as $committee)
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 group">
                                <div class="p-6">
                                    <div class="flex flex-col items-center space-y-4">
                                        <div class="relative">
                                            <img class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg group-hover:scale-105 transition-transform duration-300" 
                                                 src="{{ $committee->getFilamentAvatarUrl() }}"
                                                 alt="{{ $committee->fullName }}" />
                                            <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                                {{ $role->name }}
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-xl font-bold text-gray-900 mb-1">{{ $committee->fullName }}</p>
                                            @if ($committee->hasMeta('affiliation'))
                                                <span class="text-sm font-medium text-gray-700 bg-gray-100 px-3 py-1 rounded-full inline-block mb-2">{{ $committee->getMeta('affiliation') }}</span>
                                            @endif
                                            <button onclick="openModal('{{ $committee->fullName }}', '{{ $committee->getFilamentAvatarUrl() }}', '{{ $committee->getMeta('affiliation') }}')" 
                                                    class="mt-3 text-sm font-semibold text-blue-600 hover:text-blue-800 transition duration-300 ease-in-out flex items-center justify-center w-full bg-blue-50 hover:bg-blue-100 py-2 rounded-lg group">
                                                View Profile
                                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-gray-50 rounded-2xl border border-gray-200 shadow-inner">
                    <svg class="mx-auto h-20 w-20 text-gray-400 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-4 text-2xl font-bold text-gray-900">No committees found</h3>
                    <p class="mt-2 text-gray-600">Get started by creating a new committee.</p>
                    <button class="mt-6 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105">
                        Create Committee
                    </button>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Enhanced Modal -->
    <div id="profileModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full m-4 transform transition-all duration-300 scale-95 opacity-0">
            <div class="p-8">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition duration-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <img id="modalImage" class="mx-auto w-40 h-40 rounded-full object-cover border-4 border-blue-100 shadow-xl" src="" alt="">
                <h3 id="modalName" class="mt-6 text-3xl font-bold text-center text-gray-900"></h3>
                <p id="modalAffiliation" class="mt-2 text-center text-gray-600 font-medium"></p>
                <div class="mt-8 bg-gray-50 p-6 rounded-xl">
                    <h4 class="text-xl font-semibold text-gray-800 mb-3">About</h4>
                    <p class="text-gray-700 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                </div>
                <div class="mt-8 text-center">
                    <button onclick="closeModal()" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105">
                        Close Profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(name, imageUrl, affiliation) {
            const modal = document.getElementById('profileModal');
            const modalContent = modal.querySelector('div');
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalAffiliation').textContent = affiliation || 'No affiliation provided';
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('profileModal');
            const modalContent = modal.querySelector('div');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('profileModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</x-website::layouts.main>