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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
        }

        a {
            display: inline-block;
            width: 150px; /* Define uma largura fixa para os links */
            padding: 10px 20px;
            background-color: #ff7f50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button {
            background-color: #4facfe;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #00f2fe;
        }

        a:hover {
            background-color: #ff6347;
        }
    </style>
</head>
<body>
    <h1>MY ROBOT SCHOOL DOURADOS</h1>
    <h2>Cronograma da Semana</h2>
    <ul>
            <li><a href="{{ url('/cronograma/segunda') }}">Segunda-feira</a></li>
            <li><a href="{{ url('/cronograma/terça') }}">Terça-feira</a></li>
            <li><a href="{{ url('/cronograma/quarta') }}">Quarta-feira</a></li>
            <li><a href="{{ url('/cronograma/quinta') }}">Quinta-feira</a></li>
            <li><a href="{{ url('/cronograma/sexta') }}">Sexta-feira</a></li>
            <li><a href="{{ url('/cronograma/sábado') }}">Sábado</a></li>

    </ul>
    <hr style="border: 1px solid #fff; margin: 20px 0;">
    <!-- Botão para ir até a tela de cadastro -->
    <a href="{{ route ('escola.cadastro') }}">
        <button>Cadastrar    Aluno</button>
    </a>
</body>
</html>
