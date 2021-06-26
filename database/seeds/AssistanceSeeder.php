<?php

use Illuminate\Database\Seeder;
use App\Assistance;

class AssistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Assistance::create([

        	'name' => 'Nutrição',

        	'url' => 'menu',

            'image' => '',

        ]);

        Assistance::create([

        	'name' => 'Qualidade',

        	'url' => 'sectors/quality',

            'image' => '',

        ]);

        Assistance::create([

        	'name' => 'Educação Permanente',

        	'url' => 'sectors/permanentEducation',

            'image' => '',

        ]);

        Assistance::create([

        	'name' => 'Ouvidoria',

        	'url' => 'sectors/sac',

            'image' => '',

        ]);

        Assistance::create([

        	'name' => 'Ccih',

        	'url' => 'sectors/ccih',

            'image' => '',

        ]);

    }
}
