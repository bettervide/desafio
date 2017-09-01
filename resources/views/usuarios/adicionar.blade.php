@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Usuários
                </div>

                <div class="panel-body">
                    
                    
                    
                    @if(Request::is('*/editar'))
                      @if (session('mensagem_sucesso_atualizado'))
                        <div class="alert alert-success">{{ session('mensagem_sucesso') }}</div>
                      @endif
                      {!! Form::model($usuario, ['method' => 'PATCH' ,'url' => 'usuarios/'.$usuario->id]) !!}
                    @else
                      @if (session('mensagem_sucesso_adicionado'))
                        <div class="alert alert-success">{{ session('mensagem_sucesso') }}</div>
                      @endif
                      {!! Form::open(['url' => 'usuarios/adicionar/salvar']) !!}
                    @endif
                    

                    {!! Form::label('name','Nome') !!}
                    {!! Form::input('text','name', null,['class'=>'form-control','autofocus','placeholde']) !!}

                    {!! Form::label('email','Email') !!}
                    {!! Form::input('text','email', null,['class'=>'form-control','autofocus','placeholde']) !!}

                    {!! Form::label('password','Senha') !!}
                    {!! Form::input('password','password', null,['class'=>'form-control','autofocus','placeholde']) !!}
                    
                    {!! Form::label('check','Adicionar como admin?') !!}
                    <input name="check" id="check" type="checkbox" value="check">
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
