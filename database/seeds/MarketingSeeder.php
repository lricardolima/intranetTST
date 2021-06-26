<?php

use Illuminate\Database\Seeder;
use App\Marketing;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marketing::create([

        	'title' => 'Carrousel',

            'description' => '',

            'photo' => '',

            'type' => 'Avançado',

        	'link' => 'carousel',

            'administrative_id' => '5',

            'responsible' => 'Marketing',


        ]);
    }
}
