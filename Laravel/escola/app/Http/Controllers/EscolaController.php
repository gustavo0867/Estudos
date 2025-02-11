<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;

class EscolaController extends Controller
{
    // Listar todos os alunos com seus horários
    public function index()
    {
        $alunos = Escola::with('aluno')->get();
        return response()->json($alunos);
    }

    // Criar um novo aluno com horário
    public function store(Request $request)
    {
        $request->validate([
            'nome_aluno' => 'required|string',
            'curso' => 'required|string',
            'instagram' => 'nullable|string',
            'dia_semana' => 'required|in:segunda,terça,quarta,quinta,sexta,sábado',
            'horario' => 'required|in:09-11,13-15,15-17,08-10,10-12',
        ]);

        // Verifica se o aluno já existe
        $aluno = Escola::where('nome_aluno', $request->nome_aluno)
            ->where('curso', $request->curso)
            ->first();

        if (!$aluno) {
            $aluno = Escola::create([
                'nome_aluno' => $request->nome_aluno,
                'curso' => $request->curso,
                'instagram' => $request->instagram,
            ]);
        }

        // Cria o agendamento para o aluno
        $agendamento = Escola::create([
            'nome_aluno' => $aluno->nome_aluno,
            'curso' => $aluno->curso,
            'instagram' => $aluno->instagram,
            'dia_semana' => $request->dia_semana,
            'horario' => $request->horario,
            'aluno_id' => $aluno->id
        ]);

        return response()->json($agendamento, 201);
    }

    // Atualizar um registro
    public function update(Request $request, $id)
    {
        $agendamento = Escola::findOrFail($id);

        $request->validate([
            'nome_aluno' => 'sometimes|string',
            'curso' => 'sometimes|string',
            'instagram' => 'nullable|string',
            'dia_semana' => 'sometimes|in:segunda,terça,quarta,quinta,sexta,sábado',
            'horario' => 'sometimes|in:09-11,13-15,15-17,08-10,10-12',
        ]);

        $agendamento->update($request->all());

        return response()->json($agendamento);
    }

    // Excluir um registro
    public function destroy($id)
    {
        $agendamento = Escola::findOrFail($id);
        $agendamento->delete();

        return response()->json(['message' => 'Registro excluído com sucesso.']);
    }
}
