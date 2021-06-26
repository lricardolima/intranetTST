<?php

use Illuminate\Database\Seeder;
use App\Quality;

class QualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quality::create([

        	'title' => 'Notificação de Eventos Adversos',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://forms.gle/RTUq6gfYkTpvsLHLA',

            'assistance_id' => '2',

            'responsible' => 'Qualidade',


        ]);

        Quality::create([

        	'title' => 'Registro de Não Conformidade',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://docs.google.com/forms/d/e/1FAIpQLSeNqFO5HLdaYT9R9e1jfmdJiftFfuR7XfrUWTMCZLR9cd1qXQ/viewform?usp=pp_url',

            'assistance_id' => '2',

            'responsible' => 'Qualidade',


        ]);


        Quality::create([

        	'title' => 'Queixa Técnica de Medicamento e Material Hospitalar',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://docs.google.com/forms/d/e/1FAIpQLSfHMYSp-kGI8PIJXJ5iXSgFnxx--HmOunVqc9ttdxvn6wG6TQ/viewform?usp=pp_url',

            'assistance_id' => '2',

            'responsible' => 'Qualidade',

        ]);

        Quality::create([

        	'title' => 'Solicitação de Medicamentos não padronizados',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://docs.google.com/forms/d/e/1FAIpQLSeJFbp-Dgw3iuEy6IC3EC_Ebwa4Cib4qlKkE0XVs0G8IVK9tg/viewform?usp=pp_url',

            'assistance_id' => '2',

            'responsible' => 'Qualidade',

        ]);


        Quality::create([

        	'title' => 'Escala de Sobreaviso',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://1drv.ms/x/s!AlaxQ7FGXozahXNceKtfa9lyO5Lh?e=HhE4hg',

            'assistance_id' => '2',

            'responsible' => 'Qualidade',

        ]);

    }
}
