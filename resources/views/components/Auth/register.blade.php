<p class="login-box-msg">Cadastro</p>
<form method="post" action="{{$url}}">
    {{ csrf_field() }}
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6 pl-0 d-flex flex-column"> --}}
    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nome Completo">
    <div class="input-group-append">
      <div class="input-group-text">
        {{-- <span class="fas fa-user"></span> --}}
      </div>
    </div>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    {{-- </div> --}}
  </div>
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6 pl-0 d-flex flex-column"> --}}
    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
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
    {{-- </div> --}}
  </div>
  @if($auth == 'user')
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }} col-md-6 pl-0 d-flex flex-column"> --}}
    <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}" placeholder="CPF" onkeypress="formatar('###.###.###-##',this);">
    <div class="input-group-append">
      <div class="input-group-text">
        {{-- <span class="fas fa-envelope"></span> --}}
      </div>
    </div>
        @if ($errors->has('cpf'))
            <span class="help-block">
                <strong>{{ $errors->first('cpf') }}</strong>
            </span>
        @endif
    {{-- </div> --}}
  </div>
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }} col-md-6 pl-0 d-flex flex-column"> --}}
    <select name="estado" class="form-control">
        @foreach ($estados as $x)
        <option value="{{$x->id_estado}}">{{$x->sigla}}</option>
        @endforeach
    </select>
    <div class="input-group-append">
      <div class="input-group-text">
        {{-- <span class="fas fa-envelope"></span> --}}
      </div>
    </div>
        @if ($errors->has('estado'))
            <span class="help-block">
                <strong>{{ $errors->first('estado') }}</strong>
            </span>
        @endif
    {{-- </div> --}}
  </div>
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }} col-md-6 pl-0 d-flex flex-column"> --}}
    <input type="text" name="cidade" class="form-control" value="{{ old('cidade') }}" placeholder="Cidade">
    <div class="input-group-append">
      <div class="input-group-text">
        {{-- <span class="fas fa-envelope"></span> --}}
      </div>
    </div>
        @if ($errors->has('cidade'))
            <span class="help-block">
                <strong>{{ $errors->first('cidade') }}</strong>
            </span>
        @endif
    {{-- </div> --}}
  </div>
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('data') ? ' has-error' : '' }} col-md-6 pl-0 d-flex flex-column"> --}}
    <input type="date" name="data" class="form-control" placeholder="Data de nascimento">
    <div class="input-group-append">
      <div class="input-group-text">
        {{-- <span class="fas fa-envelope"></span> --}}
      </div>
    </div>
        @if ($errors->has('data'))
            <span class="help-block">
                <strong>{{ $errors->first('data') }}</strong>
            </span>
        @endif
    {{-- </div> --}}
  </div>
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }} col-md-6 pl-0 d-flex flex-column"> --}}
    <input type="telefone" name="telefone" class="form-control" value="{{ old('telefone') }}" placeholder="Telefone">
    <div class="input-group-append">
      <div class="input-group-text">
        {{-- <span class="fas fa-envelope"></span> --}}
      </div>
    </div>
        @if ($errors->has('telefone'))
            <span class="help-block">
                <strong>{{ $errors->first('telefone') }}</strong>
            </span>
        @endif
    {{-- </div> --}}
  </div>
@endif
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-12 d-flex flex-column p-0 mb-1"> --}}
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
    {{-- </div> --}}
  </div>
  <div class="input-group mb-3">
    {{-- <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} col-md-12 d-flex flex-column p-0 mb-1"> --}}
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Senha">
    <div class="input-group-append">
      <div class="input-group-text">
        {{-- <span class="fas fa-lock"></span> --}}
      </div>
    </div>
    @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
  {{-- </div> --}}
</div>
  <div class="row">
    <div class="col-4">
      <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
    </div>
    <!-- /.col -->
  </div>
</form>

<script src="{{ asset('js/formatar.js') }}"></script>
