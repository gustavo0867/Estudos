<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    protected $fillable = [
        'nome_aluno',
        'curso',
        'instagram',
        'dia_semana',
        'horario',
        'tipo',         // Adicionado
        'observacoes',  // Adicionado
    ];
}
