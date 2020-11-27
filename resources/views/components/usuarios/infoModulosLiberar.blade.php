@inject('verify', 'app\Http\Controllers\AdminControllers\UsuariosController')
<form enctype="multipart/form-data" role="form" method="POST" action="{{ route('admin.usuarios.detalhesUser.LiberarAcesso',['id' => $id_user])}}" class="d-flex col-12 p-0 flex-column">
    {{ csrf_field() }}

        @foreach($Modulos as $key => $x)
        @if($verify->verificarModulos($x->id, $id_user) == false)
        <div class="form-check">
            <label class="form-check-label inputUsers">
                <input class="form-check-input inputUsers" type="checkbox" name="{{ $key + 1 }}" value="{{ $x->id }}">
                <span class="checkmark childHover"></span>
                {{ $x->nome_modulo }}
            </label>
        </div>
        @endif
        @endforeach
    <div class="boxBtnsForm d-flex justify-content-end">
        <button type="submit" class="btn btn-primary text-white">confirmar</button>
    </div>
</form>
