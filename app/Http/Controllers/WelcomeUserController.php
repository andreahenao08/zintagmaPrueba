<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    function __invoke($name, $nickname = null){
   		$name = ucfirst($name);
    	
   		if($nickname){
   			return "Bienvenido {$name}, tu apodo es {$nickname}";
   		}
		else{
			return 'No tienes nickname';
    	}
    }
}		
