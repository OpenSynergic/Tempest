@php
    $primaryNavigationItems = app()->getNavigationItems('primary-navigation-menu');
    $userNavigationMenu = app()->getNavigationItems('user-navigation-menu');
@endphp
    
@if(app()->getCurrentConference() || app()->getCurrentScheduledConference())
<div id="navbar" class="fixed w-full top-0 z-50 transition-all text-lg shadow-lg font-extrabold duration-100">
    <div class="backdrop-blur-md py-5 transition-all duration-100">
        <div class="navbar mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="navbar flex items-center justify-between w-full">
                <div class="navbar-starts flex items-center gap-4">
                    <x-website::navigation-menu-mobile class="lg:hidden" />
                    <x-website::logo :headerLogo="$headerLogo"/>
                </div>

                <div class="hidden  lg:flex items-center gap-8 ">
                    <div class="nav-menu flex items-center">
                    <x-website::navigation-menu 
                        :items="$primaryNavigationItems" 
                        class="main-nav flex items-center gap-6" />
                    </div>
                    
                    <div class="user-nav flex items-center">
                        <x-tempest::navigation-menu 
                            :items="$userNavigationMenu"
                            class="flex items-center gap-4" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="h-20"></div>
@endif
 
<script>

function handleNavbarScroll() {
    const navbar = document.getElementById('navbar');
    const scrollPosition = window.scrollY;

    if (scrollPosition > 50) {
        navbar.classList.remove('bg-black/50', 'text-white');
        navbar.classList.add('bg-white', 'text-black');
    } else {
        navbar.classList.remove('bg-white', 'text-black');
        navbar.classList.add('bg-black/50', 'text-white');
    }
}

window.addEventListener('scroll', handleNavbarScroll);
handleNavbarScroll();
</script>
