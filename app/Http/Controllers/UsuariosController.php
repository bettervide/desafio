<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::get();
        return view('usuarios/usuarios', ['usuarios' => $usuarios]);
    }

    public function adicionar()
    {
        return view('usuarios/adicionar');
    }

    public function salvar(Request $request)
    {
        $usuario = new Usuario();
        $usuario = $usuario->create($request->all());
        
        session(['mensagem_sucesso' => 'Usuário cadastrado com sucesso!']);
        return Redirect::to('usuarios/adicionar');
    }

    public function editar($id)
    {
        $usuario = Usuario::findOrFail($id);
       
        return view('usuarios/adicionar',['usuario'=> $usuario]);
    }

    public function atualizar($id, Request $request)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        session(['mensagem_sucesso' => 'Usuário atualizado com sucesso!']);
        return Redirect::to('usuarios/'.$usuario->id."/editar");
    }

    public function deletar($id, Request $request)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        session(['mensagem_delete_sucesso' => 'Usuário deletado com sucesso!']);
        return Redirect::to('usuarios');
    }
}
