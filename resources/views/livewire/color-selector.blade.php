<div class="relative p-4">
    <div class="flex items-center gap-2">
        <flux:dropdown position="bottom" align="start">
            <flux:button 
                variant="outline" 
                class="flex items-center gap-2 border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-black dark:text-white"
            >
                <span class="h-5 w-5 rounded-full" style="background-color: {{ $tempColor }};"></span>
                Select Color
            </flux:button>

            <flux:menu class="w-[220px]">
                @foreach ($colors as $color)
                    <flux:menu.item 
                        wire:click="$set('tempColor', '{{ $color->hex_color }}')"
                        class="flex items-center gap-2"
                    >
                        <span class="h-5 w-5 rounded-full" style="background-color: {{ $color->hex_color }};"></span>
                        {{ $color->color_name }}
                    </flux:menu.item>
                @endforeach
            </flux:menu>
        </flux:dropdown>

        <flux:button 
            variant="outline" 
            wire:click="saveColor" 
            class="bg-blue-500 hover:bg-blue-600 text-white border-blue-500 hover:border-blue-600"
        >
            Save
        </flux:button>
    </div>
</div>