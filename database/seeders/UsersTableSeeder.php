<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\Hash;

    use App\Models\Role;
    use App\Models\User;
    use App\Models\RoleUser;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::truncate();

        DB::table('role_users')->truncate();
        

            $adminRole = Role::Where('name', 'admin')->first();
            $userRole = Role::Where('name', 'user')->first();

            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin***')
            ]);

            $user = User::create([
                'name' => ' User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user')
            ]);
            


            
            // $admin->roles()->attach($adminRole);
            // $user->roles()->attach($userRole);

            RoleUser::create([
                'user_id' => '1',
                'role_id' => '1',
            ]);

            RoleUser::create([
                'user_id' => '2',
                'role_id' => '2',
            ]);

    }
}
