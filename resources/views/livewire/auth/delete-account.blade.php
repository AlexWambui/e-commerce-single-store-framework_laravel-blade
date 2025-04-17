<div class="custom_form delete_account">
    <div class="header">
        <p>Terminate Account!!!</p>    
    </div>

    @if (!$confirming)
        <div class="actions">
            <button wire:click="confirmDeletion" class="btn_danger">Delete Account</button>
        </div>
    @else
        <div class="actions">
            <p>Are you sure you want to delete your account? This action is irreversible.</p>
            <div>
                <button wire:click="deleteAccount" class="btn_danger">Yes, Delete</button>
                <button wire:click="$set('confirming', false)">Cancel</button>
            </div>
        </div>
    @endif
</div>
