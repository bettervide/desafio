@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reserva de Salas
                </div>

                <div class="panel-body">
                    
                    @if (session('mensagem_sucesso_reserva'))
                        <div class="alert alert-success">{{ session('mensagem_sucesso_reserva') }}</div>
                    @endif
                    
                    @if(Request::is('*/editar'))
                      {!! Form::model($sala, ['method' => 'PATCH' ,'url' => 'reservar/'.$sala->id]) !!}
                    @else
                      {!! Form::open(['url' => 'reservar/adicionar/salvar']) !!}
                    @endif

                    {!! Form::label('dia','Dia e Hora: Ex.: 31/08/2017 15:00') !!}
                    {!! Form::input('text','dia', null,['class'=>'form-control','autofocus','placeholder'=>'Ex.: 31/08/2017 15:00']) !!}

                    {!! Form::label('sala','Sala:') !!}
                    <select class="form-control" name="sala">
                    @foreach($salas as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                    </select>
                    <br/>
                    @if(Request::is('*/editar'))
                      {!! Form::submit('Atualizar',['class'=>'btn btn-primary pull-right']) !!}
                    @else
                      {!! Form::submit('Cadastrar',['class'=>'btn btn-primary pull-right']) !!}
                    @endif
                    

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
