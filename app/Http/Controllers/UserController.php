<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){

		$users = User::all();

    	$title = 'Listado de Usuarios';
    	
    	return view('users.index', compact('title', 'users'));
    }

    function show($id){

    	$user = User::findOrFail($id);

    	return view('users.show', compact('user'));

    }

    function crearUsuario(){
    	return view('users.create');
    }

    public function store()
    {
        
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            //'estado' => '',
            ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'password.required' => 'El campo password es obligatorio',
            'email.email' => 'El campo email no es válido'
            ]);

        /*if(empty($data['name'])){
            return redirect('usuarios/nuevo')->withErrors(['name' => 'El campo es obligatorio']);
        }*/

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            //'estado' => $data['estado']
            ]);

        return redirect('usuarios');
        //return redirect()->route('users.index');
    }

    public function update(User $user)
    {
        $data = request()->all();

        $data['password'] = bcrypt($data['password']);

        $user->update($data);

        return redirect()->route('users.show', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('usuarios');
    }
}
