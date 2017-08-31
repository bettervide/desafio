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
                        <th>Dia</th>
                        <th>Sala</th>
                        <th></th>
                    </thead>
                    <tbody>
                    @foreach($reservas as $reserva)
                       <tr>
                        <td>{{$reserva->dia}}</td>
                        <td>{{$reserva->nome}} - {{$reserva->numero}}</td>
                        <td>
                        @if (session('id') == $reserva->fk_user)
                            {!! Form::open(['method' => 'DELETE', 'url' => '/reservar/'.$reserva->id, 'style'=>'display: inline;']) !!}
                            <button type="submit" class="btn btn-default btn-sm">Cancelar Reserva</button>
                            {!! Form::close() !!}
                        @else
                            <button type="button" class="btn btn-default btn-sm block">Reservado</button>
                        @endif    
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
