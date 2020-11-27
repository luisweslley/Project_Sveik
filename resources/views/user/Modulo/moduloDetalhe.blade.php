@inject('exercicios', 'app\Http\Controllers\UserControllers\ModuloController')
@extends('adminlte::page')

@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('user.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('user.modulo.index')}}">Modulo</a></p>
@endsection

@section('content')
@if(count($userModuloDetalhes) > 0)
@foreach($userModuloDetalhes as $x)
<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title">{{$x->nome_aula}}</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapse{{$x->id}}" aria-expanded="false" aria-expanded="false" aria-controls="collapse{{$x->id}}">
                <i class="fas fa-minus"></i>
            </button>
            </div>
        </div>
    <div class="collapse" id="collapse{{$x->id}}">
        <table class="table table-hover">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Exercicios</th>
                <th>Gabarito</th>
              </tr>
            </thead>
            <tbody>
                @foreach($exercicios->getExercicios($x->id) as $y)
              <tr>
                <td>{{$y->nome_exercicio}}</td>
                <td>
                <form method="GET" action="{{route('user.modulo.detalhes.Download', ['id' => $y->id_exercicio ])}}">
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">Baixar</button>
                    </form>
                </td>
                <td>
                @if($y->anexo_correcao != null)
                <form method="GET" action="{{route('user.modulo.detalhes.DownloadCorrecao', ['id' => $y->id_exercicio ])}}">
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">Baixar</button>
                    </form>
                @else
                Exercicio sem Gabarito
                @endif
                </td>
              </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    <!-- /.post -->

</div>
@endforeach
@else
Modulos está vazio
@endif
@endsection
