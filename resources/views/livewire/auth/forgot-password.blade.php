<x-slot name="head">
    <title>Forgot Password?</title>
    <x-css-authentication />
</x-slot>

<section class="ForgotPassword">
    <div class="header">
        <p>Forgot your password?</p>
        <p>Enter your email address to get a password reset link.</p>
    </div>

    <div class="custom_form">
        <form wire:submit.prevent="sendPasswordResetLink">
            <div class="custom_inputs">
                <input type="email" wire:model="email" id="email" placeholder="" value="{{ old('email') }}" autofocus>
                <label for="email">Email Address</label>
                <x-input-error field="email" />
            </div>

            <button type="submit" class="btn_block">Email Password Reset Link</button>
        </form>
    </div>
</section>
