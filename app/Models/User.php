<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'image',
        'phone_number',
        'secondary_phone_number',
        'user_level',
        'user_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'user_level' => 'integer',
            'user_status' => 'integer',
        ];
    }

    const USERLEVELS = [
        0 => 'super_admin',
        1 => 'admin',
        2 => 'owner',
        3 => 'customer',
        4 => 'cashier',
    ];

    public function getUserLevelLabelAttribute(): ?string
    {
        return self::USERLEVELS[$this->user_level] ?? null;
    }

    public function hasRole(string|array $roles): bool
    {
        $roles = (array) $roles;
        return in_array($this->user_level_label, $roles, true);
    }

    public function isActive(): bool
    {
        return $this->user_status == 1;
    }

    public function isSuperAdmin(): bool
    {
        return $this->user_level_label === 'super_admin';
    }

    public function isAdmin(): bool
    {
        return in_array($this->user_level_label, ['super_admin', 'admin', 'owner']);
    }

    public function getFullNameAttribute():string
    {
        return $this->first_name. ' ' . $this->last_name;
    }

    public function getPhoneNumbersAttribute():string
    {
        $phone_numbers = array_filter([
            $this->phone_number,
            $this->secondary_phone_number,
        ]);

        return $phone_numbers ? implode(' | ', $phone_numbers) : '-';
    }

    public function getProfileImageAttribute(): string
    {
        $path = "user-images/{$this->image}";

        if (Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }

        return asset('assets/images/default-profile.webp');
    }
}
