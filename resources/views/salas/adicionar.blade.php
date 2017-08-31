@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Salas
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('mensagem_sucesso'))
                        <div class="alert alert-success">{{ session('mensagem_sucesso') }}</div>
                    @endif
                    
                    @if(Request::is('*/editar'))
                      {!! Form::model($sala, ['method' => 'PATCH' ,'url' => 'salas/'.$sala->id]) !!}
                    @else
                      {!! Form::open(['url' => 'salas/adicionar/salvar']) !!}
                    @endif

                    {!! Form::label('nome','Nome') !!}
                    {!! Form::input('text','nome', null,['class'=>'form-control','autofocus','placeholde']) !!}

                    {!! Form::label('numero','Número da Sala') !!}
                    {!! Form::input('text','numero', null,['class'=>'form-control','autofocus','placeholde']) !!}
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
