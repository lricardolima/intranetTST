<?php

use Illuminate\Database\Seeder;
use App\Training;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Training::create([

        	'name' => 'Atendimento',

        	'url' => 'sectors/homes/attendance',

            'photo' => '',


        ]);

        Training::create([

        	'name' => 'Assistência',

        	'url' => 'sectors/homes/advice',

            'photo' => '',


        ]);

        Training::create([

        	'name' => 'Financeiro',

        	'url' => 'sectors/homes/financial',

            'photo' => '',


        ]);

        Training::create([

        	'name' => 'Faturamento',

        	'url' => 'sectors/homes/revenues',

            'photo' => '',


        ]);

        Training::create([

        	'name' => 'Suprimentos',

        	'url' => 'sectors/homes/supply',

            'photo' => '',


        ]);

        Training::create([

        	'name' => 'Suporte',

        	'url' => 'sectors/homes/support',

            'photo' => '',

        ]);

    }
}
