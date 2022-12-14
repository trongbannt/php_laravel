<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\UserRoles;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $roles = [
            ['id' => 1, 'name' => 'Administrator','created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Creator','created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Editor','created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Staff','created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Guest','created_at' => now(), 'updated_at' => now()],
        ];
        Role::insert($roles);

        DB::table('userRoles')->delete();
        $userRoles = [
            ['id' => 1, 'name' => 'Administrator', 'user_id' => 1,'role_id'=>'1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Staff', 'user_id' => 2,'role_id'=>'4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Guest', 'user_id' => 3,'role_id'=>'5', 'created_at' => now(), 'updated_at' => now()],
        ];
        UserRoles::insert($userRoles);
    }
}
