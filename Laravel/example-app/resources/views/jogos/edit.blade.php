<!--herda o que tem no app -->
@extends('layouts.app')

@section('title', 'Editar Jogo')

@section('content')
    <div class="container">
        <h1>Editar jogo</h1>
        <hr>
        <form action="{{route('jogos.update', ['id' => $jogos->id ]) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <div class="form-group">
                        <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" value="{{ $jogos->nome }}" placeholder="Digite um nome...">
                    </div>
                    
                </div>
                <br>
                <div class="form-group">
                    <div class="form-group">
                        <label for="categoria">Categoria: </label>
                    <input type="text" class="form-control" name="categoria" value="{{ $jogos->categoria }}" placeholder="Digite uma categoria para o jogo...">
                    </div>
                    
                </div>
                <br>
                <div class="form-group">
                    <div class="form-group">
                        <label for="ano">Ano: </label>
                    <input type="number" class="form-control" name="ano" value="{{ $jogos->ano }}" placeholder="Digite um ano...">
                    </div>
                    
                </div>
                <br>
                <div class="form-group">
                    <div class="form-group">
                        <label for="valor">Valor: </label>
                    <input type="number" class="form-control" name="valor" value="{{ $jogos->valor }}"  placeholder="Digite um valor...">
                    </div>
                    
                </div>
                <br>
                <button type="submit" value="enviar" name="submit"  class="btn btn-success">Atualizar</button>
            
            
        </form>
    </div>
@endsection