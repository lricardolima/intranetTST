<?php

use Illuminate\Database\Seeder;
use App\Administrative;

class AdministrativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Administrative::create([

        	'name' => 'Departamento Pessoal',

        	'url' => 'sectors/personalDepartment',

            'image' => '',


        ]);
        Administrative::create([

            'name' => 'Recursos Humanos',

        	'url' => 'sectors/humanResource',

            'image' => '',

        ]);
        Administrative::create([

            'name' => 'TIC',

        	'url' => 'sectors/technology',

            'image' => '',

        ]);

        Administrative::create([

            'name' => 'Sesmt',

        	'url' => 'sectors/sesmt',

            'image' => '',

        ]);

        Administrative::create([

            'name' => 'Marketing',

        	'url' => 'sectors/marketing',

            'image' => '',

        ]);

    }
}






//php artisan db:seed --class=AdministrativeSeeder//
