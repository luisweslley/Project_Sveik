@extends('layouts.auth')

@section('content')
<p class="login-box-msg">Bem vindo ao Sveik</p>
<div class="content">
    {{-- <div class="boxCenter"> --}}
      {{-- <h1 class="logo">Bem vindo ao Sveik</h1> --}}
      <div class="boxContent">
        <div class="boxTop">
          <h2>Já sou aluno</h2>
        <a href="{{url('user/login')}}" class="btn btn-success btn-block">Entrar</a>
        </div>
        <div class="boxBottom">
          <h2>Quero ser aluno</h2>
          <a href="{{url('user/register')}}" class="btn btn-success btn-block">Cadastrar</a>
        </div>
      </div>
    {{-- </div> --}}
  </div>

@endsection
