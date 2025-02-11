const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

class Pessoa {
    nome;
    peso;
    altura;

    constructor(nome, peso, altura) {
        this.nome = nome;
        this.peso = peso;
        this.altura = altura;
    }

    calculando() {
        return this.peso / (this.altura * this.altura);
    }

    calculaImc() {
        const imc = this.calculando();

        if (imc < 18.5) {
            console.log('Abaixo do peso');
        } else if (imc >= 18.5 && imc <= 25) {
            console.log('Normal');
        } else if (imc >= 25 && imc <= 30) {
            console.log('Acima do peso');
        } else if (imc >= 30 && imc <= 40) {
            console.log('Obeso');
        } else {
            console.log('Obesidade grave');
        }
    }
}

function obterDados() {
    rl.question('Digite o nome: ', (nome) => {
        rl.question('Digite o peso (kg): ', (peso) => {
            rl.question('Digite a altura (m): ', (altura) => {
                const pessoa = new Pessoa(nome, peso, altura);
                pessoa.calculaImc();
                rl.question('Deseja continuar? (S/N): ', (resposta) => {
                    if (resposta.toUpperCase() === 'S') {
                        obterDados();
                    } else {
                        rl.close();
                    }
                });
            });
        });
    });
}

obterDados();
