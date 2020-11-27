@extends('adminlte::page')
@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('admin.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('admin.usuarios.index')}}">Usuarios</a></p>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de usuarios com acesso</h3>
        </div>
        <!-- /.card-header -->
        <!-- /.card-body -->
        @if(count($userList) > 0)
        @component('components.usuarios.listDetalhes')
        @slot('users', $userList)
        @endcomponent
        @else
        Não a usuarios
        @endif
      </div>
      <!-- /.card -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de usuarios sem acesso</h3>
        </div>
        <!-- /.card-header -->
        <!-- /.card-body -->
        @if(count($NaouserList) > 0)
        @component('components.usuarios.listAguarde')
        @slot('users', $NaouserList)
        @endcomponent
        @else
        Não a usuarios
        @endif
      </div>
      <!-- /.card -->
    </div>
  </div>
  @endsection


