<x-app-layout>
    <x-slot name="head">
        @vite(['resources/css/compiled/main-app.css'])
        {{ $head ?? '' }}
    </x-slot>

    
    <main {{ $attributes->merge(['class' => 'MainApp']) }}>
        @include('partials.aside')

        <section class="app_content">
            @include('partials.notifications')
            
            {{ $slot }}
        </section>
    </main>

    <x-slot name="scripts">
        {{ $scripts ?? '' }}
    </x-slot>
</x-app-layout>
