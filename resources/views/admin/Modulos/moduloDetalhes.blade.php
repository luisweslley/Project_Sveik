@inject('exercicios', 'app\Http\Controllers\AdminControllers\ModuloController')
@extends('adminlte::page')
@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('admin.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('admin.modulo.index')}}">Modulos</a></p>
@endsection
@section('content')
<h1 class="m-0 text-dark">Modulos</h1>
<div class="card">
<div class="card-body">

    @component('components.box.boxContent')
    @slot('color', 'info-box-icon bg-success')
    @slot('icon', 'far fa-copy')
    @slot('Message', 'Quantidade de aulas')
    @slot('number',count($userdetalhes))
    @endcomponent

    @component('components.box.boxContent')
    @slot('color', 'info-box-icon bg-success')
    @slot('icon', 'far fa-copy')
    @slot('Message', 'Quantidade de alunos')
    @slot('number',count($listaUser))
    @endcomponent

    {{-- Alunos Matriculados --}}
    @if(count($listaUser) > 0)
    <button type="button" class="btn btn-success btn-success" data-toggle="modal" data-target="#modalListaUser">Ver</button>
    @component('components.modal.modalList')
    @slot('id','modalListaUser')
    @slot('modalTitle', 'Lista de Alunos')
    @slot('content')
        @include('components.modulo.listaDetalhesM', ['users' => $listaUser, 'id' => $id])
    @endslot
@endcomponent
    @endif
    <a href="{{route('admin.modulo.AulaCriar', ['id' => $id])}}" class="btn btn-success">Adicionar Aula</a>
</div>
</div>
    {{-- end Alunos Matriculados --}}

        @if(count($userdetalhes) > 0)
        @foreach($userdetalhes as $x)
        <div class="card">
        <div class="tab-content">
        <div class="tab-pane active" id="activity">
            <!-- lista Aulas -->
                <div class="card-header border-transparent">
                    <h3 class="card-title">{{$x->nome_aula}}</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapse{{$x->id_aula}}" aria-expanded="false" aria-controls="collapse{{$x->id_aula}}">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalEditAula{{ $x->id_aula }}">
                        <i class="fas fa-wrench"></i>
                    </button>
                    @component('components.modal.modalForm')
                    @slot('actionForm', route('admin.modulo.UpdateNomeAula', ['id' => $x->id_aula]))
                    @slot('modalTitle', 'Editar Aula')
                    @slot('id','modalEditAula'.$x->id_aula)
                    @slot('content')
                        @include('components.modulo.moduloEditarAula', ['nome_aula' => $x->nome_aula])
                    @endslot
                    @endcomponent
                    <a href="{{route('admin.modulo.AddExercicio', ['id' => $x->id_aula])}}" type="button" class="btn btn-tool">Adicionar Exercicio</a>
                    <form method="POST" action="{{ route('admin.modulo.DeleteAula',['id' => $x->id_aula]) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-tool" type="submit"><i class="fa fa-trash"></i></button>
                    </form>
                    </div>
                </div>

            <div class="collapse" id="collapse{{$x->id_aula}}">
                <p>
                @foreach($exercicios->getExercicios($x->id_aula) as $y)
                    @component('components.modulo.listExercicio')
                    @slot('nome', $y->nome_exercicio)
                    @slot('id_exercicio', $y->id_exercicio)
                    @slot('correcao', $y->anexo_correcao)
                    @endcomponent
                @endforeach
                </p>
                {{-- <a href="#" class="small-box-footer">Entrar <i class="fas fa-arrow-circle-right"></i></a> --}}

            <!-- end lista Aulas -->
        </div>


        </div>

    </div>
</div>
    @endforeach
    @else
    Não a nenhum post no momento!
    @endif





@endsection
