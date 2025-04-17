<div class="custom_form update_password">
    <div class="header">
        <p>Update Password</p>
    </div>
    
    <form wire:submit.prevent="updatePassword">
        <div class="inputs">
            <label class="required">Current Password</label>
            <input type="password" wire:model.defer="current_password">
            <x-input-error field="current_password" />
        </div>

        <div class="inputs">
            <label class="required">New Password</label>
            <input type="password" wire:model.defer="password">
            <x-input-error field="password" />
        </div>

        <div class="inputs">
            <label class="required">Confirm New Password</label>
            <input type="password" wire:model.defer="password_confirmation">
            <x-input-error field="password_confirmation" />
        </div>
        
        <button type="submit">Update Password</button>
    </form>
</div>
