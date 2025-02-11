class Carros {
    marca;
    cor; 
    gastoMedio;

    constructor(marca,cor,gastoMedio){
        this.marca = marca;
        this.cor = cor;
        this.gastoMedio = gastoMedio;
    }

    calculaGasto = (km,precoCombustivel) =>  {
        let valor = (km*this.gastoMedio)*precoCombustivel
        console.log(`O valor gasto será  de ${valor}`);
    }
}

const palio = new Carros('Fiat','Prata',1/35);


palio.calculaGasto(300,6)