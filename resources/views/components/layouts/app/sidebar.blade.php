<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar 
            sticky 
            stashable 
            class="border-e border-zinc-200 dark:border-zinc-700" 
            x-data="{ sidebarColor: '{{ session('selected_color', '#5352ed') }}' }" 
            x-bind:style="'background-color: ' + sidebarColor"
            @color-updated.window="sidebarColor = $event.detail.color"
        >
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <img
                    src="{{ asset('images/mhs.png') }}"
                    alt="{{ config('app.name', 'Laravel') }} Logo"
                    class="h-8 w-auto object-contain"
                    style="width: 20%; height: auto;"
                />
            </a>

            {{-- ======================= START: BAGIAN MENU UTAMA ======================= --}}
            <flux:navlist.group :heading="__('Platform')" class="grid">
                {{-- Loop untuk menampilkan menu utama dari database --}}
                @isset($dynamicMenus)
                    @foreach ($dynamicMenus->where('parent_id', null) as $menu)
                        <div x-data="{ open: localStorage.getItem('menu_{{{ $menu->id }}}') === 'true' }" class="relative">
                            <div class="flex items-center w-full">
                                {{-- Parent Menu with Arrow Outside --}}
                                @if (Route::has($menu->route))
                                    <flux:navlist.item 
                                        :icon="$menu->icon" 
                                        :href="route($menu->route)" 
                                        :current="request()->routeIs($menu->route)" 
                                        wire:navigate
                                        class="flex-1">
                                        {{ __($menu->name) }}
                                    </flux:navlist.item>
                                    @if($menu->submenus->count())
                                        <button @click.stop.prevent="open = !open; localStorage.setItem('menu_{{{ $menu->id }}}', open)" class="ml-2 focus:outline-none">
                                            <svg x-bind:class="{ 'rotate-180': open }" class="h-5 w-5 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    @endif
                                @else
                                    <flux:navlist.item 
                                        :icon="$menu->icon" 
                                        href="#"
                                        title="Route '{{ $menu->route }}' untuk menu ini belum dibuat"
                                        class="flex-1 opacity-60 cursor-not-allowed">
                                        {{ __($menu->name) }}
                                    </flux:navlist.item>
                                    @if($menu->submenus->count())
                                        <button @click.stop.prevent="open = !open; localStorage.setItem('menu_{{{ $menu->id }}}', open)" class="ml-2 focus:outline-none">
                                            <svg x-bind:class="{ 'rotate-180': open }" class="h-5 w-5 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    @endif
                                @endif
                            </div>

                            {{-- Submenu Accordion with Dynamic Background --}}
                            @if($menu->submenus->count())
                                <div x-show="open" 
                                     x-transition:enter="transition ease-in-out duration-300" 
                                     x-transition:enter-start="opacity-0 -translate-y-4" 
                                     x-transition:enter-end="opacity-100 translate-y-0" 
                                     x-transition:leave="transition ease-in-out duration-250" 
                                     x-transition:leave-start="opacity-100 translate-y-0" 
                                     x-transition:leave-end="opacity-0 -translate-y-4" 
                                     class="pl-6"
                                     x-bind:style="'background-color: ' + sidebarColor">
                                    @foreach($menu->submenus as $submenu)
                                        @if (Route::has($submenu->route))
                                            <flux:navlist.item 
                                                :icon="$submenu->icon" 
                                                :href="route($submenu->route)" 
                                                :current="request()->routeIs($submenu->route)" 
                                                wire:navigate
                                                class="py-2 text-sm">
                                                {{ __($submenu->name) }}
                                            </flux:navlist.item>
                                        @else
                                            <flux:navlist.item 
                                                :icon="$submenu->icon" 
                                                href="#"
                                                title="Route '{{ $submenu->route }}' untuk menu ini belum dibuat"
                                                class="py-2 text-sm opacity-60 cursor-not-allowed">
                                                {{ __($submenu->name) }}
                                            </flux:navlist.item>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endisset

                {{-- Menu statis untuk link ke halaman manajemen --}}
                <flux:navlist.item 
                    icon="cog" 
                    :href="route('menus.manage')" 
                    :current="request()->routeIs('menus.manage')" 
                    wire:navigate>
                    {{ __('Manage Menu') }}
                </flux:navlist.item>
            </flux:navlist.group>
            {{-- ======================== END: BAGIAN MENU UTAMA ======================== --}}

            <flux:spacer />

            {{-- Menu User di Desktop --}}
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->username"
                    :initials="strtoupper(substr(auth()->user()->username, 0, 2))"
                    icon-trailing="chevrons-up-down"
                />
                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white uppercase">
                                        {{ substr(auth()->user()->username, 0, 2) }}
                                    </span>
                                </span>
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->username }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        {{-- Menu User di Mobile --}}
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="strtoupper(substr(auth()->user()->username, 0, 2))"
                    icon-trailing="chevron-down"
                />
                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white uppercase">
                                       {{ substr(auth()->user()->username, 0, 2) }}
                                    </span>
                                </span>
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->username }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>