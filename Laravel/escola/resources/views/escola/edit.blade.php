<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        form {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        button {
            background-color: #ff7f50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff6347;
        }
    </style>
</head>
<body>
    <h1>Editar Aluno</h1>

    <form action="{{ route('escola.update', ['id' => $aluno->id ]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="dia_semana">Dia da Semana:</label>
        <select name="dia_semana" required>
            @foreach(['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado'] as $dia)
                <option value="{{ $dia }}" {{ $aluno->dia_semana == $dia ? 'selected' : '' }}>{{ ucfirst($dia) }}</option>
            @endforeach
        </select>

        <label for="horario">Horário:</label>
        <select name="horario" required>
            @foreach(['09:00-11:00', '13:00-15:00', '15:00-17:00', '08:00-10:00', '10:00-12:00'] as $hora)
                <option value="{{ $hora }}" {{ $aluno->horario == $hora ? 'selected' : '' }}>{{ $hora }}</option>
            @endforeach
        </select>

        <label for="nome_aluno">Nome do Aluno:</label>
        <input type="text" name="nome_aluno" value="{{ $aluno->nome_aluno }}" required>

        <label for="curso">Curso:</label>
        <select name="curso" required>
            @foreach(['first', 'onebot', 'techbot', 'autobo', 'gamebot', 'gamebotadv', 'gamebotexp', 'aibot', 'aibotadv', 'developer'] as $curso)
                <option value="{{ $curso }}" {{ $aluno->curso == $curso ? 'selected' : '' }}>{{ ucfirst($curso) }}</option>
            @endforeach
        </select>

        <label for="instagram">Instagram (opcional):</label>
        <input type="text" name="instagram" value="{{ $aluno->instagram }}" placeholder="@">

        <label for="tipo">Tipo de Aula:</label>
        <select name="tipo" required>
            @foreach(['Regular', 'Experimental', 'Reposição'] as $tipo)
                <option value="{{ $tipo }}" {{ $aluno->tipo == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
            @endforeach
        </select>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" rows="4">{{ $aluno->observacoes }}</textarea>

        <button type="submit" value="enviar" name="submit"  class="btn btn-success">Atualizar</button>

    </form>

    <br><br>
    <a href="{{ url('/') }}">
        <button>Voltar ao Cronograma</button>
    </a>

</body>
</html>
