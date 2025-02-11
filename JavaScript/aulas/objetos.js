class Pessoa {
    nome; 
    idade; 

    constructor (nome,idade){
        this.nome = nome;
        this.idade = idade;
    }
}





const comparaPessoas = (p1,p2) => {
    p1.idade>p2.idade ? console.log(`A ${p1.nome} é mais velho(a) que a ${p2.nome}`) : p2.idade>p1.idade ?
     console.log(`A ${p2.nome} é mais velho(a) que a ${p1.nome}`): console.log('Os dois tem a mesma idade')
    
    }


const lucas = new Pessoa("Lucas", 26)
const marcos = new Pessoa("Marcos", 29)
const gustavo = new Pessoa("Gustavo",29)

comparaPessoas(gustavo,marcos)

