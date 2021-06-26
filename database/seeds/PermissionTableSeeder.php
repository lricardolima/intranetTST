<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

       $permissions = [

        'Cadastrar Ramal',

        'Editar Ramal',

        'Excluir Ramal',

        'Cadastrar Refeicao',

        'Editar Refeicao',

        'Excluir Refeicao',

        'Cadastrar Noticia',

        'Editar Noticia',

        'Cadastrar Aniversario',

        'Editar Aniversario',

        'Excluir Aniversario',

        'Cadastrar Elogio',

        'Editar Elogio',

        'Excluir Elogio',

        'Cadastrar Carousel',

        'Editar Carousel',

        'Excluir Carousel',

        'Registrar Usuario',

        'Cadastrar Setor Tecnologia',

        'Editar Setor Tecnologia',

        'Excluir Setor Tecnologia',

        'Setor Tecnologia',

        'Cadastrar Setor Sesmt',

        'Editar Setor Sesmt',

        'Excluir Setor Sesmt',

        'Setor Sesmt',

        'Cadastrar Setor Qualidade',

        'Editar Setor Qualidade',

        'Excluir Setor Qualidade',

        'Setor Qualidade',

        'Cadastrar Setor Ouvidoria',

        'Editar Setor Ouvidoria',

        'Excluir Setor Ouvidoria',

        'Setor Ouvidoria',

        'Cadastrar Setor Educação Permanente',

        'Editar Setor Educação Permanente',

        'Excluir Setor Educação Permanente',

        'Setor Educação Permanente',

        'Cadastrar Setor Ccih',

        'Editar Setor Ccih',

        'Excluir Setor Ccih',

        'Setor Ccih',

        'Cadastrar Setor Marketing',

        'Editar Setor Marketing',

        'Excluir Setor Marketing',

        'Setor Marketing',

        'Cadastrar Setor Controladoria',

        'Editar Setor Controladoria',

        'Excluir Setor Controladoria',

        'Setor Controladoria',

        'Cadastrar Setor Pessoal',

        'Editar Setor Pessoal',

        'Excluir Setor Pessoal',

        'Setor Pessoal',

        'Cadastrar Setor Recursos Humanos',

        'Editar Setor Recursos Humanos',

        'Excluir Setor Recursos Humanos',

        'Setor Recursos Humanos',

        ];

        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }

    }

}

//usar o comando abaixo para gerar as permissões
////php artisan db:seed --class=PermissionTableSeeder
