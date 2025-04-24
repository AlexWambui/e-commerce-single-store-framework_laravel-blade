<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    public string $search = '';
    public $filter_user_level = null;
    public int $per_page = 30;
    public int $count_total_users = 0;
    public int $count_inactive_users = 0;
    public int $count_unverified_users = 0;

    public ?int $editing_user_id = null;
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public int $user_level = 1;
    public int $user_status = 1;

    public bool $showing_modal = false;
    public bool $confirming_delete = false;

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email,' . $this->editing_user_id,
            'password' => $this->editing_user_id ? 'nullable|min:6' : 'required|min:6',
            'user_level' => 'required|integer|between:0,5',
            'user_status' => 'required|boolean',
        ];
    }

    protected function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 2 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 2 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'user_level.required' => 'User level is required.',
        ];
    }

    public function applySearch(): void
    {
        $this->search = trim($this->search);
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterUserLevel($value): void
    {
        $this->filter_user_level = $value !== '' ? (int) $value : null;
        $this->resetPage();
    }

    public function showModal(): void
    {
        $this->resetForm();
        $this->showing_modal = true;
    }

    public function hideModal(): void
    {
        $this->resetForm();
    }

    public function confirmDelete(int $user_id): void
    {
        $this->editing_user_id = $user_id;
        $this->confirming_delete = true;
    }

    public function resetForm(): void
    {
        $this->reset([
            'editing_user_id',
            'first_name',
            'last_name',
            'email',
            'password',
            'user_level',
            'user_status',
            'showing_modal',
            'confirming_delete',
        ]);
    }

    public function toggleStatus(int $user_id): void
    {
        $user = User::findOrFail($user_id);
        $user->update(['user_status' => !$user->user_status]);

        session()->flash('success', 'User status updated successfully!');
    }

    public function editUser(int $user_id): void
    {
        $user = User::findOrFail($user_id);

        $this->editing_user_id = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->user_level = $user->user_level->value;
        $this->user_status = $user->user_status->value;

        $this->showing_modal = true;
    }

    public function saveUser(): void
    {
        $validated = $this->validate();

        if (!empty($this->password)) {
            $validated['password'] = Hash::make($this->password);
        }

        if ($this->editing_user_id) {
            User::findOrFail($this->editing_user_id)->update($validated);
            session()->flash('success', 'User updated successfully.');
        } else {
            User::create($validated);
            session()->flash('success', 'User created successfully.');
        }

        $this->resetForm();
    }

    public function deleteUser(): void
    {
        $user = User::findOrFail($this->editing_user_id);

        if (auth()->id() === $user->id) {
            session()->flash('success', 'You cannot delete yourself.');
        } elseif ($user->isSuperAdmin()) {
            session()->flash('success', 'Cannot delete a super admin.');
        } else {
            $user->delete();
            session()->flash('success', 'User deleted successfully.');
        }

        $this->resetForm();
    }

    protected function loadUserStats(): void
    {
        $stats = User::selectRaw('
            COUNT(*) as total,
            COUNT(CASE WHEN user_status = 0 THEN 1 END) as inactive,
            COUNT(CASE WHEN email_verified_at IS NULL THEN 1 END) as unverified
        ')->first();

        $this->count_total_users = $stats->total;
        $this->count_inactive_users = $stats->inactive;
        $this->count_unverified_users = $stats->unverified;
    }

    public function render()
    {
        $this->loadUserStats();

        $query = User::query()
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('first_name', 'like', "%{$this->search}%")
                  ->orWhere('last_name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%");
            }))
            ->when(is_numeric($this->filter_user_level), fn ($q) => $q->where('user_level', (int) $this->filter_user_level));

        if (\DB::getDriverName() === 'mysql') {
            $query->orderByRaw("FIELD(user_level, ?, ?, ?, ?, ?)", [0, 1, 2, 4, 3]);
        } else {
            // fallback: just use normal ascending for dev/testing with SQLite
            $query->orderBy('user_level', 'asc');
        }

        $users = $query
            ->orderBy('first_name', 'asc')
            ->paginate($this->per_page);

        return view('livewire.users.manage-users', compact('users'))
            ->layout('components.layouts.authenticated', ['attributes' => ['class' => 'Users']]);
    }
}
