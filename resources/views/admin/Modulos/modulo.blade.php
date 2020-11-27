@inject('modulo', 'app\Http\Controllers\AdminControllers\ModuloController')
@extends('adminlte::page')
@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('admin.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('admin.modulo.index')}}">Modulos</a></p>
@endsection
@section('content')
<div class="row">
<button type="button" class="btn btn-success btn-info" data-toggle="modal" data-target="#modalAdd">Criar</button>
@component('components.modal.modalForm')
    @slot('actionForm', route('admin.modulo.CreateModulo'))
    @slot('modalTitle', 'Criar Modulo')
    @slot('id','modalAdd')
    @slot('content')
        @include('components.modulo.moduloCriar')
    @endslot
@endcomponent
</div>

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row d-flex align-items-stretch">
        @if(count($ExibirModulo) > 0)
            @foreach($ExibirModulo as $x)
                @component('components.modulo.BoxModulos')
                    @slot('nome_modulo', $x->nome_modulo)
                    @slot('infoRest',$modulo->infoRest($x->id_modulo))
                    @slot('nivel', $x->nivel)
                    @slot('ds_modulo', $x->ds_modulo)
                    @slot('id_modulo', $x->id_modulo)
                @endcomponent
            @endforeach
        @else
            Não existe nenhum Modulo
        @endif
        </div>
      </div>
    </div>
@endsection
