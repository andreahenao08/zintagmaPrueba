<?php

namespace App\Http\Controllers;

use App\Candidato;
use App\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusSend;
use App\Mail\RejectSend;
use Illuminate\Support\Facades\Storage;
use File;

class CandidatoController extends Controller
{
    function index(){

		$candidatos = Candidato::all();

    	$title = 'Listado de Candidatos';
    	
    	return view('candidatos.index', compact('title', 'candidatos'));
    }

    function show($id){

    	$candidato = Candidato::findOrFail($id);

    	return view('candidatos.show', compact('candidato'));

    }

    function crearCandidato(){

        $professions = Profession::all();

    	return view('candidatos.create',compact('professions'));
    }



    public function store(Request $request)
    {

        $data = request()->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:candidatos,email',
            'direccion' => 'required',
            'telefono' => 'required',
            'salarioEsperado' => 'required',
            'profession_id' => 'required',
            'imagen' => '',
            'experiencia' => '',
            ], [
            'nombres.required' => 'El campo nombre es obligatorio',
            'apellidos.required' => 'El campo apellido es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'direccion.required' => 'El campo direccion es obligatorio',
            'telefono.required' => 'El campo telefono es obligatorio',
            'salarioEsperado.required' => 'El campo salario esperado es obligatorio',
            'email.email' => 'El campo email no es valido'
            ]);


        //$profession_id = Profession::where('title', $data['profession_id'])->value('id');

        if(isset($data['imagen']) && $data['imagen']!=null){
            
            $file = $request->file('imagen');
            $nombre = $file->getClientOriginalName();
            Storage::disk('local')->put($nombre,  File::get($file));
            //Storage::disk('local')->put("cosita",  File::get($data['imagen']));
        }else{

            $nombre = null;
        }


        Candidato::create([
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'salarioEsperado' => $data['salarioEsperado'],
            'profession_id' => $data['profession_id'],
            'experiencia' => $data['experiencia'],
            'imagen' => $nombre,
            //'estado' => $data['estado']
            ]);

        Mail::to($data['email'])->send(new StatusSend($data));

        return redirect('/login')->with('success','Tu currículum ha sido cargado exitosamente');
        //return redirect()->route('users.index');
    }

    public function update(Candidato $candidato)
    {
        $data = request()->all();

        $candidato->update($data);

        Mail::to($data['email'])->send(new RejectSend($data));

        return redirect('candidatos')->with('success','Candidato evaluado');

        //return redirect()->route('candidatos.show', ['candidato' => $candidato]);
    }

    public function destroy(Candidato $candidato)
    {
        $candidato->delete();

        return redirect('candidatos')->with('success','Candidato eliminado');
    }

    public function downloadFile($file){
      $pathtoFile = public_path().'/storage/'.$file;
      return response()->download($pathtoFile);
    }
}
