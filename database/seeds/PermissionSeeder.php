<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        $permissions = [
//            ['name' => 'Добавить Файлы', 'guard_name' => 'add file', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Удалить Файлы', 'guard_name' => 'destroy file', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Добавить Проект', 'guard_name' => 'create project', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Изменить Проект', 'guard_name' => 'update project', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Просмотр Проект', 'guard_name' => 'show project', 'created_at' => now(), 'updated_at' => now()],
//            ['name' => 'Удалить Проект', 'guard_name' => 'destroy project', 'created_at' => now(), 'updated_at' => now()],
//        ];
//
//        foreach ($permissions as $permission) {
//            \App\Permission::create($permission);
//        }

        $permissions = [
            ['name' => 'create file'],
            ['name' => 'destroy file'],
            ['name' => 'create project'],
            ['name' => 'update project'],
            ['name' => 'show project'],
            ['name' => 'destroy project'],
            ['name' => 'create role'],
            ['name' => 'update role'],
            ['name' => 'show role'],
            ['name' => 'destroy role'],
            ['name' => 'create permission'],
            ['name' => 'update permission'],
            ['name' => 'show permission'],
            ['name' => 'destroy permission'],
            ['name' => 'create user'],
            ['name' => 'update user'],
            ['name' => 'show user'],
            ['name' => 'destroy user'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
