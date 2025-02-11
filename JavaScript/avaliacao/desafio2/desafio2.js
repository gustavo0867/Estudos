const { gets, print, tam } = require('./auxiliar2');

const calcula = (tamanho) => {
    let maior = null;
    let menor = null;

    for (let i = 0; i < tamanho; i++) {
        let n = gets();

        if (n % 2 == 0) {

            if (maior === null||n > maior) {
                maior = n;
            }

        } else {

            if (menor === null||n < menor) {
                menor = n;
            }
        }
    }
    print(`Maior par: ${maior}`);
    print(`Menor impar: ${menor}`);
}






const teste = tam();
calcula(teste);