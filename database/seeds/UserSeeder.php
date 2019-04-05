<?php

use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$professionId = Profession::where('title', 'Diseñador web')->value('id');

    	//dd($professions);

        User::create([
        	'name' => 'Andrea Henao',
        	'email' => 'andreahenao08@gmail.com',
        	'password' => bcrypt('12345'),
            'estado' => 'No evaluado',
        	'profession_id' => Profession::whereTitle('Diseñador web')->value('id')
        ]);

        factory(User::class)->create(['profession_id' => $professionId]);

        factory(User::class, 48)->create();
    }
}
