<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jogo da Velha</title>
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f0f0f0;
}

#container {
  text-align: center;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
}

h1 {
  margin-bottom: 20px;
  color: #333;
}

#botoes {
  margin-bottom: 20px;
}

#botoes button {
  margin: 10px;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  background-color: #007bff;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

#botoes button:hover {
  background-color: #0056b3;
}

#jogo {
  display: grid;
  grid-template-columns: repeat(3, 100px);
  grid-template-rows: repeat(3, 100px);
  gap: 5px;
  margin-top: 20px;
}

#jogo div {
  background-color: #ffffff; /* Fundo branco */
  border: 2px solid #007bff; /* Bordas azuis */
  font-size: 36px;
  color:  #000000; ; /* Cor do texto azul */
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease; /* Transição suave para fundo e cor */
}

#jogo div:hover {
  background-color: #b5d3f3; /* Fundo azul ao passar o mouse */
  color:#0051ff /* Texto branco ao passar o mouse */
}

#status {
  margin-top: 20px;
  font-size: 18px;
  color: #000000; /* Cor azul para o status */
  text-align: center;
}
/* Estilos para o modal */
.modal {
  display: none; /* Escondido por padrão */
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  max-width: 300px;
  margin: auto;
}

.close {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 24px;
  cursor: pointer;
}

#playAgainBtn {
  margin-top: 20px;
  padding: 10px 20px;
  font-size: 16px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

#playAgainBtn:hover {
  background-color: #0056b3;
}

  </style>
</head>

