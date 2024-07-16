
var nota1 = 5, nota2 = 6, nota3 = 8;

const calculaMedia = (n1, n2, n3) => {

    let x = (n1 + n2 + n3) / 3

    console.log(`A média foi de: ${x.toFixed(2)} e a situação do é: `);

    if (x > 7) {
        console.log("aprovado");
    } else if (x >= 5 && x <= 7) {
        console.log("recuperação")
    } else console.log("reprovado")


};

calculaMedia(nota1, nota2, nota3);

nota1 = 10, nota2 = 10, nota3 = 7;

calculaMedia(nota1, nota2, nota3);
