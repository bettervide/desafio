<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::get();
        return view('usuarios/usuarios', ['usuarios' => $usuarios]);
    }

    public function adicionar()
    {
        return view('usuarios/adicionar');
    }

    public function salvar(Request $request)
    {

        $usuario = new User();
        $usuario = $usuario->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'check' => $request['check'] == 'check' ? 1 : 0,
            'password' => bcrypt($request['password']),
        ]);
        
        session(['mensagem_sucesso' => 'Usuário cadastrado com sucesso!']);
        return Redirect::to('usuarios/adicionar');
    }

    public function editar($id)
    {
        $usuario = User::findOrFail($id);
       
        return view('usuarios/adicionar',['usuario'=> $usuario]);
    }

    public function atualizar($id, Request $request)
    {
        $usuario = User::findOrFail($id);
        $usuario->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'check' => $request['check'] == 'check' ? 1 : 0,
            'password' => bcrypt($request['password']),
        ]);
        session(['mensagem_sucesso' => 'Usuário atualizado com sucesso!']);
        return Redirect::to('usuarios/'.$usuario->id."/editar");
    }

    public function deletar($id, Request $request)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        session(['mensagem_delete_sucesso' => 'Usuário deletado com sucesso!']);
        return Redirect::to('usuarios');
    }
}
