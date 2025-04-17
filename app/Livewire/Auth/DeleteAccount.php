<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteAccount extends Component
{
    public $confirming = false;

    public function confirmDeletion()
    {
        $this->confirming = true;
    }

    public function deleteAccount()
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home-page');
    }

    public function render()
    {
        return view('livewire.auth.delete-account');
    }
}
