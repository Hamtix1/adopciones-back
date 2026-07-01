<?php

namespace App\Policies;

use App\Models\Shelter;
use App\Models\User;

class ShelterPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->roles()->where('name', 'admin')->exists() || $user->roles()->where('name', 'shelter')->exists();
    }

    public function view(User $user, Shelter $shelter): bool
    {
        return $user->roles()->where('name', 'admin')->exists() || $user->id === $shelter->user_id;
    }

    public function create(User $user): bool
    {
        return $user->roles()->whereIn('name', ['admin', 'shelter'])->exists();
    }

    public function update(User $user, Shelter $shelter): bool
    {
        return $user->roles()->where('name', 'admin')->exists() || $user->id === $shelter->user_id;
    }

    public function delete(User $user, Shelter $shelter): bool
    {
        return $user->roles()->where('name', 'admin')->exists();
    }
}
