<x-slot name="head">
    <title>Verify Email</title>
    <x-css-authentication />
</x-slot>

<section class="VerifyEmail">
    <div class="header">
        <p>Kindly verify your email address by clicking on the link we just emailed you?</p>
        <p>If you didn't receive the email, we will gladly send you another.</p>
    </div>

    <div class="custom_form">
        <div class="actions">
            <button wire:click="sendVerification">Resend Verification Email</button>

            @livewire('auth.logout-button', ['class' => 'btn_danger'])
        </div>
    </div>
</section>
