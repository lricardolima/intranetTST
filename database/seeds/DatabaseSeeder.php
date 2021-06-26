<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

         PermissionTableSeeder::class,
         CreateAdminUserSeeder::class,
         AdministrativeSeeder::class,
         AssistanceSeeder::class,
         TechnologySeeder::class,
         TrainingSeeder::class,
         AdviceSeeder::class,
         HumanResourceSeeder::class,
         MarketingSeeder::class,
         PersonalDepartmentSeeder::class,
         QualitySeeder::class,
         SesmtSeeder::class,
         SupportSeeder::class,

         ]);
    }
}
