@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Listagem dos Produtos') }}</div>
                    @if(Session::has('success'))
                         <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Lote</th>
                                        <th scope="col">Quantidade que saiu</th>
                                        <th scope="col">Data da saída</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saidas as $saida)
                                        <tr>
                                            <td>{{$saida->produto->nome}}</td>
                                            <td>{{$saida->produto->lote}}</td>
                                            <td>{{$saida->quantidade_saida}}</td>
                                            <td>{{$saida->data_saida->format('d/m/Y')}}</td>
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
