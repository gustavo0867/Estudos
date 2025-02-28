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
        $escola = Escola::where('id', $request->id)->first();
        if(!empty($escola))
                {
                        $escola->update($request->all());
                        return redirect()->route('escola.cronograma');
                } else {
                        return redirect()->route('escola.cronograma');
                }
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