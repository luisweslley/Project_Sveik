{{-- @extends('layouts.auth') --}}

{{-- @section('content')

<div class="d-flex divContent align-items-center justify-content-center flex-column">
    <form class="form-horizontal formConfirmacao col-5 pl-5 pr-5 pt-4 pb-4" role="form" method="POST" action="{{ route('user.confirmar',['token' => $token])}}">

            <h1>SVEIK!</h1>
        </a>
        {{ csrf_field() }}
            <h4>E-mail confirmado com sucesso!</h4>
            <button type="submit" class="btn btn-primary">
                finalizar
            </button>
    </form>
</div>
@endsection --}}
@extends('layouts.auth')

@section('content')
<p class="login-box-msg">Para confirmar seu email, basta clicar no botão finalizar</p>
<div class="content">
    {{-- <div class="boxCenter"> --}}
      {{-- <h1 class="logo">Bem vindo ao Sveik</h1> --}}
      <div class="boxContent">
        <div class="boxTop">
        <form role="form" method="POST" action="{{ route('user.confirmar',['token' => $token])}}">
            {{ csrf_field() }}
            <h2>Finalizar cadastro</h2>
          <button type="submit" class="btn btn-primary">
            finalizar
        </button>
    </form>
        </div>
      </div>
    {{-- </div> --}}
  </div>

@endsection
