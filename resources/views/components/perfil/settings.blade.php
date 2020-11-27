
    <form enctype="multipart/form-data" class="form-horizontal" action="{{ $route }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="anexo" class="col-sm-3 col-form-label text-dark">Foto de perfil</label>
            <div class="col-sm-9 d-flex align-items-center">
                <label for="inputAnexo" id="labelAnexo" class="col-sm-2 form-control label-btn mb-0 mr-1 bg-info border-0 font-weight-normal d-flex flex-row align-items-center justify-content-center"><i class="icon ion-md-attach text-lg mr-1"></i> anexar</label>
                <div class="divFileName col-sm-10 text-secondary">Selecionar arquivo...</div>
                <input type="file" name="foto_perfil" accept=".jpg, .jpeg, .png" value="teste" class="form-control d-none" id="inputAnexo">
            </div>
        </div>
        <div class="form-group row">
            <label for="nome" class="col-sm-3 col-form-label text-dark">Nome</label>
            <div class="col-sm-9">
                <input type="text" name="nome"  class="form-control" value="{{$nome}}" id="inputName nome" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="data_nasc" class="col-sm-3 col-form-label text-dark">Data de nascimento</label>
            <div class="col-sm-9">
                <input type="date" name="data_nasc" value="{{$data_nasc}}" class="form-control" id="inputDn data_nasc" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="telefone" class="col-sm-3 col-form-label text-dark">Telefone</label>
            <div class="col-sm-9">
                <input type="text" name="telefone" OnKeyPress="formatar('## #####-####', this)" maxlength="13" value="{{$telefone}}" class="form-control" id="inputTel telefone" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="cidade" class="col-sm-3 col-form-label text-dark">Cidade</label>
            <div class="col-sm-9">
                <input type="text" name="cidade" value="{{$cidade}}" class="form-control" id="inputCity cidade" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="estado" class="col-sm-3 col-form-label text-dark">Estado</label>
            <div class="col-sm-9">
                <select name="estado" class="form-control">
                    <option value="{{$estado_id}}">{{$sigla_user}}</option>
                    @foreach ($estados as $x)
                    <option value="{{$x->id_estado}}">{{$x->sigla}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row justify-content-end mb-0 pr-2">
            <div class="mt-3">
                <button type="submit" class="btn btn-danger">confirmar</button>
            </div>
        </div>
    </form>
