<?php

namespace App\Http\Controllers;

use App\Suspeito;
use App\Crime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SuspeitoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suspeito = Suspeito::all();
        $crimes = Crime::all();
        return view('lista_suspeito', compact('suspeito'));
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastrar_suspeito');
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
            ->witherrors($validacao->errors())
            ->withInput($request->all());
        }
        else
        {
            $sus = new Suspeito();
            $sus->nome = $request->input('nome');
            $sus->vulgo = $request->input('vulgo');
            $sus->cpf = $request->input('cpf');
            $sus->rg = $request->input('rg');
            $sus->sexo = $request->input('sexo');
            $sus->estado = $request->input('estado');
            $sus->cidade = $request->input('cidade');
            $sus->endereco = $request->input('enderecosus');
            $sus->quantidadeCrime = '';
            $sus->localAtuacao = $request->input('localAtuacao');
            $sus->dataNascimento = $request->input('dataNascimento');
            $path=$request->file("foto")->store('imagens', 'public');
            $sus->foto = $path;
            $sus->nomePai = $request->input('nomePai');
            $sus->nomeMae = $request->input('nomeMae');
            $sus->obs = $request->input('descri');
            $sus->save();
            return redirect()->route('crimes.show', $sus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suspeito  $suspeito
     * @return \Illuminate\Http\Response
     */
    public function show(Suspeito $suspeito)
    {
        return view('registroSuspeito', compact('suspeito'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suspeito  $suspeito
     * @return \Illuminate\Http\Response
     */
    public function edit(Suspeito $suspeito)
    {
        return view('suspeitoeditar', compact('suspeito'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suspeito  $suspeito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suspeito $suspeito)
    {
        $suspeito->nome = $request->input('nome');
        $suspeito->vulgo = $request->input('vulgo');
        $suspeito->cpf = $request->input('cpf');
        $suspeito->rg = $request->input('rg');
        $suspeito->sexo = $request->input('sexo');
        $suspeito->estado = $request->input('estado');
        $suspeito->cidade = $request->input('cidade');
        $suspeito->endereco = $request->input('enderecosus');
        $suspeito->quantidadeCrime = '';
        $suspeito->localAtuacao = $request->input('localAtuacao');
        $suspeito->dataNascimento = $request->input('dataNascimento');
        $path=$request->file("foto")->store('imagens', 'public');
        $suspeito->foto = $path;
        $suspeito->nomePai = $request->input('nomePai');
        $suspeito->nomeMae = $request->input('nomeMae');
        $suspeito->obs = $request->input('descri');
        $suspeito->save();
        return redirect()->route('suspeitos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suspeito  $suspeito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suspeito $suspeito)
    {
        $suspeito->delete();
        return redirect()->route('suspeitos.index');
    }

    public function Validator($date)
    {
        $regras=[
            'nome'                  => 'required',
            'vulgo'                 => 'required',
            'foto'                  => 'required',
            'cpf'                   => 'required',
            'rg'                    => 'required',
            'dataNascimento'        => 'required',
            'sexo'                  => 'required',
            'estado'                => 'required',
            'cidadesus'             => 'required',
            'enderecosus'           => 'required',
            'localAtuacao'          => 'required',
            'nomePai'               => 'required',
            'nomeMae'               => 'required',
            'descri'                => 'required',
        ];

        $menssagens=[
            'nome.required'                     => 'Campo Nome é obrigatório',
            'vulgo.required'                    => 'Campo Vulgo é obrigatório',
            'foto.required'                     => 'Campo Foto é obrigatório',
            'cpf.required'                      => 'Campo CPF é obrigatório',
            'rg.required'                       => 'Campo RG é obrigatório',
            'dataNascimento.required'           => 'Campo Data de Nascimento é obrigatório',
            'sexo.required'                     => 'Campo Sexo é obrigatório',
            'estado.required'                   => 'Campo Estado é obrigatório',
            'cidadesus.required'                => 'Campo Cidade é obrigatório',
            'enderecosus.required'              => 'Campo Endereço é obrigatório',
            'localAtuacao.required'             => 'Campo Local de Atuação é obrigatório',
            'nomePai.required'                  => 'Campo Nome do Pai é obrigatório',
            'nomeMae.required'                  => 'Campo Nome da Mãe é obrigatório',
            'descri.required'                   => 'Campo OBS é obrigatório',
        ];

        return Validator::make($date, $regras, $menssagens);
    }
}
