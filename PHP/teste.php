<?

    //declarando variaveis 
    $nome = 'Gustavo';

    echo $nome;

    echo "<br>";
    echo 'O meu nomé é: ' .$nome;

    echo "<br>";
    $Gustavo = 'Testando';

    echo  'O meu nomé é: ' .$$nome;

    echo "<br>";

    // == converte e === é estritamente igual 
    if($nome == 'Gustavo'){
        echo 'Entrou no if';
    }else{  
        echo 'Entrou no else';
    }


    for($i = 0; $i < 10; $i++){
        echo 'O valor de i é: ' .$i;
        echo "<hr>";
    }

    $i =0;

    while($i < 10){
        echo 'O valor de i é: ' .$i;
        echo "<hr>";
        $i++;
    }
    



    //funcoes 

    function exibirNome($nome){
        echo '<br>';
        echo 'Meu nome é: ' .$nome;
    }

    exibirNome('ola funcao');

    
    //classe 

    class Pessoa{
        public $nome;
        public $idade;
        public function __construct($nome, $idade){
            $this->nome =  $nome;
            $this->idade = $idade;
        }

        public function print(){
            echo $this->nome;
            echo "<br>";
            echo $this->idade;
        }
    }

    $pessoa = new Pessoa('Testando classe', 21);

    $pessoa->print();





    $array = array('Gustavo', 'Joao', 'Maria');

    echo "<br>";
    foreach($array as $key => $value){
        echo $key;
        echo "<br>";
        echo $value;
        echo "<br>";
    }


?>