<body>

  <div id="container">
    <h1>Jogo da Velha</h1>
    <h3>Gustavo Ferreira França Reis</h3>

    <div id="botoes">
      <button onclick="iniciarContraIA('facil')">Jogar Contra IA (Fácil)</button>
      <button onclick="iniciarContraIA('medio')">Jogar Contra IA (Médio)</button>
      <button onclick="iniciarContraIA('dificil')">Jogar Contra IA (Difícil)</button>
      <button onclick="iniciarContraJogador()">Jogar Contra Outro Jogador</button>
    </div>

    <div id="jogo">
      <div id="c0,0"></div>
      <div id="c0,1"></div>
      <div id="c0,2"></div>
      <div id="c1,0"></div>
      <div id="c1,1"></div>
      <div id="c1,2"></div>
      <div id="c2,0"></div>
      <div id="c2,1"></div>
      <div id="c2,2"></div>
    </div>
    <div id="modal" class="modal">
      <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <p id="modalMessage"></p>
        <button id="playAgainBtn">Jogar Novamente</button>
      </div>
    </div>


    <div id="status">Clique em um botão para iniciar o jogo.</div>
  </div>

  <script>
    var divs = document.querySelectorAll('#jogo div');
    var jogador, board, maxDepth;
    var contraIA = true;
    var modoDebug = true;  // Ativa ou desativa o modo debug
    
    // Função para inicializar o jogo contra IA com dificuldade
    function iniciarContraIA(dificuldade) {
        contraIA = true;
        if (dificuldade === 'facil') maxDepth = 0;
        if (dificuldade === 'medio') maxDepth = 3;
        if (dificuldade === 'dificil') maxDepth = 9;
        document.getElementById("status").innerText = "Jogador X, sua vez!";
        init();
    }
    
    // Função para inicializar o jogo contra outro jogador
    function iniciarContraJogador() {
        contraIA = false;
        document.getElementById("status").innerText = "Jogador X, sua vez!";
        init();
    }
    
    // Inicializa o tabuleiro
    function init() {
        jogador = 'X';
        board = [['', '', ''], ['', '', ''], ['', '', '']];
        drawBoard(board);
    }
    
    // Desenha o tabuleiro na interface
    function drawBoard(board) {
        for (var row in board) {
            for (var col in board[row]) {
                var id = 'c' + row + ',' + col;
                var div = document.getElementById(id);
                div.innerText = board[row][col];
            }
        }
    }
    
    // Função de clique para cada célula do tabuleiro
    for (var i in divs) {
        divs[i].onclick = (e) => {
            var coords = e.target.id.split('c')[1].split(',');
            var row = parseInt(coords[0]);
            var col = parseInt(coords[1]);
    
            if (board[row][col] == '') {
                board[row][col] = jogador;
                drawBoard(board);
    
                // Verifica se há vencedor ou empate
                var winner = checkWinner(board);
                if (winner) {
                    setTimeout(() => { showModal(winner + ' venceu!'); }, 16);
                } else if (isFull(board)) {
                    setTimeout(() => { showModal('Empate!'); }, 16);
                } else {
                    // Troca o jogador ou chama a IA
                    jogador = jogador == 'X' ? 'O' : 'X';
                    document.getElementById("status").innerText = "Jogador " + jogador + ", sua vez!";
                    if (contraIA && jogador == 'O') {
                        AI();
                    }
                }
            }
        };
    }
    
    // Verifica se o tabuleiro está cheio (empate)
    function isFull(board) {
        for (var row in board) {
            for (var col in board[row]) {
                if (board[row][col] == '') return false;
            }
        }
        return true;
    }
    
    // Verifica se há um vencedor
    function checkWinner(board) {
        // Linhas, colunas e diagonais
        for (let i = 0; i < 3; i++) {
            if (board[i][0] && board[i][0] == board[i][1] && board[i][1] == board[i][2]) return board[i][0];
            if (board[0][i] && board[0][i] == board[1][i] && board[1][i] == board[2][i]) return board[0][i];
        }
        if (board[0][0] && board[0][0] == board[1][1] && board[1][1] == board[2][2]) return board[0][0];
        if (board[0][2] && board[0][2] == board[1][1] && board[1][1] == board[2][0]) return board[0][2];
        return null;
    }
    
    // IA faz a jogada
    function AI() {
        var jogada = bestAction(board, 'O');
        if (jogada) {
            board[jogada.row][jogada.col] = 'O';
            drawBoard(board);
    
            // Verifica se a IA venceu ou houve empate
            var winner = checkWinner(board);
            if (winner) {
                setTimeout(() => { showModal(winner + ' venceu!'); }, 16);
            } else if (isFull(board)) {
                setTimeout(() => { showModal('Empate!'); }, 16);
            } else {
                jogador = 'X';
                document.getElementById("status").innerText = "Jogador X, sua vez!";
            }
        }
    }
    
    // Retorna as jogadas possíveis
    function jogadasPossiveis(board) {
        var jogadas = [];
        for (var row in board) {
            for (var col in board[row]) {
                if (board[row][col] == '') {
                    jogadas.push({ row: parseInt(row), col: parseInt(col) });
                }
            }
        }
        return jogadas;
    }
    
    
    
    // IA escolhe a melhor ação com poda Alfa-Beta
    function bestAction(board, eu) {
        var jogadas = jogadasPossiveis(board);
        var maiorValor = -Infinity;
        var melhorJogada = null;
    
        for (var i in jogadas) {
            // Simula a jogada no tabuleiro
            var resultado = jogada(board, jogadas[i], eu);
            var valor = minimax(resultado, eu == 'X' ? 'O' : 'X', eu, maxDepth, -Infinity, Infinity);
            // Se a jogada atual é a melhor até agora
            if (valor > maiorValor) {
                maiorValor = valor;
                melhorJogada = jogadas[i];
            }
    
            // Se o valor da jogada e o valor do maior valor são iguais a 999, então a IA tem a possibilidade de ganhar iminentemente
            else if (valor == 999 && maiorValor == 999) {
                // Criar uma cópia do tabuleiro
                let copiaTabuleiro = JSON.parse(JSON.stringify(board));
                let teste = JSON.parse(JSON.stringify(board));
                copiaTabuleiro[jogadas[i].row][jogadas[i].col] = 'O';
                
    
                // Verifica se a jogada leva a uma vitória iminente
                melhorJogada = (verificarVitoriaIminente(teste, 'O'));
                
            }
    
            if (modoDebug) {
                console.log("Jogada: " + jogadas[i].row + "," + jogadas[i].col + " -> Valor: " + valor);
                console.log("Tabuleiro resultante:");
                console.table(resultado);
                console.log("A jogada escolhida foi: " + melhorJogada.row + "," + melhorJogada.col);
            }
    
            
        }
    
        return melhorJogada;
    }
    
    // Verifica se há uma jogada iminente que leva à vitória
    function verificarVitoriaIminente(board, jogador) {
        for (var row = 0; row < 3; row++) {
            for (var col = 0; col < 3; col++) {
                if (board[row][col] == '') {
                    // Simula a jogada
                    board[row][col] = jogador;
                    if (checkWinner(board) == jogador) {
                        // Desfaz a jogada
                        board[row][col] = '';
                        console.log("Jogada de vitória iminente: " + row + "," + col);
                        return { row: row, col: col };
                    }
                    // Desfaz a jogada
                    board[row][col] = '';
                }
            }
        }
        return null;
    }
    
    
    // Simula uma jogada e retorna o novo estado do tabuleiro
    function jogada(board, jogada, jogador) {
        var novoBoard = JSON.parse(JSON.stringify(board));
        novoBoard[jogada.row][jogada.col] = jogador;
        return novoBoard;
    }
    
    // Minimax com poda Alfa-Beta
    function minimax(board, jogador, eu, depth, alpha, beta) {
        var winner = checkWinner(board);
        if (winner == eu) return 999;
        if (winner && winner != eu) return -999;
        if (!winner && isFull(board)) return 0;
        if (depth == 0) return heuristica(board, eu);
    
        var jogadas = jogadasPossiveis(board);
    
        if (jogador == eu) {  // MAX (IA)
            let best = -Infinity;
            for (let i in jogadas) {
                let resultado = jogada(board, jogadas[i], jogador);
                let valor = minimax(resultado, jogador == 'X' ? 'O' : 'X', eu, depth - 1, alpha, beta);
                best = Math.max(best, valor);
                alpha = Math.max(alpha, valor);
                if (beta <= alpha) break;  // Poda
            }
            return best;
        } else {  // MIN (Oponente)
            let best = Infinity;
            for (let i in jogadas) {
                let resultado = jogada(board, jogadas[i], jogador);
                let valor = minimax(resultado, jogador == 'X' ? 'O' : 'X', eu, depth - 1, alpha, beta);
                best = Math.min(best, valor);
                beta = Math.min(beta, valor);
                if (beta <= alpha) break;  // Poda
            }
            return best;
        }
    }
    
    // Heurística simples para estimar o valor do tabuleiro
    function heuristica(board, jogador) {
        var h = 0;
        var oponente = jogador == 'X' ? 'O' : 'X';
    
        for (var i = 0; i < 3; i++) {
            h += avaliarLinha(board[i][0], board[i][1], board[i][2], jogador, oponente);  // Linhas
            h += avaliarLinha(board[0][i], board[1][i], board[2][i], jogador, oponente);  // Colunas
        }
        h += avaliarLinha(board[0][0], board[1][1], board[2][2], jogador, oponente);  // Diagonal principal
        h += avaliarLinha(board[0][2], board[1][1], board[2][0], jogador, oponente);  // Diagonal secundária
    
        return h;
    }
    
    // Avalia uma linha (ou coluna ou diagonal) para a heurística
    function avaliarLinha(c1, c2, c3, jogador, oponente) {
        var score = 0;
    
        if (c1 == jogador) score++;
        else if (c1 == oponente) score--;
    
        if (c2 == jogador) score++;
        else if (c2 == oponente) score--;
    
        if (c3 == jogador) score++;
        else if (c3 == oponente) score--;
    
        return score;
    }
    
    
    function showModal(message) {
        var modal = document.getElementById('modal');
        var modalMessage = document.getElementById('modalMessage');
        modalMessage.innerText = message;
        modal.style.display = 'flex';
    }
    
    document.getElementById('closeModal').onclick = function () {
        closeModal();
    };
    document.getElementById('playAgainBtn').onclick = function () {
        closeModal();
        init(); // Reinicia o jogo
    };
    
    function closeModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
    }
    
    
    </script>

</body>

</html>