<?php

namespace Database\Seeders;

use App\Models\AnimalStatus;
use App\Models\Department;
use App\Models\Municipality;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DomainSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['description' => 'Administrador del sistema']);
        $shelterRole = Role::firstOrCreate(['name' => 'shelter'], ['description' => 'Hogar de paso']);

        Permission::firstOrCreate(['name' => 'manage users'], ['description' => 'Manage users']);
        Permission::firstOrCreate(['name' => 'manage shelters'], ['description' => 'Manage shelters']);
        Permission::firstOrCreate(['name' => 'manage animals'], ['description' => 'Manage animals']);

        $adminRole->permissions()->syncWithoutDetaching(Permission::pluck('id')->all());

        $user = User::firstOrCreate([
            'email' => 'admin@acanis.org',
        ], [
            'name' => 'ACANIS Admin',
            'password' => Hash::make('secret1234'),
        ]);

        $user->roles()->syncWithoutDetaching([$adminRole->id]);

        foreach (['Rescatado', 'En recuperación', 'Disponible para adopción', 'Disponible para apadrinamiento', 'En proceso de adopción', 'Adoptado', 'Hogar permanente', 'Fallecido', 'Perdido'] as $status) {
            AnimalStatus::firstOrCreate(['name' => $status]);
        }

        $department = Department::firstOrCreate(['name' => 'Nariño', 'code' => '52']);
        Municipality::firstOrCreate(['department_id' => $department->id, 'name' => 'Pasto', 'code' => '52001']);
        Municipality::firstOrCreate(['department_id' => $department->id, 'name' => 'Ipiales', 'code' => '52250']);
    }
}
