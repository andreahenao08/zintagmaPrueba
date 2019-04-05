<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = [
        'nombres', 'apellidos', 'email', 'direccion', 'telefono', 'estado', 'imagen', 'salarioEsperado', 'profession_id',
        'experiencia',
    ];

    public $timestamps = false;
    
    public function profession(){
        
        return $this->belongsTo(Profession::class);
    }
}
