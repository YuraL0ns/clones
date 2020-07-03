<?php

use Illuminate\Database\Seeder;

class SafeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $safes = [
            ['name' => 'Detail example', 'type' => 'detail', 'in' => 200, 'out' => 20],
            ['name' => 'Detail example 2', 'type' => 'detail', 'in' => 250, 'out' => 11],
            ['name' => 'Material example', 'type' => 'material', 'in' => 150, 'out' => 5],
            ['name' => 'Material example 2', 'type' => 'material', 'in' => 190, 'out' => 3],
            ['name' => 'Purchased example', 'type' => 'purchased', 'in' => 170, 'out' => 10],
            ['name' => 'Purchased example 2', 'type' => 'purchased', 'in' => 100, 'out' => 0]
        ];

        \App\Sklad::insert($safes);
    }
}
