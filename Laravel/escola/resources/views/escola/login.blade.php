@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>
    @if($mensagem = Session::get('erro'))
        {{ $mensagem }}
    @endsession

    @if($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }} <br>
        
        @endforeach
    @endif
    <form action="{{ route('login.auth') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
@endsection