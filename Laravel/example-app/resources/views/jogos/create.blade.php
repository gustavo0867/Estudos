<!--herda o que tem no app -->
@extends('layouts.app')

@section('title', 'Cadastrar Jogo')

@section('content')
    <div class="container">
        <h1>Crie um novo jogo</h1>
        <hr>
        <form action="{{route('jogos.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="nome">Nome: </label>
                <input type="text" class="form-control" name="nome" placeholder="Digite um nome...">
                </div>
                
            </div>
            <br>
            <div class="form-group">
                <div class="form-group">
                    <label for="categoria">Categoria: </label>
                <input type="text" class="form-control" name="categoria" placeholder="Digite uma categoria para o jogo...">
                </div>
                
            </div>
            <br>
            <div class="form-group">
                <div class="form-group">
                    <label for="ano">Ano: </label>
                <input type="number" class="form-control" name="ano" placeholder="Digite um ano...">
                </div>
                
            </div>
            <br>
            <div class="form-group">
                <div class="form-group">
                    <label for="valor">Valor: </label>
                <input type="number" class="form-control" name="valor" placeholder="Digite um valor...">
                </div>
                
            </div>
            <br>
            <button type="submit" value="enviar" name="submit" class="btn btn-primary">Cadastrar</button>

            
            
        </form>
    </div>
@endsection