<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UpdateProfileInformation extends Component
{
    use WithFileUploads;

    public $first_name, $last_name, $email, $phone_number, $secondary_phone_number, $image;

    const IMAGE_DIRECTORY = 'user-images';

    public function mount()
    {
        $user = Auth::user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->secondary_phone_number = $user->secondary_phone_number;
    }

    public function updatedImage()
    {
        $this->resetErrorBag('image');
    }

    public function updateProfile()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'nullable|string',
            'secondary_phone_number' => 'nullable|string',
            'image' => 'nullable|image|max:4096', // 4MB max
        ]);

        $user = Auth::user();

        $user->fill([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'secondary_phone_number' => $this->secondary_phone_number,
        ]);

        if ($this->image) {
            $this->updateUserImage($user, $this->image);
        }

        $user->save();

        session()->flash('success', 'Profile updated successfully!');
        $this->reset('image');
        $this->redirect(request()->header('Referer') ?? url()->previous(), navigate: true);
    }

    protected function updateUserImage($user, $image_file)
    {
        $this->deleteUserImage($user);

        $filename = $this->generateFilename($user, $image_file);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($image_file->getRealPath());
        $image->cover(200, 200);

        Storage::disk('public')->put(
            self::IMAGE_DIRECTORY . '/' . $filename,
            $image->encode()
        );

        $user->image = $filename;
    }

    protected function deleteUserImage($user)
    {
        if (!empty($user->image)) {
            $fullPath = self::IMAGE_DIRECTORY . '/' . $user->image;
            Storage::disk('public')->delete($fullPath);
        }
    }

    protected function generateFilename($user, $image_file)
    {
        $slug = Str::slug($user->first_name . '-' . $user->last_name);
        $timestamp = now()->format('dmYHis');
        $file_extension = $image_file->getClientOriginalExtension();
        return $slug . '-' . $timestamp . '.' . $file_extension;
    }

    public function render()
    {
        return view('livewire.auth.update-profile-information');
    }
}
