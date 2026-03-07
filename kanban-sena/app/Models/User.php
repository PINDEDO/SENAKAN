<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'center_id',
        'avatar',
        'active',
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
            'active' => 'boolean',
            'last_login' => 'datetime',
        ];
    }

    /**
     * Helper methods for roles
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCoordinador(): bool
    {
        return $this->role === 'coordinador';
    }

    public function isInstructor(): bool
    {
        return $this->role === 'instructor';
    }

    public function isAprendiz(): bool
    {
        return $this->role === 'aprendiz';
    }

    public function isFuncionario(): bool
    {
        return $this->role === 'funcionario';
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Accessor for avatar URL
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=1F4E79&color=fff';
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class , 'assigned_to');
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class , 'created_by');
    }
}
