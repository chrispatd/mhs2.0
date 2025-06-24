<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main class="h-screen overflow-hidden">
        <div class="flex items-center justify-end w-full p-3 mb-6 bg-white dark:bg-zinc-800 rounded-xl shadow-lg">
            {{-- Grup untuk konten yang rata kanan --}}
            <div class="flex items-center gap-4">
                <select name="semester" id="semester" class="py-2 px-3 block border-gray-300 bg-white dark:bg-zinc-700 dark:text-white dark:border-zinc-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option>Tampilan Semester Saat Ini</option>
                    <option value="1">Semester Ganjil</option>
                    <option value="2">Semester Genap</option>
                </select>

                <select name="school_year" id="school_year" class="py-2 px-3 block border-gray-300 bg-white dark:bg-zinc-700 dark:text-white dark:border-zinc-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option>Tampilan Tahun Ajaran</option>
                    <option value="2025/2026">2025/2026</option>
                    <option value="2024/2025">2024/2025</option>
                </select>

                <flux:dropdown position="bottom" align="end">
                    {{-- Tombol Pemicu Dropdown --}}
                    <button class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                         <span class="relative flex h-9 w-9 shrink-0 overflow-hidden rounded-full">
                            <span class="flex h-full w-full items-center justify-center rounded-full bg-neutral-300 dark:bg-neutral-700 font-bold uppercase">
                                {{ substr(auth()->user()->username, 0, 2) }}
                            </span>
                         </span>
                         <span>{{ auth()->user()->username }}</span>
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    
                    {{-- ======================= START: KONTEN POP UP YANG DIPERBARUI ======================= --}}
                    {{-- Konten Menu Dropdown (disamakan dengan sidebar) --}}
                    <flux:menu class="w-[220px]">
                        {{-- Info Pengguna --}}
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

                        {{-- Menu Settings --}}
                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        {{-- Tombol Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                    {{-- ======================== END: KONTEN POP UP YANG DIPERBARUI ======================== --}}

                </flux:dropdown>
            </div>
        </div>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>