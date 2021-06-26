<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

        $user = User::create([

        	'name' => 'Administrador',

        	'email' => 'ti@gastroclinicahospital.com.br',

            'password' => bcrypt('T!cgastro@')


        ]);

        $role = Role::create(['name' => 'Administrador']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }

}

//usar o comando abaixo para gerar o usuário administrador
//php artisan db:seed --class=CreateAdminUserSeeder


