//calcula e imprima o salario de um funcionario
// receba o valor bruto do salario + adicional 
// valor bruto -  percentual imposto do salario 
//0 a 1100 == 5%
//1100 a 250 == 10%
//maior que 2500 == 15%

const {gets, print} = require ('./auxiliar3.js');


const calculaImposto = (salario) => {
    let imposto = 0;
    if(salario <= 1100){
        return imposto = salario * 0.05;

    }else if(salario <= 2500){
        return imposto = salario * 0.10;
    }else{
        return imposto = salario * 0.15;
    }
}

const calculaSalario = (valor) => {
    let imposto = calculaImposto(valor.salarioBruto);
    let salarioLiquido = valor.salarioBruto - imposto + valor.adicional;
    print(`Valor a ser transferido: ${salarioLiquido}`);
    
}



const pessoa = gets();

calculaSalario(pessoa);