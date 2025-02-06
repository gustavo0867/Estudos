const notas =   [10, 6, 8, 7, 9];
let soma = 0;
for (let i = 0; i < notas.length; i++) {
    soma = soma + notas[i];
    console.log(soma);
    if (i === notas.length - 1) {
        console.log(soma / notas.length);
    }
}