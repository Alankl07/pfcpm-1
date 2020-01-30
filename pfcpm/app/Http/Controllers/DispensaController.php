<?php

namespace App\Http\Controllers;

use App\Dispensa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DispensaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dispensa = Dispensa::all();
        return view ('dispensa/listaDispensa', compact('dispensa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dispensa/dispensa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacao = $this->Validator($request->all());
        if($validacao->fails())
        {
            return redirect()->back()
            ->withErrors($validacao->errors())
            ->withInput($request->all());
        }else{   
            $dispensa = new Dispensa();
            $dispensa->solicitante = Auth::User()->nome;
            $dispensa->matricula = Auth::User()->matricula;
            $dispensa->pelotao = Auth::User()->pelotao;
            $dispensa->escalado = $request->input("escalado");
            $dispensa->dia_do_servico = $request->input("dia");
            $dispensa->hora_inicial = $request->input("das");
            $dispensa->hora_final = $request->input("as");
            $dispensa->virtude = $request->input("virtude");
            $dispensa->Status = "Aguardando Confirmação";
            $dispensa->assinaturaSPO = "";
            $dispensa->dataSPO = "";
            $dispensa->assinaturaCMD = "";
            $dispensa->optCMD = "";
            $dispensa->save();
            return redirect()->route('dispensa.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dispensa  $dispensa
     * @return \Illuminate\Http\Response
     */
    public function show(Dispensa $dispensa)
    {
        if($dispensa->Status != "Refazer")
        {
            return view('dispensa/tela_dispensa', compact('dispensa'));
        }
        if(Auth::User()->matricula == $dispensa->Matricula && $dispensa->Status == "Refazer")
        {
            return view('dispensa/refazerDispensa', compact('dispensa'));
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dispensa  $dispensa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Dispensa $dispensa)
    {
        $validacao = $this->Validator($request->all());
        if($validacao->fails())
        {
            return redirect()->back()
            ->withErrors($validacao->errors())
            ->withInput($request->all());
        }else{
            $dispensa->solicitante = Auth::User()->nome;
            $dispensa->matricula = Auth::User()->matricula;
            $dispensa->pelotao = Auth::User()->pelotao;
            $dispensa->escalado = $request->input("escalado");
            $dispensa->dia_do_servico = $request->input("dia");
            $dispensa->hora_inicial = $request->input("das");
            $dispensa->hora_final = $request->input("as");
            $dispensa->virtude = $request->input("virtude");
            $dispensa->Status = "Aguardando Confirmação";
            $dispensa->assinaturaSPO = "";
            $dispensa->dataSPO = "";
            $dispensa->assinaturaCMD = "";
            $dispensa->optCMD = "";
            $dispensa->save();
            return redirect()->route('dispensa.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dispensa  $dispensa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dispensa $dispensa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dispensa  $dispensa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dispensa $dispensa)
    {
        $dispensa->delete();
        return redirect()->route('home');
    }

    public function Validator($data)
    {
        $regras=[
            'escalado' =>'required',
            'dia' =>'required',
            'das' =>'required',
            'as' =>'required',
            'virtude' =>'required',
        ];
        $mensagens=['required' => 'Campo Obrigatório'];


        return Validator::make($data, $regras, $mensagens);
    }

    public function SPO($id)
    {
        DB::table('dispensas')->where('id', $id)->update([
            'status'        => 'Confirmada pelo SPO',
            'dataSpo'       => now(),
            'assinaturaSPO' => Auth::user()->nome
        ]);
        return redirect()->route('home');
    }

    public function nao($id)
    {
        DB::table('dispensas')->where('id', $id)->update([
            'Status'    => 'Nâo Autorizada'
        ]);
        return redirect()->route('home');
    }

    public function refazer($id)
    {
        DB::table('dispensas')->where('id', $id)->update([
            'Status'    => 'Refazer'
        ]);
        return redirect()->route('home');
    }

    public function CMD($id)
    {
        DB::table('dispensas')->where('id', $id)->update([
            'Status'    => 'Confirmada e Finalizada',
            'optCMD'       => 'Deferimento',
            'assinaturaCMD' => Auth::user()->nome
        ]);

        return redirect()->route('home');
    }

    public function naoCMD($id)
    {
        DB::table('dispensas')->where('id', $id)->update([
            'Status'    => 'Indeferimento',
            'optCMD'       => 'Indeferimento',
            'assinaturaCMD' => Auth::user()->nome
        ]);

        return redirect()->route('home');
    }

    public function imprimir(Dispensa $dispensa)
    {
        return view('dispensa/gerar_pdf_dispensa', compact('dispensa'));
    }
}
