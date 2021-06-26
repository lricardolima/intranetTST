<?php

use Illuminate\Database\Seeder;
use App\HumanResource;
class HumanResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        HumanResource::create([

        	'title' => 'Regulamento Interno de Pessoal',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'img/sectors/rh/REGULAMENTO INTERNO DE PESSOAL.pdf',

            'administrative_id' => '2',

            'responsible' => 'Recursos Humanos',


        ]);

        HumanResource::create([

        	'title' => 'Prestação de Serviço PJ',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://docs.google.com/forms/d/1nyaZyAydcDKsN2ANjvVXOgTVHuqlTWmeSzFx0RBQS2Y/edit',

            'administrative_id' => '2',

            'responsible' => 'Recursos Humanos',


        ]);

        HumanResource::create([

        	'title' => 'Gestão de Aniversário',

            'description' => '',

            'photo' => '',

            'type' => 'Avançado',

        	'link' => 'birthday',

            'administrative_id' => '2',

            'responsible' => 'Recursos Humanos',


        ]);
    }

}
