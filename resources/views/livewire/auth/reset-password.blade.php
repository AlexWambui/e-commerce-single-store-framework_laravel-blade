<x-slot name="head">
    <title>Reset Password</title>
    <x-css-authentication />
</x-slot>

<section class="ResetPassword">
    <div class="custom_form">
        <form wire:submit="resetPassword" class="space-y-6">
            <div class="custom_inputs">
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" placeholder="" autofocus autocomplete="username" />
                <x-input-label for="email" :value="__('Email')" />
                <x-input-error field="email" />
            </div>

            <div class="custom_inputs">
                <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" placeholder="" autocomplete="new-password" />
                <x-input-label for="password" :value="__('Password')" />
                <x-input-error field="password" />
            </div>

            <div class="custom_inputs">
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" placeholder="" autocomplete="new-password" />
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input-error field="password_confirmation" />
            </div>

            <button type="submit" class="btn_block">Reset Password</button>
        </form>
    </div>
</section>
