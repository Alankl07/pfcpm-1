<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $validacao = $this->Validator($request->all());
        if($validacao->fails())
        {
            return redirect()->back()
            ->withErrors($validacao->errors())
            ->withInput($request->all());
        }

        DB::table('users')->insert([
            'nome'              => $request->nome,
            'matricula'         => $request->matricula,
            'foto'              => $request->foto,
            'patente'           => $request->patente,
            'dataNascimento'    => $request->dataNascimento,
            'sexo'              => $request->sexo,
            'chefedeSetor'      => $request->rad,
            'setor'             => $request->setor,
            'cidade'            => $request->cidade,
            'estado'            => $request->estado,
            'pelotao'           => $request->pelotao,
            'rg'                => $request->rg,
            'cpf'               => $request->cpf,
            'password'          => bcrypt($request->senha),
        ]);

        return redirect()->route('home');
        
    }

    protected function registrar(Request $request)
    {
        $validacao = $this->Validator($request->all());
        if($validacao->fails())
        {
            return redirect()->back()
            ->withErrors($validacao->errors())
            ->withInput($request->all());
        }

        DB::table('users')->insert([
            'nome'              => $request->nome,
            'matricula'         => $request->matricula,
            'foto'              => $request->foto,
            'chefedeSetor'      => $request->rad,
            'setor'             => $request->setor,
            'patente'           => $request->patente,
            'dataNascimento'    => $request->dataNascimento,
            'sexo'              => $request->sexo,
            'cidade'            => $request->cidade,
            'estado'            => $request->estado,
            'pelotao'           => $request->pelotao,
            'rg'                => $request->rg,
            'cpf'               => $request->cpf,
            'password'          => bcrypt($request->senha),
        ]);
        return redirect()->route('/');
    }

    public function Validator($data)
    {
        $regras=['nome'     => 'required',
        'matricula'         => 'required',
        'foto'              => 'required',
        'patente'           => 'required',
        'dataNascimento'    => 'required',
        'sexo'              => 'required',
        'cidade'            => 'required',
        'estado'            => 'required',
        'pelotao'           => 'required',
        'rg'                => 'required',
        'cpf'               => 'required',
        'senha'             => 'required',
        'senhaConfirma'     => 'required | same:senha',];

        return Validator::make($data, $regras);
    }
}
