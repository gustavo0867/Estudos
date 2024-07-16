
const calculaIMC = (peso, altura) => {

    let imc = peso / (Math.pow(altura, 2));

    console.log(`Seu calculo de imc foi de ${imc.toFixed(2)} e a sua situação é de: `)

    if (imc < 18.5) {
        console.log('Abaixo do peso');
    } else if (imc >= 18.5 && imc <= 25) {
        console.log('Normal');
    } else if (imc >= 25 && imc <= 30) {
        console.log('Acima do peso');
    } else if (imc >= 30 && imc <= 40) {
        console.log('Obeso');
    } else console.log('Obesidade grave')


}

var p = 40;
var a = 1.80;

calculaIMC(p, a);