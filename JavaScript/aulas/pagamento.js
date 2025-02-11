const pagamento = (preco, opcao) => {

    switch (opcao) {
        case 1:
            console.log('Opcão débito');
            console.log(`Valor a ser pago é de: ${preco = preco * 0.90}`)
            break;
        case 2:
            console.log('Opcão à vista');
            console.log(`Valor a ser pago é de: ${preco = preco * 0.85}`)
            break;
        case 3:
            console.log('Opcão 2 vezes');
            console.log(`Valor a ser pago é de: ${preco}`)
            break;
        case 4:
            console.log('Opcão acima de duas vezes');
            console.log(`Valor a ser pago é de: ${(preco = preco * 1.10).toFixed(2)}`)
            break;

    }
}

var pp = 100;
op = 4;

pagamento(pp,op);