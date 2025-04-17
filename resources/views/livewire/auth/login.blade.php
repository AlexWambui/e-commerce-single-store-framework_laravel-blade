<x-slot name="head">
    <title>Login</title>
    <x-css-authentication />
</x-slot>

<section class="Login">
    <div class="custom_form">
        <form wire:submit.prevent="login">
            <div class="custom_inputs">
                <input type="email" wire:model.lazy="email" id="email" placeholder="" autocomplete="email" autofocus>
                <label for="email">Email Address</label>
                <x-input-error field="email" />
            </div>

            <div class="custom_inputs">
                <input type="password" wire:model.lazy="password" id="password" placeholder="" autocomplete="new-password">
                <label for="password">Password</label>
                <x-input-error field="password" />
            </div>

            <button type="submit" class="btn_block">Login</button>
        </form>

        <div class="extras">
            <p>Don't have an account? <a href="{{ route('register') }}">Signup</a></p>

            <p>Forgot Password? <a href="{{ route('password.request') }}">Reset Password</a></p>
        </div>
    </div>
</section>    
