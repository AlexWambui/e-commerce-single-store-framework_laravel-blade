<x-slot name="head">
    <title>Signup</title>
    <x-css-authentication />
</x-slot>

<section class="Signup">
    <div class="custom_form">
        <form wire:submit.prevent="register">
            <div class="inputs_group">
                <div class="custom_inputs">
                    <input type="text" wire:model.lazy="first_name" id="first_name" placeholder="" autocomplete="given-name" autofocus>
                    <label for="first_name">First Name</label>
                    <x-input-error field="first_name" />
                </div>

                <div class="custom_inputs">
                    <input type="text" wire:model.lazy="last_name" id="last_name" placeholder="" autocomplete="family-name">
                    <label for="last_name">Last Name</label>
                    <x-input-error field="last_name" />
                </div>
            </div>

            <div class="custom_inputs">
                <input type="email" wire:model.lazy="email" id="email" placeholder="" autocomplete="email">
                <label for="email">Email Address</label>
                <x-input-error field="email" />
            </div>

            <div class="custom_inputs">
                <input type="password" wire:model.lazy="password" id="password" placeholder="" autocomplete="new-password">
                <label for="password">Password</label>
                <x-input-error field="password" />
            </div>

            <div class="custom_inputs">
                <input type="password" wire:model.lazy="password_confirmation" id="password_confirmation" placeholder="" autocomplete="new-password">
                <label for="password_confirmation">Confirm Password</label>
                <x-input-error field="password_confirmation" />
            </div>

            <button type="submit" class="btn_block">Signup</button>
        </form>

        <div class="extras">
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>   
</section>
