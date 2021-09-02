@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Atualização de Produtos') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="form" action="{{route('produto.update', ['produto' =>$produto->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nome">Nome do Produto</label>
                                    <input type="text" class="form-control" name="nome" id="nome" value="{{$produto->nome}}">
                                    <small class="text-danger">{{$errors->has('nome') ? $errors->first('nome') : ''}}</small>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dataFab">Data de Fabricação</label>
                                    <input type="date" class="form-control" name="dataFab" id="dataFab" value="{{$produto->dataFab->format('Y-m-d')}}">
                                    <small class="text-danger">{{$errors->has('dataFab') ? $errors->first('dataFab') : ''}}</small>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dataVal">Data de Validade</label>
                                    <input type="date" class="form-control" name="dataVal" id="dataVal" value="{{$produto->dataVal->format('Y-m-d')}}">
                                    <small class="text-danger">{{$errors->has('dataVal') ? $errors->first('dataVal') : ''}}</small>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="lote">Lote</label>
                                    <input type="number" class="form-control" name="lote" id="lote" value="{{$produto->lote}}">
                                    <small class="text-danger">{{$errors->has('lote') ? $errors->first('lote') : ''}}</small>
                                    @if(Session::has('erro'))
                                        <small class="text-danger">{{Session::get('erro')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="tipos">Tipo do produto</label>
                                    <select class="form-control" name="tipo_id" id="tipos">
                                        <option value="" selected disabled>Selecione um tipo</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{$tipo->id}}" {{old('tipo_id') === $tipo->id ? 'selected' : ''}}>{{$tipo->descricao}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->has('tipo_id') ? $errors->first('tipo_id') : ''}}</small>
                                </div>
                                <div class="form-group col-md-4 colapso" id="cap_comp">
                                    <label for="capsulas">Cap/Comp</label>
                                    <select class="form-control" name="capsula_id" id="capsulas">
                                        <option value="" selected disabled>Selecione uma quantidade</option>
                                        @foreach($capsulas as $capsula)
                                            <option value="{{$capsula->id}}" {{old('capsula_id') === $capsula->id ? 'selected' : ''}}>{{$capsula->quantidade}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->has('capsula_id') ? $errors->first('capsula_id'): ''}}</small>
                                </div>
                                <div class="form-group col-md-4 colapso" id="manipulado_pesagem">
                                    <label for="pesagem">Peso</label>
                                    <select class="form-control" name="peso_id" id="pesagem">
                                        <option value="" selected disabled>Selecione uma quantidade</option>
                                        @foreach($pesos as $peso)
                                            <option value="{{$peso->id}}" {{old('peso_id') === $peso->id ? 'selected' : ''}}>{{$peso->peso}}g</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->has('capsula_id') ? $errors->first('capsula_id') : ''}}</small>
                                </div>           
                                <div class="form-group col-md-4 colapso" id="manipulado_mel">
                                    <label for="mel">Quantidade</label>
                                    <select class="form-control" name="quantidade_id" id="quantidade_id">
                                        <option value="" selected disabled>Selecione uma quantidade</option>
                                        @foreach($quantidades as $quantidade)
                                            <option value="{{$quantidade->id}}" {{old('quantidade_id') === $quantidade->id ? 'selected' : ''}}>{{$quantidade->quantidade}}ml</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->has('quantidade_id') ? $errors->first('quantidade_id') : ''}}</small>
                                </div>
                            </div>
                            <button class="btn btn-success">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function($) {
            $('#tipos').change(function() {
                let valor = $(this).val();
                if (valor == 4) {
                    $('#manipulado_pesagem').css('display', 'block')
                }else{
                    $('#manipulado_pesagem').css('display', '')
                }
                if(valor == 3 || valor == 2 || valor == 1){
                    $('#cap_comp').css('display', 'block')
                }else{
                    $('#cap_comp').css('display', '')
                }
                if(valor == 5){
                    $('#manipulado_mel').css('display', 'block')
                }else{
                    $('#manipulado_mel').css('display', '')
                }
            })
        })
    </script>
@endsection
