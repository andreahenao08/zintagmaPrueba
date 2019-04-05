<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	Profession::create(['title' => 'Diseñador web']);
        Profession::create(['title' => 'Desarrollador back-end']);
        Profession::create(['title' => 'Desarrollador front-end']);
        Profession::create(['title' => 'test development']);



        factory(Profession::class, 2)->create();
    }
}
