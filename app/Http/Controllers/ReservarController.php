<?php

namespace App\Http\Controllers;

use App\Reservar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use \Auth;

class reservarController extends Controller
{
    public function index()
    {
        $reservas = DB::table('salas')
            ->join('reservars', 'salas.id', '=', 'reservars.sala')
            ->get();
        //$salas = Reservar::get();
        session(['id' => Auth::id()]);
        return view('reservar/reservar', ['reservas' => $reservas]);
    }

    public function adicionar()
    {
        
        $salas = DB::table('salas')            
            ->get();
        return view('reservar/adicionar', ['salas' => $salas]);
    }

    public function salvar(Request $request)
    {
        $reserva = DB::table('reservars')
            ->where('dia',$request->dia)
            ->where('sala',$request->sala)
            ->where('fk_user',Auth::id())            
            ->get();

        if($reserva->count() == 0){
            $reserva2 = DB::table('reservars')
            ->where('dia',$request->dia)
            ->where('fk_user',Auth::id())            
            ->get();    
            if($reserva2->count() == 0){
                $sala = new Reservar();
              $sala = $sala->create([
                  'dia' => $request['dia'],
                  'sala' => $request['sala'],
                  'fk_user' => Auth::id()
              ]);
              session(['mensagem_sucesso' => 'Reserva de Sala Cadastrada com sucesso!']);
            } else {
              session(['mensagem_sucesso' => 'Você já possui uma sala reservada neste horário!']);
            }
        } else {
          session(['mensagem_sucesso' => 'Esta sala já encontra-se reservada!']);
        }
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
        session(['mensagem_sucesso' => 'Reserva atualizada com sucesso!']);
        return Redirect::to('reservar/'.$sala->id."/editar");
    }

    public function deletar($id, Request $request)
    {
        
        $reserva = Reservar::findOrFail($id);
        $reserva->delete();
        session(['mensagem_delete_sucesso' => 'Reserva deletada com sucesso!']);
        return Redirect::to('reservar');
    }
}
