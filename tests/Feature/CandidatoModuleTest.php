<?php

namespace Tests\Feature;

use App\Candidato;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Profession;

class CandidatoModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    function test_mostrarListaCandidatos()
    {
        factory(Candidato::class)->create(['nombres' => 'Camila',]);

        factory(Candidato::class)->create(['nombres' => 'Gabo',]);

        $this->get('/candidatos')

             ->assertStatus(200)
             ->assertSee('Listado de Candidatos')
             ->assertSee('Camila') 
             ->assertSee('Gabo');
    }

    function test_mensajeListaCandidatosVacia()
    {
        DB::table('candidatos')->truncate();

        $this->get('/candidatos')
             ->assertSee('No hay postulaciones');
    }

    function test_MostrarDetalleCandidato()
    {
        
        $candidato = factory(Candidato::class)->create(['nombres' => 'Andrea Henao']);

        $this->get("/candidatos/{$candidato->id}")
             ->assertStatus(200)
             ->assertSee('Andrea Henao');
    }

    function test_CandidatoNoEncontrado()
    {
        $this->get('/candidatos/999')
             ->assertStatus(404)
             ->assertSee('Página no encontrada');
    }

    function test_CargarPaginaNuevoCandidato()
    {
        $this->get('/candidatos/nuevo')
             ->assertStatus(200);
    }

    function test_CrearCandidato()
    {
        $this->withoutExceptionHandling();

        $profession = factory(Profession::class)->create();

        $this->post('/candidatos/', [
            'nombres' => 'Estefania',
            'apellidos' => 'Henao',
            'email' => 'estefania88@gmail.com',
            'direccion' => 'santa teresa calle 2',
            'telefono' => '04247372618',
            'salarioEsperado' => '100',
            'profession_id' => $profession->id,
            'imagen' => null,
            'experiencia' => '',
            ]);


        $this->assertEquals(1, Candidato::count());
    }

    function test_CampoNombreRequerido2()
    {

            $this->from('candidatos/nuevo')->post('/candidatos/', ['nombres' => '',
            'apellidos' => 'Henao',
            'email' => 'estefania@gmail.com',
            'direccion' => 'santa teresa calle 2',
            'telefono' => '04247372618',
            'salarioEsperado' => '1000',
            'estado' => 'No evaluado',
            ]);//->assertRedirect('candidatos/nuevo')
              //->assertSessionHasErrors(['nombres' => 'El campo nombre es obligatorio']);

            //$this->assertDatabaseMissing('users', ['email' => 'estefania@gmail.com',]);

              $this->assertEquals(0, Candidato::count());
    }

    function test_CampoEmailRequerido2()
    {

            $this->from('candidatos/nuevo')->post('/candidatos/', ['nombres' => 'Estefania',
            'apellidos' => 'Henao',
            'email' => '',
            'direccion' => 'santa teresa calle 2',
            'telefono' => '04247372618',
            'salarioEsperado' => '1000',
            'estado' => 'No evaluado',
            ])->assertRedirect('candidatos/nuevo')
              ->assertSessionHasErrors(['email' => 'El campo email es obligatorio']);

            //$this->assertDatabaseMissing('users', ['email' => 'estefania@gmail.com',]);

            $this->assertEquals(0, Candidato::count());
    }

    /*function test_CampoTelefonoRequerido()
    {

            $this->from('usuarios/nuevo')->post('/usuarios/', ['name' => 'Estefania',
            'email' => 'estefania@gmail.com',
            'password' => ''
            ])->assertRedirect('usuarios/nuevo')
              ->assertSessionHasErrors(['password' => 'El campo password es obligatorio']);

            //$this->assertDatabaseMissing('users', ['email' => 'estefania@gmail.com',]);

              $this->assertEquals(0, User::count());
    }*/

    function test_CampoEmailNoValido2()
    {

            $this->from('candidatos/nuevo')->post('/candidatos/', ['nombres' => 'Estefania',
            'apellidos' => 'Henao',
            'email' => 'correo-no-valido',
            'direccion' => 'santa teresa calle 2',
            'telefono' => '04247372618',
            'salarioEsperado' => '1000',
            'estado' => 'No evaluado',
            ])->assertRedirect('candidatos/nuevo')
              ->assertSessionHasErrors(['email']);

            //$this->assertDatabaseMissing('users', ['email' => 'estefania@gmail.com',]);

              $this->assertEquals(0, Candidato::count());
    }

    function test_CampoEmailUnico2()
    {

            $this->withoutExceptionHandling();

            $profession = factory(Profession::class)->create();

            factory(Candidato::class)->create(['email' => 'andreahenao08@gmail.com']);

            $this->post('/candidatos/', [
            'nombres' => 'Estefania',
            'apellidos' => 'Henao',
            'email' => 'andreahna08@gmail.com',
            'direccion' => 'santa teresa calle 2',
            'telefono' => '04247372618',
            'salarioEsperado' => '100',
            'profession_id' => $profession->id,
            'imagen' => null,
            'experiencia' => '',
            ]);
            // ])->assertRedirect('candidatos/nuevo')
            //   ->assertSessionHasErrors(['email' => 'El correo ya esta registrado']);

            //$this->assertDatabaseMissing('users', ['email' => 'estefania@gmail.com',]);

              $this->assertEquals(2, Candidato::count());
    }

    /*function test_ActualizarCandidato()
    {

            $candidato = factory(Candidato::class)->create();

            $this->put("/candidatos/{$candidato->id}", ['nombres' => 'Estefania',
            'apellidos' => 'Henao',
            'email' => 'andreahenao08@gmail.com',
            'direccion' => 'santa teresa calle 2',
            'telefono' => '04247372618',
            'salarioEsperado' => '1000',
            'estado' => 'No evaluado',
            ])->assertRedirect("/candidatos/{$candidato->id}");

            $this->assertCredentials(['nombres' => 'Estefania',
            'apellidos' => 'Henao',
            'email' => 'andreahenao08@gmail.com',
            'direccion' => 'santa teresa calle 2',
            'telefono' => '04247372618',
            'salarioEsperado' => '1000',
            'estado' => 'No evaluado',]);
    }*/

    function test_EliminarCandidato()
    {
        $candidato = factory(Candidato::class)->create();

        $this->delete("candidatos/{$candidato->id}")
             ->assertRedirect('candidatos');

        $this->assertSame(0, Candidato::count());


    }
}
