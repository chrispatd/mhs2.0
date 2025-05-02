<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-black antialiased text-white">
        <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
                <a href="{{ route('home') }}"
                class="flex flex-col items-center gap-2 font-medium"
                wire:navigate>
                    <span class="mb-1 rounded-md flex justify-center">
                        <img src="{{ asset('images/mhs.png') }}"
                            alt="{{ config('app.name', 'Laravel') }} Logo"
                            class="object-contain"
                            style="width:50%; height:auto;"  />
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
