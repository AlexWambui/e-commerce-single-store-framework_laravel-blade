<x-authenticated-layout class="UserProfile">
    <x-slot name="head">
        <title>Edit Profile</title>
        <x-css-authentication />
    </x-slot>

    <section class="userprofile">
        <div class="header">
            <h2>Edit Profile</h2>
        </div>

        @livewire('auth.update-profile-information')
    
        @livewire('auth.update-password')
    
        @livewire('auth.delete-account')
    </section>
</x-authenticated-layout>
