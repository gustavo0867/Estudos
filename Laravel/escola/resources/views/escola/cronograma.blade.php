<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY ROBOT SCHOOL DOURADOS - Cronograma</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #fff;
        }

        th {
            background-color: #ff7f50;
        }

        tr:nth-child(even) {
            background-color: #ff6347;
        }

        a button {
            background-color: #ff7f50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a button:hover {
            background-color: #ff6347;
        }
    </style>
</head>
<body>
    <h1>MY ROBOT SCHOOL DOURADOS</h1>
    <h2>Cronograma de {{ $dia }}</h2>

    <!-- Seção Manhã -->
    <h3>Manhã</h3>
    <table>
        <thead>
            <tr>
                <th>Horário</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Instagram</th>
                <th>Tipo de Aula</th>
                <th>Observações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $item)
                @if($item->horario >= '07:00' && $item->horario < '12:00')
                    <tr>
                        <td>{{ $item->horario }}</td>
                        <td>{{ $item->nome_aluno }}</td>
                        <td>{{ $item->curso }}</td>
                        <td>{{ $item->instagram }}</td>
                        <td>{{ $item->tipo }}</td>
                        <td>{{ $item->observacoes }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <!-- Seção Tarde -->
    <h3>Tarde</h3>
    <table>
        <thead>
            <tr>
                <th>Horário</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Instagram</th>
                <th>Tipo de Aula</th>
                <th>Observações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $item) 
                @if($item->horario >= '13:00' && $item->horario < '18:00')
                    <tr>
                        <td>{{ $item->horario }}</td>
                        <td>{{ $item->nome_aluno }}</td>
                        <td>{{ $item->curso }}</td>
                        <td>{{ $item->instagram }}</td>
                        <td>{{ $item->tipo }}</td>
                        <td>{{ $item->observacoes }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <!-- Botão para ir até a tela de cadastro -->
    <a href="{{ route ('escola.cadastro') }}">
        <button>Cadastrar Aluno</button>
    </a>
</body>
</html>
