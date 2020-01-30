<?php

namespace App\Http\Controllers;

use App\Abono;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abonos = Abono::all();
        return view('abono/lista_abono', compact('abonos'));
    }

    /**
     * Show the form for creating a new resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('abono/abono_servico');
    }
    public function store(Request $request)
    {
            $abonos = new Abono();
            $abonos->num_mat = $request->input("mat");
            $abonos->nome = $request->input("nome");
            $abonos->substituto = $request-> input("substituto");
            $abonos->mat_sub = $request->input("mat_sub");
            $abonos->servico = $request->input("servico");
            $abonos->funcao = $request->input("funcao");
            $abonos->data = $request->input('data');
            $abonos->das = $request->input("horario");
            $abonos->as = $request->input("as");
            $abonos->status = "Aguardando Confirmação";
            $abonos->save();
            return redirect()->route('abono.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Abono  $abono
     * @return \Illuminate\Http\Response
     */
    public function show(Abono $abono)
    {
        if($abono->status == "Aguardando Confirmação" && Auth::User()->matricula == $abono->num_mat){
            return view('abono/documento_abono', compact('abono'));
        }else if($abono->status == "Aguardando Confirmação SPO" && Auth::User()->matricula == $abono->mat_sub){
            return view('abono/documento_abono', compact('abono'));
        }else if($abono->status == "Aguardando Confirmação SPO" && Auth::User()->chefedeSetor == "Sim" && Auth::User()->setor == "SPO"){
            echo("Ok");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Abono  $abono
     * @return \Illuminate\Http\Response
     */
    public function edit(Abono $abono)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Abono  $abono
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abono $abono)
    {
        
            $abono->num_mat = $request->input("mat");
            $abono->nome = $request->input("nome");
            $abono->substituto = $request-> input("substituto");
            $abono->mat_sub = $request->input("mat_sub");
            $abono->servico = $request->input("servico");
            $abono->funcao = $request->input("funcao");
            $abono->das = $request->input("horario");
            $abono->as = $request->input("as");
            $abono->status = "Aguardando Confirmação SPO";
            $abono->save();
            return redirect()->route('abono.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Abono  $abono
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abono $abono)
    {
        //
    }

    public function Validator($date)
    {
        $regras = [
            'mat'           => 'required',
            'nome'              => 'required',
            'mat_sub'           => 'required',
            'substituto'        => 'required',
            'servico'           => 'required',
            'funcao'            => 'required',
            'horario'           => 'required',
            'as'                => 'required',
        ];

        $mensagens = [ 'required'   => 'Campo Obrigatório'];

        return Validator::make( $date, $regras, $mensagens);
    }
}
