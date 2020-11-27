@inject('count', 'app\Http\Controllers\AdminControllers\ModuloController')
<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
    <div class="card bg-light col-12">
      <div class="card-body ">
        <div class="row align-items-center">
          <div class="col-7">
            <h2 class="lead"><b>{{$nome_modulo}}</b></h2>
            <p class="text-muted text-sm"><b>Nivel: </b>{{$nivel}}</p>
            <p class="text-muted text-sm"><b>Descrição: </b>{{$ds_modulo}}</p>
            @if(count($infoRest) > 0)
            <ul class="ml-4 mb-0 fa-ul text-muted">
              <p class="text-muted text-sm"><b>Número de aulas: </b>{{$count->CountAula($id_modulo)}}</p>
              <p class="text-muted text-sm"><b>Número de exercicios: </b>{{$count->CountExercicio($id_modulo)}}</p>
            </ul>
            @endif
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
            <a href="{{route('admin.modulo.AulaCriar', ['id' => $id_modulo])}}" class="btn btn-primary">Adicionar Aula</a>
        @if(count($infoRest) > 0)
            <a href="{{Route('admin.modulo.moduloDetalhes',['id' => $id_modulo])}}" class="btn btn-sm btn-primary">Detalhes</a>
        <form method="POST" action="{{ route('admin.modulo.DeleteModulo',['id' => $id_modulo]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
        </form>
        @endif
        </div>
      </div>
      {{-- Modal --}}
      {{-- @component('components.modal.modalForm')
        @slot('actionForm', route('admin.modulo.CreateAula', ['id' => $id_modulo]))
        @slot('modalTitle', 'Criar Aula')
        @slot('id','modalAdd'.$id_modulo)
        @slot('content')
            @include('components.modulo.modulosCriarAula')
        @endslot
      @endcomponent --}}
  {{-- end Modal --}}
    </div>
  </div>
