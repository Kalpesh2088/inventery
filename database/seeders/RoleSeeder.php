<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Multiple entries for the "name" field
        $names = ['Super Admin', 'Admin'];

        foreach ($names as $name) {
            DB::table('roles')->insert([
                'name' => $name,
            ]);
        }
    }
}
