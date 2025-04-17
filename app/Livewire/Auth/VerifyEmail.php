<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerifyEmail extends Component
{
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(route('dashboard'), true);
            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        session()->flash('success', 'Verification link has been sent.');
        $this->redirect(request()->header('Referer') ?? url()->previous(), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.verify-email')->layout('components.layouts.guest', ['attributes' => ['class' => 'Authentication']]);
    }
}
