<div class="custom_form update_profile" x-data>
    <div class="header">
        <p>Update Profile Information</p>    
    </div>

    <form wire:submit.prevent="updateProfile" enctype="multipart/form-data" novalidate>
        <div class="image_input">
            <div class="image" @click="$refs.image.click()">
                @if ($image)
                    <img id="previewImage" src="{{ $image->temporaryUrl() }}" width="150">
                @elseif(Auth::user()->image)
                    <img id="previewImage" src="{{ asset('storage/user-images/' . Auth::user()->image) }}" width="150">
                @else
                    <img id="previewImage" src="{{ asset('assets/images/default-profile.webp') }}" width="150">
                @endif
            </div>

            <input type="file" wire:model="image" accept="image/*"
                   x-ref="image"
                   style="display: none;"
                   @change="if ($event.target.files[0]?.size > 5 * 1024 * 1024) {
                       alert('Image too large. Please select a file under 5MB');
                       $event.target.value = '';
                   }">

            <div class="text-sm text-gray-500" wire:loading wire:target="image">
                Uploading...
            </div>

            <x-input-error field="image" />
        </div>

        <div class="inputs_group">
            <div class="inputs">
                <label class="required">First Name</label>
                <input type="text" wire:model.defer="first_name">
                <x-input-error field="first_name" />
            </div>

            <div class="inputs">
                <label class="required">Last Name</label>
                <input type="text" wire:model.defer="last_name">
                <x-input-error field="last_name" />
            </div>
        </div>

        <div class="inputs_group">
            <div class="inputs">
                <label class="required">Email Address</label>
                <input type="email" wire:model.defer="email">
                <x-input-error field="email" />
            </div>
        </div>

        <div class="inputs_group">
            <div class="inputs">
                <label>Phone Number</label>
                <input type="text" wire:model.defer="phone_number">
                <x-input-error field="phone_number" />
            </div>

            <div class="inputs">
                <label>Secondary Phone Number</label>
                <input type="text" wire:model.defer="secondary_phone_number">
                <x-input-error field="secondary_phone_number" />
            </div>
        </div>

        <button type="submit">Update Profile</button>
    </form>
</div>
