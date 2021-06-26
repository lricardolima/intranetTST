<?php

use Illuminate\Database\Seeder;
use App\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Technology::create([

        	'title' => 'Lista de Treinamentos',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'sectors/homes/list_trainings',

            'administrative_id' => '3',

            'responsible' => 'Tecnologia da Informação',


        ]);

        Technology::create([

        	'title' => 'Treinamentos',

            'description' => '',

            'photo' => '',

            'type' => 'Avançado',

        	'link' => 'sectors/homes/training',

            'administrative_id' => '3',

            'responsible' => 'Tecnologia da Informação',


        ]);

        Technology::create([

        	'title' => 'Gestão de Usuários',

            'description' => '',

            'photo' => '',

            'type' => 'Avançado',

        	'link' => 'user',

            'administrative_id' => '3',

            'responsible' => 'Tecnologia da Informação',

        ]);

        Technology::create([

        	'title' => 'Gestão de Perfis',

            'description' => '',

            'photo' => '',

            'type' => 'Avançado',

        	'link' => 'role',

            'administrative_id' => '3',

            'responsible' => 'Tecnologia da Informação',

        ]);

        Technology::create([

        	'title' => 'Gestão de Permissões',

            'description' => '',

            'photo' => '',

            'type' => 'Avançado',

        	'link' => 'permission',

            'administrative_id' => '3',

            'responsible' => 'Tecnologia da Informação',

        ]);
    }
}
