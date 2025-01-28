<header class="bg-blue-900 text-white p-4" x-data="{ open: false }">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Workhive</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
            <!-- Login, Register, Dashboard: icon -->
            <x-nav-link url='/' :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link url='/jobs' :active="request()->is('jobs')">All Jobs</x-nav-link>
            @auth
                <x-nav-link url='/bookmarks' :active="request()->is('bookmarks')">Saved Jobs</x-nav-link>
                {{-- <x-nav-link url='/dashboard' :active="request()->is('dashboard')" icon="gauge">Dashboard</x-nav-link> --}}
                <x-logout />
                <x-button-link url='/jobs/create' icon="edit">
                    Create Job
                </x-button-link>

                <!-- User Avatar -->
                <div class="flex-items-center space-x-3">
                    <a href="{{ route('dashboard') }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-10 h-10 rounded-full" />
                        @else
                            <img src="{{ asset('storage/avatars/default-avatar.png') }}" class="w-10 h-10 rounded-full" />
                        @endif
                    </a>
                </div>
                <!-- End -->
            @else
                <x-nav-link url='/login' :active="request()->is('login')">Login</x-nav-link>
                <x-nav-link url='/register' :active="request()->is('register')">Register</x-nav-link>
            @endauth
        </nav>
        <button @click="open = !open" id="hamburger" class="text-white md:hidden flex items-center">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav id="mobile-menu" class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2" x-show="open"
        @click.outside="open = false">
        <x-nav-link url='/jobs' :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>
        @auth
            <x-nav-link url='/bookmarks' :active="request()->is('bookmarks')" :mobile="true">Saved Jobs</x-nav-link>
            <x-nav-link url='/dashboard' :active="request()->is('dashboard')" :mobile="true" icon='gauge'>Dashboard</x-nav-link>
            <x-logout class="pl-4 pb-3" />
            <x-button-link url='/jobs/create' icon='edit' :block="true">Create Job</x-button-link>
        @else
            <x-nav-link url='/login' :active="request()->is('login')" :mobile="true">Login</x-nav-link>
            <x-nav-link url='/register' :active="request()->is('register')" :mobile="true">Register</x-nav-link>
        @endauth
    </nav>
</header>
