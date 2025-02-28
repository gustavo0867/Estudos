<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #4facfe;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        form {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }

        label {
            align-self: flex-start;
            margin-bottom: 2px;
            font-size: 14px;
        }

        input, select, textarea, button, a button {
            width: 100%;
            padding: 10px;
            margin-bottom: 8px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input, select, textarea {
            background-color: #ffffff;
            color: #000;
        }

        textarea {
            resize: none;
            height: 50px;
        }

        button {
            background-color: #ff7f50;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #ff6347;
        }
    </style>
</head>
<body>
    <h1>Editar Aluno</h1>

    @if ($errors->any())
        <div style="color: red; text-align: center;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('escola.update', ['id' => $aluno->id ]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="dia_semana">Dia da Semana:</label>
        <select id="dia_semana" name="dia_semana" required onchange="updateHorarios()">
            @foreach(['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado'] as $dia)
                <option value="{{ $dia }}" {{ $aluno->dia_semana == $dia ? 'selected' : '' }}>{{ ucfirst($dia) }}</option>
            @endforeach
        </select>

        <label for="horario">Horário:</label>
        <select id="horario" name="horario" required>
            {{-- As opções serão atualizadas pelo JavaScript --}}
        </select>

        <label for="nome_aluno">Nome do Aluno:</label>
        <input type="text" id="nome_aluno" name="nome_aluno" value="{{ $aluno->nome_aluno }}" required>

        <label for="curso">Curso:</label>
        <select id="curso" name="curso" required>
            @foreach(['first', 'onebot', 'techbot', 'autobo', 'gamebot', 'gamebotadv', 'gamebotexp', 'aibot', 'aibotadv', 'developer'] as $curso)
                <option value="{{ $curso }}" {{ $aluno->curso == $curso ? 'selected' : '' }}>{{ ucfirst($curso) }}</option>
            @endforeach
        </select>

        <label for="instagram">Instagram (opcional):</label>
        <input type="text" id="instagram" name="instagram" value="{{ $aluno->instagram }}" placeholder="@">

        <label for="tipo">Tipo de Aula:</label>
        <select id="tipo" name="tipo" required>
            @foreach(['Regular', 'Experimental', 'Reposição'] as $tipo)
                <option value="{{ $tipo }}" {{ $aluno->tipo == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
            @endforeach
        </select>

        <label for="observacoes">Observações:</label>
        <textarea id="observacoes" name="observacoes">{{ $aluno->observacoes }}</textarea>

        <button type="submit">Atualizar</button>
    </form>

    <br>

    <a href="{{ url('/') }}" style="display: inline-block; text-decoration: none;">
        <button type="button">Voltar ao Cronograma</button>
    </a>

    <script>
        const horariosPorDia = {
            'segunda': ['09:00-11:00', '13:00-15:00', '15:00-17:00'],
            'terça': ['09:00-11:00', '13:00-15:00', '15:00-17:00'],
            'quarta': ['09:00-11:00', '13:00-15:00', '15:00-17:00'],
            'quinta': ['09:00-11:00', '13:00-15:00', '15:00-17:00'],
            'sexta': ['09:00-11:00', '13:00-15:00', '15:00-17:00'],
            'sábado': ['08:00-10:00', '10:00-12:00']
        };

        function updateHorarios() {
            const diaSelecionado = document.getElementById('dia_semana').value;
            const horarios = horariosPorDia[diaSelecionado] || [];
            const horarioSelect = document.getElementById('horario');

            horarioSelect.innerHTML = ''; // Limpa as opções existentes

            horarios.forEach(horario => {
                const option = document.createElement('option');
                option.value = horario;
                option.text = horario;

                // Seleciona o horário atual do aluno, se aplicável
                if ("{{ $aluno->horario }}" === horario) {
                    option.selected = true;
                }

                horarioSelect.appendChild(option);
            });
        }

        // Chama a função para inicializar os horários na carga da página
        updateHorarios();
    </script>
</body>
</html>