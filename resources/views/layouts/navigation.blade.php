<nav x-data="{ open: false }" class="bg-m3-surface/80 backdrop-blur-xl border-b border-m3-outline sticky top-0 z-[100]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-m3-primary text-m3-on-primary rounded-m3-large flex items-center justify-center shadow-m3-1 transform group-hover:rotate-6 transition-all duration-500">
                            <span class="font-black text-xl">P</span>
                        </div>
                        <span class="text-xl font-black text-m3-on-surface tracking-tighter">puntuaTuProfe</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:flex items-center">
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-4 py-2 rounded-m3-full">
                            {{ __('Panel') }}
                        </x-nav-link>
                    @endauth
                    <x-nav-link :href="route('teachers.index')" :active="request()->routeIs('teachers.index') || request()->routeIs('teachers.show')" class="px-4 py-2 rounded-m3-full">
                        {{ __('Profesores') }}
                    </x-nav-link>
                    
                    @if(auth()->user()?->is_admin)
                        <div class="h-6 w-px bg-m3-outline mx-2"></div>
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="px-4 py-2 rounded-m3-full">
                            {{ __('Admin') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="m3-btn-tonal !py-2 !px-4 flex items-center gap-2">
                                    <div class="w-6 h-6 bg-m3-primary/10 rounded-full flex items-center justify-center text-[10px] text-m3-primary font-black">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')" class="font-bold">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            class="text-red-600 font-bold"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-m3-on-surface-variant hover:text-m3-primary transition-all">Ingresar</a>
                        <a href="{{ route('register') }}" class="m3-btn-filled !py-2 !px-6 shadow-m3-1 hover:shadow-m3-2">Comenzar</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-m3-large text-m3-on-surface-variant hover:bg-m3-surface-variant transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-m3-surface border-t border-m3-outline">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-m3-large font-bold">
                    {{ __('Panel') }}
                </x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link :href="route('teachers.index')" :active="request()->routeIs('teachers.index')" class="rounded-m3-large font-bold">
                {{ __('Profesores') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-m3-outline">
                <div class="px-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-m3-primary/10 rounded-full flex items-center justify-center text-m3-primary font-black">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-base text-m3-on-surface">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-m3-on-surface-variant">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1 px-4 pb-4">
                    <x-responsive-nav-link :href="route('profile.edit')" class="rounded-m3-large font-bold">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                class="rounded-m3-large text-red-600 font-bold"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="p-4 flex flex-col gap-2 border-t border-m3-outline">
                <a href="{{ route('login') }}" class="m3-btn-tonal w-full">Ingresar</a>
                <a href="{{ route('register') }}" class="m3-btn-filled w-full">Comenzar</a>
            </div>
        @endauth
    </div>
</nav>
