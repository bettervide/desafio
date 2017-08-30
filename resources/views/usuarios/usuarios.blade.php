@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Usuários
                    <a href="{{url('usuarios/adicionar')}}" class="pull-right">Adicionar Usuário</a>
                </div>

                <div class="panel-body">
                    @if (session('mensagem_delete_sucesso'))
                        <div class="alert alert-success">{{ session('mensagem_delete_sucesso') }}</div>
                    @endif
                   <table class="table">
                    <thead>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Número</th>
                        <th></th>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                       <tr>
                        <td>{{$usuario->nome}}</td>
                        <td>{{$usuario->endereco}}</td>
                        <td>{{$usuario->numero}}</td>
                        <td>
                            <a href="/usuarios/{{$usuario->id}}/editar" class="btn btn-default btn-sm">Editar</a>
                            {!! Form::open(['method' => 'DELETE', 'url' => '/usuarios/'.$usuario->id, 'style'=>'display: inline;']) !!}
                            <button type="submit" class="btn btn-default btn-sm">Excluir</button>
                            {!! Form::close() !!}
                        </td>
                       </tr>
                    @endforeach    
                    </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
