<x-authenticated-layout class="Dashboard">
    <x-slot name="head">
        <title>Dashboard</title>
    </x-slot>

    <section class="Hero">
        <p>Hi, {{ Auth::user()->full_name }}</p>
    </section>
</x-authenticated-layout>
