
class salario{
    salarioBruto;
    adicional;

    constructor(salarioBruto, adicional){ 
        this.salarioBruto = salarioBruto;
        this.adicional = adicional;
    }

}

const valor = new salario(1000, 100);


function gets(){
    return valor;
}

function print (x) {
  console.log(x);
}



module.exports = { gets, print }