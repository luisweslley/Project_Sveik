@extends('adminlte::page')
@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('admin.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('admin.usuarios.index')}}">Usuarios</a></p>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        @foreach ($userInfo as $x )
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
            @component('components.perfil.profileImage')
            @slot('foto', $x->foto)
            @slot('nome', $x->nome)
            @slot('id_user', $x->id)
            {{-- @slot('profissao', 'dba') --}}
            @slot('email', $x->email)
            @endcomponent
        </div>
            {{-- end Profile Image --}}
            {{-- About Me --}}
            <div class="card card-primary">
                @component('components.perfil.aboutMe')
                @slot('data_nasc', date('d/m/Y',strtotime($x->dt_nasc)))
                @slot('telefone', $x->telefone)
                @slot('cidade',$x->cidade)
                @slot('estado', $x->estado)
                @slot('pais', 'Brasil')
                @endcomponent
              {{-- end About Me --}}
            </div>
        </div>
        @endforeach
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapseModulos" aria-expanded="false" aria-controls="collapseModulos">
                            Modulos
                        </button>
                        <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapseLiberar" aria-expanded="false" aria-controls="collapseLiberar">
                            Liberar
                        </button>
                        <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapseDuvidas" aria-expanded="false" aria-controls="collapseDuvidas">
                            Duvidas
                        </button>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        {{-- settings --}}
                        <div class="collapse" id="collapseModulos">
                            @if(count($userModulo) > 0)
                            @component('components.usuarios.infoModulos')
                            @slot('contador', count($userModulo))
                            @slot('modulos', $userModulo)
                            @endcomponent
                            @else
                            Usuarios não está matriculado em nenhum modulos
                            @endif
                        </div>

                        {{-- end settings --}}
                        {{-- Liberar modulos --}}

                        <div class="collapse" id="collapseLiberar">
                            @component('components.usuarios.infoModulosLiberar')
                            @slot('Modulos', $userModuloNaoUser)
                            @slot('id_user', $id_user)
                            @endcomponent
                        </div>

                        {{-- end Liberar modulos --}}
                        {{-- Duvidas --}}
                        <div class="collapse" id="collapseDuvidas">
                        @if(count($listarDuvidasUser) > 0)
                            @component('components.duvidas.listAdmin')
                            @slot('Duvidas', $listarDuvidasUser)
                            @slot('opt', 1)
                            @endcomponent
                        @else
                        Usuarios não mandou nenhuma duvida
                        @endif
                    </div>
                        {{-- end Duvidas --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
