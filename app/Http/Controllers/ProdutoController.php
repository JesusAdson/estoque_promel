<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Estoque;
use App\Models\Peso;
use App\Models\Quantidade;
use App\Models\Tipo;
use App\Models\Capsula;
use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $produtos = Produto::where('deleted', '0')->with(['tipo'])->orderBy('nome', 'asc')->paginate(10);
        $tipos = Tipo::all();
        // retornando a quantidade no estoque de cada produto


        //dd($estoque);
        return view('produtos.listar', ['produtos' => $produtos, 'tipos' => $tipos]);
    }

    public static function estoque($id){
        $estoque = Estoque::select('produto_id', Estoque::raw('SUM(quantidade) as total_estoque'))
        ->where('produto_id', $id)
        ->groupBy('produto_id')
        ->get()
        ->toArray();
        //recuperando o somente a quantidade_estoque do produto
        //Arr::get($array, [posicao da key])
        $estoque_total = Arr::get($estoque, '0.total_estoque', 0);
        return $estoque_total;
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
        $produto = Produto::create($request->all());
        //ao cadastrar um produto, juntamente se cria um estoque desse produto
        Estoque::create([
            'quantidade' => 0,
            'produto_id' => $produto->id
        ]);
        return redirect()->route('produto.index')->with('stored', 'Produto cadastrado.');

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
        $tipos = Tipo::all();
        $capsulas = Capsula::all();
        $pesos = Peso::all();
        $quantidades = Quantidade::all();
        return view('produtos.editar', 
        [
            'tipos' => $tipos, 
            'capsulas' => $capsulas, 
            'pesos' => $pesos, 
            'quantidades' => $quantidades,
            'produto' => $produto
        ]);

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

        $produto->update($request->all());
        return redirect()->route('produto.index')->with('updated', 'Produto atualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, Produto $produto)
    {
        dd($produto);
        //Busca na base de dados o produto
        $estoque = Estoque::where('produto_id', $produto->id)->get()->toArray();
        //armazena a quantidade atual do estoque desse produto
        $valor_atual = Arr::get($estoque, '0.quantidade', 0);
        if($valor_atual > 0){
            return redirect()->route('produto.index')->with('error', 'Não é possível excluir um produto com estoque');
        }

        //atualiza na base de dados a coluna deleted para 1 e assim não aparecerá mais nas pesquisas
        $produto->update([
            'deleted' => 1
        ]);
        //return redirect()->route('produto.index')->with('success', 'Produto excluido com sucesso.');
    }
} 
