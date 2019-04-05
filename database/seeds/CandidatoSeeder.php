<?php

use App\Profession;
use App\Candidato;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CandidatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professionId = Profession::where('title', 'Diseñador web')->value('id');

        Candidato::create([
            'nombres' => 'Andrea',
            'apellidos' => 'Henao',
            'email' => 'andreahenao08@gmail.com',
            'direccion' => 'santa teresa calle 2',
            'telefono' => '04247372618',
            'salarioEsperado' => '1000',
            'estado' => 'No evaluado',
            'experiencia' => 'Profesional (< 3 años)',
        	'profession_id' => Profession::whereTitle('Diseñador web')->value('id')
        ]);

        factory(Candidato::class)->create(['profession_id' => $professionId]);

        factory(Candidato::class, 9)->create();
    }
}
