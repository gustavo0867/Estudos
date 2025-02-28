<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MY ROBOT SCHOOL DOURADOS - Cronograma</title>
  <style>
    /* Reset básico */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: Arial, sans-serif;
      background-color:  #4facfe;
      color: #fff;
      text-align: center;
      padding: 20px;
    }
    header, main, footer {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }
    header {
      margin-bottom: 20px;
    }
    h1 {
      font-size: 2.5rem;
      margin-bottom: 10px;
    }
    h2 {
      font-size: 2rem;
      margin-bottom: 20px;
    }
    h3 {
      font-size: 1.5rem;
      margin: 20px 0 10px;
    }
    /* Container responsivo para tabelas */
    .table-responsive {
      overflow-x: auto;
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
    }
    th {
      background-color: #ff7f50;
    }
    /* Badge styles */
    .badge {
      display: inline-block;
      padding: 0.25em 0.4em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25rem;
    }
    .badge-regular {
      background-color: #3F00FF;
      color: #fff;
    }
    .badge-reposicao {
      background-color: #28a745;
      color: #fff;
    }
    .badge-experimental {
      background-color: #9932CC;
      color: #fff;
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
      font-size: 1rem;
    }
    .btn-primary {
      background-color: #007bff;
      color: #fff;
    }
    .btn-danger {
      background-color: #dc3545;
      color: #fff;
    }
    a button {
      background-color: #ff7f50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 1rem;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    a button:hover {
      background-color: #ff6347;
    }
    /* Media queries para responsividade */
    @media (max-width: 768px) {
      h1 {
        font-size: 2rem;
      }
      h2 {
        font-size: 1.5rem;
      }
      h3 {
        font-size: 1.25rem;
      }
      th, td {
        padding: 8px;
        font-size: 0.9rem;
      }
    }
    /* Classe para esconder visualmente elementos, mas mantê-los acessíveis (ex.: captions) */
    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      border: 0;
    }
  </style>
</head>
<body>
  <header>
    <h1>MY ROBOT SCHOOL DOURADOS</h1>
    <h2>Cronograma de {{ $dia }}</h2>
  </header>
  <main>
    <!-- Seção Manhã -->
    <section aria-labelledby="manha">
      <h3 id="manha">Manhã</h3>
      <div class="table-responsive">
        <table>
          <caption class="sr-only">Cronograma da Manhã</caption>
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
                <tr>
                  <td>{{ $item->horario }}</td>
                  <td>{{ $item->nome_aluno }}</td>
                  <td>{{ $item->curso }}</td>
                  <td>{{ $item->instagram }}</td>
                  <td>
                    @php
                      $badgeClass = '';
                      if ($item->tipo == 'Regular') {
                        $badgeClass = 'badge-regular';
                      } elseif ($item->tipo == 'Reposição') {
                        $badgeClass = 'badge-reposicao';
                      } elseif ($item->tipo == 'Experimental') {
                        $badgeClass = 'badge-experimental';
                      }
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ $item->tipo }}</span>
                  </td>
                  <td>{{ $item->observacoes }}</td>
                  <td class="action-buttons">
                    <a href="{{ route('escola.edit', ['id'=>$item->id])}}" class="btn btn-primary" aria-label="Editar aluno">✏️</a>
                    <form action="{{ route('escola.destroy', ['id'=>$item->id])}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" aria-label="Excluir aluno">🗑️</button>
                    </form>
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </section>

    <!-- Seção Tarde - 1º Horário -->
    <section aria-labelledby="tarde1">
      <h3 id="tarde1">1º Horário Tarde</h3>
      @php
        // Filtra os dados para o 1º horário da tarde (13:00 até 15:00)
        $tardeItems1 = $dados->filter(function($item) {
          return ($item->horario >= '13:00' && $item->horario <= '15:00');
        });
      @endphp
      <div class="table-responsive">
        <table>
          <caption class="sr-only">Cronograma do 1º Horário Tarde</caption>
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
            @foreach($tardeItems1 as $item)
              <tr>
                <td>{{ $item->horario }}</td>
                <td>{{ $item->nome_aluno }}</td>
                <td>{{ $item->curso }}</td>
                <td>{{ $item->instagram }}</td>
                <td>
                  @php
                    $badgeClass = '';
                    if ($item->tipo == 'Regular') {
                      $badgeClass = 'badge-regular';
                    } elseif ($item->tipo == 'Reposição') {
                      $badgeClass = 'badge-reposicao';
                    } elseif ($item->tipo == 'Experimental') {
                      $badgeClass = 'badge-experimental';
                    }
                  @endphp
                  <span class="badge {{ $badgeClass }}">{{ $item->tipo }}</span>
                </td>
                <td>{{ $item->observacoes }}</td>
                <td class="action-buttons">
                  <a href="{{ route('escola.edit', ['id'=>$item->id])}}" class="btn btn-primary" aria-label="Editar aluno">✏️</a>
                  <form action="{{ route('escola.destroy', ['id'=>$item->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" aria-label="Excluir aluno"></button>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"></svg>
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                      </svg> 
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>

    <!-- Seção Tarde - 2º Horário -->
    <section aria-labelledby="tarde2">
      <h3 id="tarde2">2º Horário Tarde</h3>
      @php
        // Filtra os dados para o 2º horário da tarde (15:00 até 17:00)
        $tardeItems2 = $dados->filter(function($item) {
          return ($item->horario >= '15:00' && $item->horario <= '17:00');
        });
      @endphp
      <div class="table-responsive">
        <table>
          <caption class="sr-only">Cronograma do 2º Horário Tarde</caption>
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
            @foreach($tardeItems2 as $item)
              <tr>
                <td>{{ $item->horario }}</td>
                <td>{{ $item->nome_aluno }}</td>
                <td>{{ $item->curso }}</td>
                <td>{{ $item->instagram }}</td>
                <td>
                  @php
                    $badgeClass = '';
                    if ($item->tipo == 'Regular') {
                      $badgeClass = 'badge-regular';
                    } elseif ($item->tipo == 'Reposição') {
                      $badgeClass = 'badge-reposicao';
                    } elseif ($item->tipo == 'Experimental') {
                      $badgeClass = 'badge-experimental';
                    }
                  @endphp
                  <span class="badge {{ $badgeClass }}">{{ $item->tipo }}</span>
                </td>
                <td>{{ $item->observacoes }}</td>
                <td class="action-buttons">
                  <a href="{{ route('escola.edit', ['id'=>$item->id])}}" class="btn btn-primary" aria-label="Editar aluno">✏️</a>
                  <form action="{{ route('escola.destroy', ['id'=>$item->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" aria-label="Excluir aluno">🗑️</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <footer>
    <!-- Botão para cadastrar um novo aluno -->
    <a href="{{ route('escola.cadastro') }}">
      <button type="button" aria-label="Cadastrar novo aluno">Cadastrar Aluno</button>
    </a>
    <br>
    <br>
    
    <!-- Botão para voltar -->
    <a href="{{ route('escola.cronograma') }}">
        <button>Voltar</button>
    </a>
  </footer>
</body>
</html>
