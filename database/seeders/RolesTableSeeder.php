<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        Role::truncate();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
    }
}
