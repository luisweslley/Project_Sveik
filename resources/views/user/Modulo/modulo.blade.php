@extends('adminlte::page')

@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('user.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('user.modulo.index')}}">Modulo</a></p>
@endsection

@section('content')
<h1 class="m-0 text-dark">Modulos</h1>

    @if(count($UserModulo) > 0)
    @foreach($UserModulo as $x)
    <div class="card">
            {{-- <div class="tab-pane active" id="activity"> --}}
                <div class="card-header border-transparent">
                <h3 class="card-title">{{$x->nome_modulo}}</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapse{{$x->id_modulo}}" aria-expanded="false" aria-expanded="false" aria-controls="collapse{{$x->id_modulo}}">
                    <i class="fas fa-minus"></i>
                </button>
                </div>
            </div>
        <div class="collapse" id="collapse{{$x->id_modulo}}">
        @component('components.modulo.bodyCollapse')
        @slot('texto', $x->ds_modulo)
        @slot('route', route('user.modulo.detalhes.ModuloDetalhes',['id' => $x->id_modulo]))
    @endcomponent
        </div>
        <!-- /.post -->
    {{-- </div> --}}
    </div>
{{-- </div> --}}
  @endforeach
  @else
  Não a nenhum post no momento!
  @endif



@endsection
