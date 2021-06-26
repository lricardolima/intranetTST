<?php

use Illuminate\Database\Seeder;
use App\Support;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Support::create([

        	'title' => 'Ordem de Serviço  - Abertura',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/fdd16c693eda4009b0bc8c1bb5340680?sharedAppSource=personal_library',

            'training_id' => '6',

            'responsible' => 'Tecnologia da Informação',

        ]);
    }
}
