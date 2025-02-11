const {gets, print } = require('./auxiliar1');

const num = gets();

const situacao = (media) => {
    if (media >= 7 && media <= 10) {
        print("Aprovado");
    } else if (media >= 5 && media < 7) {
        print("Recuperação");
    } else if(media < 5 && media>=0){ 
        print("Reprovado");
    }else{
        print("Nota inválida");
    }
}




situacao(num);