<div class="user-management">
    @if ($showing_modal)
        <div class="modal-overlay">
            <div class="modal">
                <h2 class="modal-title">{{ $editing_user_id ? 'Edit User' : 'New User' }}</h2>

                <form wire:submit.prevent="saveUser" class="form">
                    <input wire:model.defer="first_name" type="text" placeholder="First Name" class="form-input">
                    @error('first_name') <span class="error-text">{{ $message }}</span> @enderror

                    <input wire:model.defer="last_name" type="text" placeholder="Last Name" class="form-input">
                    @error('last_name') <span class="error-text">{{ $message }}</span> @enderror

                    <input wire:model.defer="email" type="email" placeholder="Email" class="form-input">
                    @error('email') <span class="error-text">{{ $message }}</span> @enderror

                    <input wire:model.defer="password" type="password" placeholder="Password" class="form-input">
                    @error('password') <span class="error-text">{{ $message }}</span> @enderror

                    <select wire:model.defer="user_level" class="form-input">
                        <option value="">Select Role</option>
                        @foreach (\App\Models\User::USERLEVELS as $key => $label)
                            <option value="{{ $key }}">{{ ucfirst(str_replace('_', ' ', $label)) }}</option>
                        @endforeach
                    </select>
                    @error('user_level') <span class="error-text">{{ $message }}</span> @enderror

                    <div class="form-actions">
                        <button type="submit" class="btn btn-blue">{{ $editing_user_id ? 'Update' : 'Create' }}</button>
                        <button type="button" wire:click="hideModal" class="btn btn-gray">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($confirming_delete)
        <div class="modal-overlay">
            <div class="modal">
                <h2 class="modal-title">Confirm Deletion</h2>
                <p>Are you sure you want to delete this user?</p>
                <div class="form-actions">
                    <button wire:click="deleteUser" class="btn btn-red">Yes, Delete</button>
                    <button wire:click="hideModal" class="btn btn-gray">Cancel</button>
                </div>
            </div>
        </div>
    @endif

    <div class="table">
        <div class="header">
            <div class="statistics">
                <p class="title">Users</p>
                <p class="stats">
                    <span>{{ $count_total_users }} Total</span>
                    <span>{{ $count_inactive_users }} Inactive</span>
                    <span>{{ $count_unverified_users }} Unverified</span>
                </p>
            </div>

            <div class="filters">
                <input type="text" wire:model.defer="search" wire:keydown.enter="applySearch" placeholder="Search by name or email" class="search-input" />

                <select wire:model.live="filter_user_level" class="custom_select">
                    <option value="">All Roles</option>
                    @foreach (\App\Models\User::USERLEVELS as $key => $label)
                        <option value="{{ $key }}">{{ ucfirst(str_replace('_', ' ', $label)) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="actions">
                <button wire:click="showModal" class="btn btn-primary">+ New User</button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th class="center">Active</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr wire:key="{{ $user->id }}" class="{{ $user->user_status == 0 ? 'italicized' : '' }}">
                        <td>
                            {{ $user->full_name }}
                            @if($user->isSuperAdmin() || $user->isAdmin())
                                <i class="fas fa-check-circle verified"></i>
                            @endif
                        </td>
                        <td>
                            <div class="stacked">
                                <span @class(['text-danger' => $user->email_verified_at == null])>{{ $user->email }}</span>
                                <span>{{ $user->phone_numbers }}</span>
                            </div>
                        </td>
                        <td class="center">
                            <label class="switch">
                                <input type="checkbox" wire:click="toggleStatus({{ $user->id }})" {{ $user->user_status ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="actions">
                                <button type="button" wire:click="editUser({{ $user->id }})" class="edit">Edit</button>
                                <button type="button" wire:click="confirmDelete({{ $user->id }})" class="delete">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="no-data">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">{{ $users->links() }}</div>
    </div>
</div>
