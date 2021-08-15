@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Listagem de Entradas') }}</div>
                       @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                       @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table id="table" class="table table-hover">
                            <thead class="thead-gray">
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Lote</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Data Entrada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

