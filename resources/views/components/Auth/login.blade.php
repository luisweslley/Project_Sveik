@extends('layouts.auth')

@section('content')
@if($auth == 'user')
<p class="login-box-msg">Entrar no Sveik</p>
@else
<p class="login-box-msg">Entrar como Administrador</p>
@endif
        <form method="POST" action="{{ $url }}">
            {{ csrf_field() }}
          <div class="input-group mb-3">
            {{-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> --}}
            <input type="email" name="email"class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                {{-- <span class="fas fa-envelope"></span> --}}
              </div>
            </div>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
          </div>
          <div class="input-group mb-3">
            {{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"> --}}
            <input type="password" name="password" class="form-control" placeholder="Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                {{-- <span class="fas fa-lock"></span> --}}
              </div>
            </div>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-success btn-block">Entrar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        @if($auth == 'user')
        {{-- <p class="mb-1">
            <a href="#">Esqueci a senha</a>
          </p>
          <p class="mb-0">
            <a href="#" class="text-center">Ainda não tenho cadastro</a>
          </p> --}}
        @endif
@endsection
