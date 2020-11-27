@extends('adminlte::page')
@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('user.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('user.perfil.index')}}">Perfil</a></p>
@endsection
@section('routes')
<i class="fa fa-angle-right"></i> <a href="{{route('user.perfil.index')}}">Perfil</a>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- //@foreach ($DadosPerfil as $x ) --}}
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
            @component('components.perfil.profileImage')
            @slot('foto', $DadosPerfil->foto)
            @slot('nome', $DadosPerfil->nome)
            @slot('profissao','DBA')
            @slot('email', $DadosPerfil->email)
            @slot('id_user', Auth::user()->id)
            @endcomponent
        </div>
            {{-- end Profile Image --}}
            {{-- About Me --}}
            <div class="card card-primary">
                @component('components.perfil.aboutMe')
                @slot('data_nasc', date('d/m/Y',strtotime($DadosPerfil->dt_nasc)))
                @slot('telefone', $DadosPerfil->telefone)
                @slot('cidade',$DadosPerfil->cidade)
                @slot('estado', $DadosPerfil->estado)
                @slot('pais', 'Brasil')
                @endcomponent
              {{-- end About Me --}}
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#settings" data-toggle="tab">configurações</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        {{-- settings --}}
                        <div class="tab-pane active" id="settings">
                            @component('components.perfil.settings')
                            @slot('route', route('user.perfil.UpdatePerfil'))
                            @slot('foto', $DadosPerfil->foto)
                            @slot('nome', $DadosPerfil->nome)
                            @slot('profissao','DBA')
                            @slot('email', $DadosPerfil->email)
                            @slot('data_nasc', date('d/m/Y',strtotime($DadosPerfil->dt_nasc)))
                            @slot('telefone', $DadosPerfil->telefone)
                            @slot('cidade',$DadosPerfil->cidade)
                            @slot('estados', $estados)
                            @slot('sigla_user', $DadosPerfil->sigla)
                            @slot('estado_id', $DadosPerfil->id_estado)
                            @slot('pais', 'Brasil')
                            @endcomponent
                            {{-- end settings --}}
                        </div>
                        <div class="tab-pane" id="password">
                            <form class="form-horizontal" method="POST" action="#">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('mypassword') ? ' has-error' : '' }}">
                                    <label for="mypassword" class="col-sm-3 col-form-label text-dark">Senha Atual</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="mypassword" minlength="6" maxlength="32" class="form-control" id="nova_senha mypassword">

                                        @if ($errors->has('mypassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mypassword') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-sm-3 col-form-label text-dark">Nova senha</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" minlength="6" maxlength="32" class="form-control" id="nova_senha password">

                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="confirmar_senha" class="col-sm-3 col-form-label text-dark">Confirmar senha</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_confirmation" minlength="6" maxlength="32" class="form-control" id="confirmar_senha">

                                        @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row justify-content-end mb-0 pr-2">
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-danger">confirmar</button>
                                    </div>
                                </div>
                                {{-- <script type="text/javascript" src="{{ asset('js/jsForm/jsFormVerification.js') }}"></script>
                                <script type="text/javascript" src="{{ asset('js/formatarTel.js') }}"></script> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endforeach --}}
@endsection
