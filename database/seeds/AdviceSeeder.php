<?php

use Illuminate\Database\Seeder;
use App\Advice;

class AdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Assistência
     * @return void
     */
    public function run()
    {
        Advice::create([

        	'title' => 'Acesso ao Sistema/Chamada do Paciente',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/4bc5de445d31483583a35bc2c9835ee0',

            'training_id' => '2',

            'responsible' => 'Tecnologia da Informação',


        ]);

        Advice::create([

        	'title' => 'Anamnese',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/ed362f3b93bf4a41bea1406dd222cc20',

            'training_id' => '2',

            'responsible' => 'Tecnologia da Informação',


        ]);

        Advice::create([

        	'title' => 'Evoluções',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/7067fc9e330f41f087f4c229897b0bf3',

            'training_id' => '2',

            'responsible' => 'Tecnologia da Informação',


        ]);

        Advice::create([

        	'title' => 'Atestados',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/744fc18ebde24f22ba2850b1cb1181a23',

            'training_id' => '2',

            'responsible' => 'Tecnologia da Informação',


        ]);


        Advice::create([

        	'title' => 'Receitas',

            'description' => '',

            'photo' => '',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/aab56b92bfc1481aa1c57d817cf76a55',

            'training_id' => '2',

            'responsible' => 'Tecnologia da Informação',

        ]);

        Advice::create([

        	'title' => 'Obstetícia/Nascimento',

            'description' => '',

            'photo' => 'img/sector/noimage.png',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/67be12568add46799e793cf55f48fb2a',

            'training_id' => '2',

            'responsible' => 'Tecnologia da Informação',

        ]);

        Advice::create([

        	'title' => 'Solicitação externa Exame/Procedimentos/Cirurgias',

            'description' => '',

            'photo' => 'img/sector/noimage.png',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/789f85fc3dbd4e0f8e02dfb29785dbcb',

            'training_id' => '2',

            'responsible' => 'Tecnologia da Informação',

        ]);

        Advice::create([

        	'title' => 'Prescrição Eletrônica do Paciente (REP)',

            'description' => '',

            'photo' => 'img/sector/noimage.png',

            'type' => 'Comum',

        	'link' => 'https://www.loom.com/share/f2a0e1fe95374f3e9e86aba51d8d7d2a',

            'training_id' => '2',

            'responsible' => 'Tecnologia da Informação',

        ]);

    }
}
