<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $roles = [
//            ['name' => 'Администратор', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Директор', 'guard_name' => 'director', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Бухгалтер', 'guard_name' => 'accountant', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Снабжение', 'guard_name' => 'supply', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Склад', 'guard_name' => 'warehouse', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Программист', 'guard_name' => 'programmer', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Инжинер', 'guard_name' => 'engineer', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Конструктор\АСУ', 'guard_name' => 'constructor', 'created_at' => now(), 'updated_at' => now()],
//        ];
//
//        foreach ($roles as $role) {
//            \App\Role::create($role);
//        }
        $roles = [
            ['name' => 'Администратор'],
            ['name' => 'Директор'],
            ['name' => 'Бухгалтер'],
            ['name' => 'Снабжение'],
            ['name' => 'Склад'],
            ['name' => 'Программист'],
            ['name' => 'Инжинер'],
            ['name' => 'Конструктор\АСУ'],
            ['name' => 'Менеджер'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
