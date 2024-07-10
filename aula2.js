var tipoDeCombustivel = 'Gasolina';
var gastoMedio = 35;
var distancia = 350;
var valor;


const gastoviagem = (tipo,kmlitro,distancia) => {
    let precoEtanol = 4;
    let precoGasolina = 5.95;
    let x;

    if(tipo==='Etanol'){
        return x =(distancia/kmlitro)*precoEtanol;
    }else if(tipo==='Gasolina'){
        return x =(distancia/kmlitro)*precoGasolina;
    } else return "Tipo de combustível inválido";
};

valor = gastoviagem(tipoDeCombustivel,gastoMedio,distancia);
console.log(`O gasto foi de ${valor.toFixed(2)}`);
