@extends('adminlte::page')
@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('admin.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('admin.duvidas.index')}}">Duvidas</a></p>
@endsection
@section('content')
<div class="row">
    @component('components.box.boxContent')
    @slot('color', 'info-box-icon bg-info')
    @slot('icon', 'far fa-copy')
    @slot('Message', 'Total Duvidas')
    @slot('number', count($listDuvidas))
    @endcomponent
    <!-- /.col -->
    @component('components.box.boxContent')
    @slot('color', 'info-box-icon bg-success')
    @slot('icon', 'far fa-copy')
    @slot('Message', 'Duvidas respondidas')
    @slot('number', count($listRespondidas))
    @endcomponent
    <!-- /.col -->
    @component('components.box.boxContent')
    @slot('color', 'info-box-icon bg-danger')
    @slot('icon', 'far fa-copy')
    @slot('Message', 'Duvidas não respondidas')
    @slot('number',count($listNaoRespondidas))
    @endcomponent
    <!-- /.col -->
  </div>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de duvidas</h3>
          <div class="card-tools">
          <ul class="nav nav-pills">
            <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapseTodas" aria-expanded="false" aria-controls="collapseTodas">
                Todas
            </button>
            {{-- <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapseRespondidas" aria-expanded="false" aria-controls="collapseRespondidas">
                Respondidas
            </button>
            <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapseNaoRespondidas" aria-expanded="false" aria-controls="collapseNaoRespondidas">
                Não Respondidas
            </button> --}}
        </ul>
          </div>
        </div>
        <!-- /.card-header -->
        {{-- <div class="card-body"> --}}
            <div class="tab-content">
                <div class="collapse" id="collapseTodas">
                @if(count($listDuvidas) > 0)
                        @component('components.duvidas.listAdmin')
                        @slot('Duvidas', $listDuvidas)
                        @slot('opt', 1)
                    @endcomponent
                    @else
                        <div class="alert text-center mb-1" role="alert">
                            Não há duvidas no momento !
                        </div>
                @endif
            </div>
            {{-- <div class="collapse" id="collapseRespondidas">
                @if(count($listRespondidas) > 0)
                        @component('components.duvidas.listAdmin')
                        @slot('Duvidas', $listRespondidas)
                        @slot('opt', 2)
                    @endcomponent
                    @else
                        <div class="alert text-center mb-1" role="alert">
                            Não há duvidas no momento !
                        </div>
                @endif
            </div>
            <div class="collapse" id="collapseNaoRespondidas">
                @if(count($listNaoRespondidas) > 0)
                        @component('components.duvidas.listAdmin')
                        @slot('Duvidas', $listNaoRespondidas)
                        @slot('opt', 3)
                    @endcomponent
                    @else
                        <div class="alert text-center mb-1" role="alert">
                            Não há duvidas no momento !
                        </div>
                @endif
            </div> --}}
            </div>
        {{-- </div> --}}
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
