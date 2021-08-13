<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Peso;
use App\Models\Quantidade;
use App\Models\Tipo;
use App\Models\Capsula;
use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ProdutoController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::with(['tipo'])->orderBy('nome', 'asc')->paginate(10);
        //dd($produtos);
        $tipos = Tipo::all();
        return view('produtos.listar', ['produtos' => $produtos, 'tipos' => $tipos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::all();
        $capsulas = Capsula::all();
        $pesos = Peso::all();
        $quantidades = Quantidade::all();
        return view('produtos.cadastro', ['tipos' => $tipos, 'capsulas' => $capsulas, 'pesos' => $pesos, 'quantidades' => $quantidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->nome);
        $produtos = new Produto();
        $hasProduto = '';
        //dd($produto);
        switch($request->tipo_id){
            case 1:
               $hasProduto = $produtos->where('nome', $request->nome)
               ->where('capsula_id', $request->capsula_id)
               ->where('lote', $request->lote)
               ->get()
               ->toArray();
                break;
            case 2:
                $hasProduto = $produtos->where('nome', $request->nome)
                ->where('capsula_id', $request->capsula_id)
                ->where('lote', $request->lote)
                ->get()
                ->toArray();
                break;
            case 3:
                $hasProduto = $produtos->where('nome', $request->nome)
                ->where('capsula_id', $request->capsula_id)
                ->where('lote', $request->lote)
                ->get()
                ->toArray();
                break; 
            case 4:
                $hasProduto = $produtos->where('nome', $request->nome)
                ->where('peso_id', $request->peso_id)
                ->where('lote', $request->lote)
                ->get()
                ->toArray();
                break;
            case 5:
                $hasProduto = $produtos->where('nome', $request->nome)
                ->where('quantidade_id', $request->quantidade_id)
                ->where('lote', $request->lote)
                ->get()
                ->toArray();
                break;
        }
        if(!empty($hasProduto)){
            return redirect()->route('produto.create')->with('erro' , 'Já existe um produto cadastrado com esse lote.');
        }
        $regras = 
        [
            'nome' => 'required|min:3',
            'dataFab' => 'required',
            'dataVal' => 'required',
            'lote' => 'required',
            'tipo_id' => 'required'
        ];

        $feedback = 
        [
            'required' => 'O campo :attribute deve ser preenchido.',
            'dataFab.required' => 'A data de fabricação deve ser preenchida.',
            'dataVal.required' => 'A data de validade deve ser preenchida.',
            'tipo_id.required' => 'O campo deve ser preenchido'
        ];

        $request->validate($regras, $feedback);
        Produto::create($request->all());
        return redirect()->route('produto.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $int
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $int)
    {
      
        //dd($request->all());
        $tipos = Tipo::all();
        $hasProduto = '';
        $produtos = new Produto();
        $hasTipo = $produtos->where('tipo_id', $request->pesquisa_categoria)
        ->get();
        $hasNome = $produtos->where('nome', 'LIKE', "%{$request->pesquisa_nome}%");
        //dd($hasTipo);
        //dd($hasNome);

        if($request->pesquisa_categoria == null && $request->pesquisa_nome == null){
            return redirect()->route('produto.index')->with('erro', 'Ao menos um dos campos de pesquisa devem estar preencidos');
        }


        return view('produtos.listar', ['produtos' => $hasTipo, 'tipos' => $tipos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
