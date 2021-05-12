<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    protected $table = "pessoas";

    protected $fillable = [
        'nome', 'cpf', 'sexo', 'nascimento'
    ];
}
