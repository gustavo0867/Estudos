const {gets, print } = require('./auxiliar');



let maior=0;
for (let i=0; i<5; i++){
    let num = (gets());
    console.log(`O ${i+1}º número é: ${num}`);
    if(num > maior){
        maior = num;        
    }
} 
print(maior);


