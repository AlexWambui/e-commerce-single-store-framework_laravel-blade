<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // Attempt to send the password reset link to the email
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        // Reset the email field and flash success status
        $this->reset('email');
        session()->flash('success', 'Password reset link has been sent.');
        $this->redirect(route('password.request'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('components.layouts.guest', ['attributes' => ['class' => 'Authentication']]);
    }
}
