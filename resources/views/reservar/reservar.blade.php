@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reservar Salas
                    <a href="{{url('reservar/adicionar')}}" class="pull-right">Reservar Sala</a>
                </div>

                <div class="panel-body">
                    @if (session('mensagem_delete_sucesso'))
                        <div class="alert alert-success">{{ session('mensagem_delete_sucesso') }}</div>
                    @endif
                    Salas Reservadas
                   <table class="table">
                    <thead>
                        <th>Nome</th>
                        <th>Número da Sala</th>
                        <th></th>
                    </thead>
                    <tbody>
                    @foreach($salas as $sala)
                       <tr>
                        <td>{{$sala->nome}}</td>
                        <td>{{$sala->numero}}</td>
                        <td>
                            <a href="/salas/{{$sala->id}}/editar" class="btn btn-default btn-sm">Editar</a>
                            {!! Form::open(['method' => 'DELETE', 'url' => '/salas/'.$sala->id, 'style'=>'display: inline;']) !!}
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
