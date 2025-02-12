<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Aluno</title>
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

        input, select {
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
    <h1>Cadastrar Novo Aluno</h1>

    <form action="{{ url('/cadastrar') }}" method="POST">
        @csrf

        <label for="dia_semana">Dia da Semana:</label>
        <select name="dia_semana" required>
            <option value="segunda">Segunda-feira</option>
            <option value="terça">Terça-feira</option>
            <option value="quarta">Quarta-feira</option>
            <option value="quinta">Quinta-feira</option>
            <option value="sexta">Sexta-feira</option>
            <option value="sábado">Sábado</option>
        </select>

        <label for="horario">Horário:</label>
        <select name="horario" required>
            <option value="09:00-11:00">09:00 - 11:00</option>
            <option value="13:00-15:00">13:00 - 15:00</option>
            <option value="15:00-17:00">15:00 - 17:00</option>
            <option value="08:00-10:00">08:00 - 10:00 (Sábado)</option>
            <option value="10:00-12:00">10:00 - 12:00 (Sábado)</option>
        </select>

        <label for="nome_aluno">Nome do Aluno:</label>
        <input type="text" name="nome_aluno" required>

        <label for="curso">Curso:</label>
        <select name="curso" required>
            <option value="first"> First </option>
            <option value="onebot">Onebot</option>
            <option value="techbot">Tech</option>
            <option value="autobo">Autobot</option>
            <option value="gamebot">Gamebot</option>
            <option value="gamebotadv">Gamebot Advanced</option>
            <option value="gamebotexp">Gamebot Expert</option>
            <option value="aibot">Aibot</option>
            <option value="aibotadv">Aibot Advanced</option>
            <option value="developer">App Developer</option>
        </select>

        <label for="instagram">Instagram (opcional):</label>
        <input type="text" name="instagram" placeholder="@">

        <label for="tipo">Tipo de Aula:</label>
        <select name="tipo" required>
            <option value="regular">Aula Regular</option>
            <option value="experimental">Aula Experimental</option>
            <option value="reposicao">Aula de Reposição</option>
        </select>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" rows="4" style="width: 100%; padding: 10px; margin: 10px 0; border: none; border-radius: 5px;"></textarea>

        <button type="submit">Cadastrar</button>
    </form>

    <br><br>
    <a href="{{ url('/') }}">
        <button>Voltar ao Cronograma</button>
    </a>

</body>
</html>
