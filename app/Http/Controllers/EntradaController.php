<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradas = Entrada::all();
        return view('entradas.listar', ['entradas' => $entradas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Produto $produto)
    {

        return view('entradas.cadastrar', ['produto' => $produto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Entrada::create($request->all());
        
        $estoque = Estoque::where('produto_id', $request->produto_id)->get()->toArray();
        //pegando o valor atual do estoque para somar com a quantidade de entrada
        $valor_atual = Arr::get($estoque, '0.quantidade');

        //atualizando a quantidade de produtos no estoque, com base na quantidade da entrada
        Estoque::where('produto_id', $request->produto_id)
        ->update([
            'quantidade' => $valor_atual + $request->quantidade_entrada
        ]);
        
        return redirect()->route('entrada.listar')->with('success', 'Entrada cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
