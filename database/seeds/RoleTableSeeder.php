<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_adm = new Role();
        $role_adm->name = 'admin';
        $role_adm->save();

        $role_usr = new Role();
        $role_usr->name = 'user';
        $role_usr->save();

        $role_usr = new Role();
        $role_usr->name = 'company';
        $role_usr->save();

        $role_usr = new Role();
        $role_usr->name = 'trainer';
        $role_usr->save();
    }
}
