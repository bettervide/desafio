<?php

namespace App\Http\Controllers;

use App\Sala;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class salasController extends Controller
{
    public function index()
    {
        $salas = Sala::get();
        return view('salas/salas', ['salas' => $salas]);
    }

    public function adicionar()
    {
        return view('salas/adicionar');
    }

    public function salvar(Request $request)
    {
        $sala = new Sala();
        $sala = $sala->create($request->all());
        
        session(['mensagem_sucesso' => 'Sala cadastrada com sucesso!']);
        return Redirect::to('salas/adicionar');
    }

    public function editar($id)
    {
        $sala = Sala::findOrFail($id);
       
        return view('salas/adicionar',['sala'=> $sala]);
    }

    public function atualizar($id, Request $request)
    {
        $sala = Sala::findOrFail($id);
        $sala->update($request->all());
        session(['mensagem_sucesso' => 'Sala atualizada com sucesso!']);
        return Redirect::to('salas/'.$sala->id."/editar");
    }

    public function deletar($id, Request $request)
    {
        $sala = Sala::findOrFail($id);
        $sala->delete();
        session(['mensagem_delete_sucesso' => 'Sala deletada com sucesso!']);
        return Redirect::to('salas');
    }
}
