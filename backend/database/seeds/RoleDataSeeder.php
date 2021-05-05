<?php

use Illuminate\Database\Seeder;

class RoleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['role_id' => 1, 'role_name' => '管理者'],
            ['role_id' => 5, 'role_name' => '一般'],
        ];

        DB::table('roles')->insert($roles);
    }
}
