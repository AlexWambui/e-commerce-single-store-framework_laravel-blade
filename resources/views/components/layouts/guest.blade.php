 <x-app-layout>
    <x-slot name="head">
        {{ $head ?? '' }}
    </x-slot>

    @include('partials.navbar')

    <main {{ $attributes->merge(['class' => '']) }}>
        @include('partials.notifications')
        
        {{ $slot }}
    </main>

    @include('partials.footer')

    <x-slot name="scripts">
        {{ $scripts ?? '' }}
    </x-slot>
</x-app-layout>
