<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pessoas;

class PessoasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function listapessoas(Request $request)
    {
        //dd($request->auth);
        
        $pessoas = Pessoas::all();
        return response($pessoas, 201)
        ->header('Content-Type', 'application/json');
    }

    public function listapessoa($id)
    {
        $pessoa = Pessoas::find($id);
        return response($pessoa, 201)
        ->header('Content-Type', 'application/json');
    }

    public function addpessoa(Request $data)
    {
        $pessoa = Pessoas::create([
            'nome' => $data->nome,
            'cpf' => $data->cpf,
            'sexo' => $data->sexo,
            'nascimento' => $data->nascimento
            ]);
        return response($pessoa, 201)
        ->header('Content-Type', 'application/json');  
    }

    public function uptpessoa($id, Request $data)
    {
        $pessoa = Pessoas::find($id);
        $pessoa->nome = $data->nome;
        $pessoa->cpf = $data->cpf;
        $pessoa->sexo = $data->sexo;
        $pessoa->nascimento = $data->nascimento;
        $pessoa->save();

        return response($pessoa, 201)
        ->header('Content-Type', 'application/json');          
    }

    public function delpessoa($id)
    {
        $pessoa = Pessoas::find($id);
        $pessoa->delete();

        return response($pessoa, 201)
        ->header('Content-Type', 'application/json');  
    }
}
