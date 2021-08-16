<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Support\Arr;

class SaidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saidas = Saida::all();
        return view('saidas.listar', ['saidas' => $saidas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Produto $produto)
    {
        return view('saidas.cadastrar', ['produto' => $produto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $regras = [
            'quantidade_saida' => 'required',
            'data_saida' => 'required' 
        ];
        $feedback = [
            'quantidade_saida.required' => 'O campo quantidade deve ser preenchido.',
            'data_saida.required' => 'A data deve ser preenchida'
        ];

        $request->validate($regras, $feedback);
        //Busca na base de dados o produto
        $estoque = Estoque::where('produto_id', $request->produto_id)->get()->toArray();
        //armazena a quantidade atual do estoque desse produto
        $valor_atual = Arr::get($estoque, '0.quantidade', 0);
        //verifica se a quantidade atual - a quantidade que o usuario inseriu não é < 0;
        if(($valor_atual - $request->quantidade_saida) < 0){
            //se for < 0 então redireciona pra rota de cadastro de saidas com o erro abaixo
            return redirect()->route('saida.cadastrar', ['produto' => $request->produto_id])
            ->with('error', 'Quantidade de saída é maior que a quantidade do estoque');
        }
        //caso contrário atualiza no estoque a quantidade atual - a qtd inserida
        Estoque::where('produto_id', $request->produto_id)->update([
            'quantidade' => $valor_atual - $request->quantidade_saida
        ]);
        // cadastra na table saidas a saida q foi feita
        Saida::create($request->all());
        //retorna pra view saida.listar com uma mensagem de sucesso 
        return redirect()->route('saida.listar')->with('success', 'Saída cadastrada com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
