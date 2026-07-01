<?php

namespace App\Policies;

use App\Models\Animal;
use App\Models\User;

class AnimalPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->roles()->where('name', 'admin')->exists() || $user->roles()->where('name', 'shelter')->exists();
    }

    public function view(User $user, Animal $animal): bool
    {
        return $user->roles()->where('name', 'admin')->exists() || $user->id === $animal->shelter->user_id;
    }

    public function create(User $user): bool
    {
        return $user->roles()->whereIn('name', ['admin', 'shelter'])->exists();
    }

    public function update(User $user, Animal $animal): bool
    {
        return $user->roles()->where('name', 'admin')->exists() || $user->id === $animal->shelter->user_id;
    }

    public function delete(User $user, Animal $animal): bool
    {
        return $user->roles()->where('name', 'admin')->exists();
    }
}
