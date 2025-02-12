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
      table-layout: fixed;
    }
    th, td {
      padding: 10px;
      border: 1px solid #fff;
      word-break: break-word;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    th {
      background-color: #ff7f50;
    }
    .action-buttons {
      display: flex;
      gap: 5px;
      justify-content: center;
    }
    .btn {
      padding: 5px 10px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }
    .btn-primary {
      background-color: #007bff;
      color: white;
    }
    .btn-danger {
      background-color: #dc3545;
      color: white;
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
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($dados as $item)
        @if($item->horario >= '07:00' && $item->horario < '12:00')
          @php
            $bgColor = '';
            if ($item->tipo == 'Regular') {
              $bgColor = 'background-color: #3F00FF; color: #fff;';
            } elseif ($item->tipo == 'Reposição') {
              $bgColor = 'background-color: #28a745; color: #fff;';
            } elseif ($item->tipo == 'Experimental') {
              $bgColor = 'background-color: #9932CC; color: #fff;';
            }
          @endphp
          <tr style="{{ $bgColor }}">
            <td>{{ $item->horario }}</td>
            <td>{{ $item->nome_aluno }}</td>
            <td>{{ $item->curso }}</td>
            <td>{{ $item->instagram }}</td>
            <td>{{ $item->tipo }}</td>
            <td>{{ $item->observacoes }}</td>
            <td class="action-buttons">
              <a href="{{ route('escola.edit', ['id'=>$item->id])}}" class="btn btn-primary" >✏️</a>
              <form action="{{ route('escola.destroy', ['id'=>$item->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️</button>
              </form>
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>

  <!-- Seção Tarde -->
  <h3>Tarde</h3>
  @php
    // Filtra os dados que se encaixam no período da tarde
    $tardeItems = $dados->filter(function($item) {
      return ($item->horario >= '13:00' && $item->horario < '18:00');
    })->sortBy(function($item) {
      // Define a ordem desejada para os horários da tarde
      $order = [
        '13:00-15:00' => 1,
        '15:00-17:00' => 2,
      ];
      // Se o horário não estiver definido no array, posiciona ao final
      return $order[$item->horario] ?? 100;
    });
  @endphp
  <table>
    <thead>
      <tr>
        <th>Horário</th>
        <th>Aluno</th>
        <th>Curso</th>
        <th>Instagram</th>
        <th>Tipo de Aula</th>
        <th>Observações</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tardeItems as $item)
        @php
          $bgColor = '';
          if ($item->tipo == 'Regular') {
            $bgColor = 'background-color: #3F00FF; color: #fff;';
          } elseif ($item->tipo == 'Reposição') {
            $bgColor = 'background-color: #28a745; color: #fff;';
          } elseif ($item->tipo == 'Experimental') {
            $bgColor = 'background-color: #9932CC; color: #fff;';
          }
        @endphp
        <tr style="{{ $bgColor }}">
          <td>{{ $item->horario }}</td>
          <td>{{ $item->nome_aluno }}</td>
          <td>{{ $item->curso }}</td>
          <td>{{ $item->instagram }}</td>
          <td>{{ $item->tipo }}</td>
          <td>{{ $item->observacoes }}</td>
          <td class="action-buttons">
            <a href="{{ route('escola.edit', ['id'=>$item->id])}}" class="btn btn-primary">✏️</a>
            <form action="{{ route('escola.destroy', ['id'=>$item->id])}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">🗑️</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Botão para cadastrar um novo aluno -->
  <a href="{{ route('escola.cadastro') }}">
    <button>Cadastrar Aluno</button>
  </a>
</body>
</html>
