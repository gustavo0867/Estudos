

const num = [5, 6, 7, 8, 9, 10, 11, 12, 1, 13, 0, 14, 15];



function tam() {
    return num.length;
}
let i = 0;
function gets() {
    const retorno = num[i];
    i++;
    return retorno;
}

function print(value) {
    console.log(value);
}


module.exports = { gets, print, tam };