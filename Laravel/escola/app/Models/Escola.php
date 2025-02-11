<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    use HasFactory;

    protected $table = 'escola'; // Nome da tabela

    protected $fillable = [
        'nome_aluno',
        'curso',
        'instagram',
        'dia_semana',
        'horario',
        'aluno_id'
    ];

    // Relacionamento para obter o aluno associado
    public function aluno()
    {
        return $this->belongsTo(Escola::class, 'aluno_id');
    }
}
