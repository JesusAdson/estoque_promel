@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Listagem dos Produtos') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col col-md-12">
                                <form method="POST" action="{{route('produto.show', ['produto' => 0])}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="pesquisa_categoria">Pesquisar por categoria</label>
                                            <select name="pesquisa_categoria" id="pesquisa_categoria" class="form-control">
                                                <option value="" selected disabled>Selecione uma categoria</option>
                                                @foreach ($tipos as $tipo )
                                                    <option value="{{$tipo->id}} {{old('pesquisa_categoria') === $tipo->id ? 'selected' : ''}}">{{$tipo->descricao}}</option>
                                                @endforeach
                                            </select>
                                            
                                            @if(Session::has('erro'))
                                                 <small class="text-danger">{{Session::get('erro')}}</small> 
                                            @endif
                                            <small class="text-danger">{{$errors->has('pesquisa_categoria') ? $errors->first('pesquisa_categoria') : ''}}</small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="pesquisa_nome">Pesquisar por nome</label>
                                            <input type="text" class="form-control" name="pesquisa_nome" id="pesquisa_nome" placeholder="Não funciona ainda(implementar depois)">
                                        </div>
                                    </div>
                                    <button class="btn btn-success">Pesquisar</button>
                                </form>
                            </div>
                        </div>
                        <br>
                        <table id="table" class="table table-responsive-lg table-hover">
                            <thead class="thead-gray">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Lote</th>
                                    <th scope="col">Fab.</th>
                                    <th scope="col">Val.</th>
                                    <th scope="col">Estoque</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Caps/Comp</th>
                                    <th scope="col">Peso(g)</th>
                                    <th scope="col">Quantidade(ml)</th>
                                    <th scope="col">Estoque</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <td>{{$produto->nome}}</td>
                                    <td>{{$produto->lote}}</td>
                                    <td>{{$produto->dataFab->format('d/m/Y')}}</td>
                                    <td>{{$produto->dataVal->format('d/m/Y')}}</td>
                                    <td>Estoque</td>
                                    <td>{{$produto->tipo->descricao}}</td>
                                    <td class="text-center">{{$produto->capsula_id != null ? $produto->capsulas->quantidade : '-'}}</td>
                                    <td class="text-center">{{$produto->peso_id != null ? $produto->pesos->peso : '-'}}</td>
                                    <td class="text-center">{{$produto->quantidade_id != null ? $produto->quantidades->quantidade : '-'}}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"><a href="{{route('entrada.cadastrar', ['produto' => $produto->id])}}">Entrada</a></td>
                                    <td class="text-center"><a href="#">Saída</a></td>
                                    <td class="text-center"><a href="#">Excluir</a></td>
                                    <td class="text-center"><a href="#">Editar</a></td>
                                </tr>
                            @endforeach

                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function($) {
        })
    </script>
@endsection
