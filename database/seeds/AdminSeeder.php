<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::create([
            'first_name' => 'Юрий',
            'last_name' => 'Лонс',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $permissions = Permission::get();
        $role = Role::where('name', 'Администратор')->first();

        $role->givePermissionTo($permissions);
        $admin->assignRole($role);

    }
}
