<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;

class EscolaController extends Controller
{
    // Listar todos os alunos com seus horários
    public function index()
    {
        // Busca os alunos e seus agendamentos
        
        return view('escola.index');
    }

    public function create()
    {
        return view('escola.cadastro');
    }

    public function store(Request $request)
    {
        $aluno = new Escola();
        $aluno->nome_aluno = $request->nome_aluno;
        $aluno->curso = $request->curso;
        $aluno->instagram = $request->instagram;
        $aluno->dia_semana = $request->dia_semana;
        $aluno->horario = $request->horario;
        $aluno->tipo = $request->tipo;
        $aluno->observacoes = $request->observacoes;
        $aluno->save();
        return redirect()->route('escola.cronograma');
    }

    public function edit($id)
    {   if(!empty($id)){
        $aluno = Escola::find($id);
        return view('escola.edit', ['aluno' => $aluno]);
        }else{
            return redirect()->route('escola.cronograma');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dia_semana' => 'required',
            'horario' => 'required',
            'nome_aluno' => 'required',
            'curso' => 'required',
            'tipo' => 'required',
        ]);

        $aluno = Escola::find($id);

        if (!$aluno) {
            return redirect()->route('escola.cronograma')->with('error', 'Aluno não encontrado.');
        }

        // Verificação do limite de cursos
        $limite = 5; // Defina o limite de cursos aqui
        $cursosNoMesmoHorario = Escola::where('dia_semana', $request->dia_semana)
            ->where('horario', $request->horario)
            ->where('id', '!=', $id) // Exclui o aluno atual da contagem
            ->count();

        if ($cursosNoMesmoHorario >= $limite) {
            return back()->withInput()->withErrors(['horario' => 'Limite de cursos para este dia e horário atingido.']);
        }

        $aluno->dia_semana = $request->dia_semana;
        $aluno->horario = $request->horario;
        $aluno->nome_aluno = $request->nome_aluno;
        $aluno->curso = $request->curso;
        $aluno->instagram = $request->instagram;
        $aluno->tipo = $request->tipo;
        $aluno->observacoes = $request->observacoes;
        $aluno->save();

        return redirect()->route('escola.cronograma')->with('success', 'Aluno atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $aluno = Escola::find($id);
        $aluno->delete();
        return redirect()->route('escola.cronograma');
    }
    
    public function checkCourseLimit(Request $request)
{
    $curso = $request->query('curso');
    $horario = $request->query('horario');
    $diaSemana = $request->query('dia_semana');
    
    // Total de alunos cadastrados naquele horário e dia
    $totalStudents = Escola::where('horario', $horario)
        ->where('dia_semana', $diaSemana)
        ->count();

    // Total de Escolas para o curso no mesmo horário e dia
    $courseStudents = Escola::where('curso', $curso)
        ->where('horario', $horario)
        ->where('dia_semana', $diaSemana)
        ->count();

    return response()->json([
        'totalCount' => $totalStudents,
        'courseCount' => $courseStudents
    ]);
}

}