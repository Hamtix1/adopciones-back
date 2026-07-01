<?php

namespace App\Providers;

use App\Models\Animal;
use App\Models\Shelter;
use App\Policies\AnimalPolicy;
use App\Policies\ShelterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Shelter::class => ShelterPolicy::class,
        Animal::class => AnimalPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('manage-shelters', fn ($user) => $user->roles()->whereIn('name', ['admin', 'shelter'])->exists());
        Gate::define('manage-animals', fn ($user) => $user->roles()->whereIn('name', ['admin', 'shelter'])->exists());
    }
}
