@extends('adminlte::page')
@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('user.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('user.duvidas.index')}}">Duvidas</a></p>
@endsection
@section('content')
<div class="row">
    @component('components.box.boxContent')
    @slot('color', 'info-box-icon bg-info')
    @slot('icon', 'far fa-copy')
    @slot('Message', 'Total Duvidas')
    @slot('number', count($listarDuvidas))
    @endcomponent
    <!-- /.col -->
    @component('components.box.boxContent')
    @slot('color', 'info-box-icon bg-success')
    @slot('icon', 'far fa-copy')
    @slot('Message', 'Duvidas respondidas')
    @slot('number', count($Respondidas))
    @endcomponent
    <!-- /.col -->
    @component('components.box.boxContent')
    @slot('color', 'info-box-icon bg-danger')
    @slot('icon', 'far fa-copy')
    @slot('Message', 'Duvidas não respondidas')
    @slot('number',count($NaoRespondidas))
    @endcomponent
    <!-- /.col -->
  </div>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de duvidas</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-success btn-info" data-toggle="modal" data-target="#modalAdd">Criar</button>
            @component('components.modal.modalForm')
            @slot('actionForm', route('user.duvidas.enviarDuvida'))
            @slot('modalTitle', 'Criar Duvida')
            @slot('id','modalAdd')
            @slot('content')
                @include('components.duvidas.duvidaCriar', ['Tipos' => $Tipos])
            @endslot
          @endcomponent
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            @if(count($listarDuvidas) > 0)
                @component('components.duvidas.list')
                @slot('listarDuvidas', $listarDuvidas)
            @endcomponent
            @else
                <div class="alert alert-info text-center mb-1" role="alert">
                    Não há duvidas no momento !
                </div>
            @endif
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
