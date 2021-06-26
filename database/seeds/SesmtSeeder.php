<?php

use Illuminate\Database\Seeder;
use App\Sesmt;
class SesmtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sesmt::create([

        	'title' => 'Solicitação de fardamentos',

            'description' => '',

            'photo' => '',

            'type' => 'Avançado',

        	'link' => 'https://docs.google.com/forms/d/e/1FAIpQLScWMd4Z5TEo5QXoAPEdRvlXDGBpc0I5ZtYm8LO4n--inIUxLw/viewform?vc=0&c=0&w=1&flr=0',

            'administrative_id' => '4',

            'responsible' => 'Sesmt',


        ]);

        Sesmt::create([

        	'title' => 'Monitoramento de Saúde do Trabalhador',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://docs.google.com/forms/d/e/1FAIpQLSf_uv83Z2aYAFX8hx5C5lrGLw4BYZkP3cf6oJA9_fstt4shmg/viewform?vc=0&c=0&w=1&flr=0&gxids=7628',

            'administrative_id' => '4',

            'responsible' => 'Sesmt',


        ]);
    }
}
