@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Cadastro de Saídas') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="form" action="{{route('saida.cadastrar.post')}}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nome">Produto</label>
                                    <input type="text" class="form-control" name="nome" id="nome" value="{{$produto->nome}}" disabled>
                                    <input type="hidden" name="produto_id" value="{{$produto->id}}">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="lote">Lote</label>
                                    <input type="text"  class="form-control" name="lote" id="lote" value="{{$produto->lote}}" disabled>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="quantidade">Quantidade</label>
                                    <input type="number"  class="form-control" name="quantidade_saida" id="quantidade">
                                    <small class="text-danger">{{$errors->has('quantidade_saida') ? $errors->first('quantidade_saida') : ''}}</small>
                                    @if(Session::has('error'))
                                        <small class="text-danger">{{Session::get('error')}}</small>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="data_saida">Data da Saída</label>
                                    <input type="date" class="form-control" name="data_saida" id="data_saida">
                                    <small class="text-danger">{{$errors->has('data_saida') ? $errors->first('data_saida') : ''}}</small>
                                </div>
                            </div>
                            
                            <button class="btn btn-success">Cadastrar saída</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
