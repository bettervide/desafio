<?php

namespace App\Http\Controllers;

use App\Reservar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use \Auth;
use Carbon\Carbon;
use \DateTime;


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
        $reserva0 = DB::table('reservars')
            ->where('sala',$request->sala)
            ->where('fk_user',Auth::id())            
            ->get();

            var_dump($reserva0[0]->dia);
            var_dump($request->dia);

            $data = DateTime::createFromFormat('d/m/Y H:i:s', $request->dia)->format('Y-m-d H:i:s');
            
        $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $reserva0[0]->dia);
        $date2 = Carbon::createFromFormat('Y-m-d H:i:s', $data);

        $value = $date2->diffInSeconds($date1); // saída: 2 horas    
        if($value > 3540){

        $reserva = DB::table('reservars')
            ->where('dia',$data)
            ->where('sala',$request->sala)
            ->where('fk_user',Auth::id())            
            ->get();

         

        if($reserva->count() == 0){
            $reserva2 = DB::table('reservars')
            ->where('dia',$data)
            ->where('fk_user',Auth::id())            
            ->get();    
            if($reserva2->count() == 0){
                $sala = new Reservar();
              $sala = $sala->create([
                  'dia' => $data,
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
        } else {
            session(['mensagem_sucesso' => 'Esta sala já encontra-se reservada neste horário!']);
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
