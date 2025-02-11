const num = [34,67,98,23,45]

let i=0;

function gets(){
    const valor = num[i];
    i++;
    return valor;
}

function print (texto){
    console.log(texto)
}


module.exports = {gets,  print}