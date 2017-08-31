<?php

namespace App\Http\Controllers;

use App\Reservar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class reservarController extends Controller
{
    public function index()
    {
        $salas = Reservar::get();
        return view('reservar/reservar', ['salas' => $salas]);
    }

    public function adicionar()
    {
        return view('reservar/adicionar');
    }

    public function salvar(Request $request)
    {
        $sala = new Reservar();
        $sala = $sala->create($request->all());
        
        session(['mensagem_sucesso' => 'Reserva de Sala Cadastrada com sucesso!']);
        return Redirect::to('reservar/adicionar');
    }

    public function editar($id)
    {
        $sala = Reservar::findOrFail($id);
       
        return view('reservar/adicionar',['sala'=> $sala]);
    }

    public function atualizar($id, Request $request)
    {
        $sala = Reservar::findOrFail($id);
        $sala->update($request->all());
        session(['mensagem_sucesso' => 'Sala atualizada com sucesso!']);
        return Redirect::to('reservar/'.$sala->id."/editar");
    }

    public function deletar($id, Request $request)
    {
        $sala = Reservar::findOrFail($id);
        $sala->delete();
        session(['mensagem_delete_sucesso' => 'Sala deletada com sucesso!']);
        return Redirect::to('reservar');
    }
}
