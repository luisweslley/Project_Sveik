{{-- @extends('adminlte::page')

@section('content')
<form enctype="multipart/form-data" method="POST" action="{{ route('admin.modulo.CreateAula', ['id' => 2])}}" class="d-flex col-12 p-0 flex-column">
    {{ csrf_field() }}
<div class="card-body">
    <div class="form-group">
        <label for="exampleInput">Nome da Aula</label>
        <input type="text" name="nm_aula" class="form-control" id="exampleInput">
      </div>
      <div class="form-group">
        <label for="exampleInput">Nome do exercicio</label>
        <input type="text" name="nm_exercicio" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="form-group">
        {{-- <label for="anexo" class="col-sm-3 col-form-label text-dark">Foto de perfil</label>
        <div class="col-sm-9 d-flex align-items-center"> --}}
            <label for="inputAnexo" id="labelAnexo" class="col-sm-2 form-control label-btn mb-0 mr-1 bg-info border-0 font-weight-normal d-flex flex-row align-items-center justify-content-center"><i class="icon ion-md-attach text-lg mr-1"></i> anexar</label>
            {{-- <div class="divFileName col-sm-10 text-secondary">Selecionar arquivo...</div> --}}
            <input type="file" name="fileExercicio"  class="form-control d-none" id="inputAnexo">
        {{-- </div> --}}
      </div>
  </div>
                <div class="boxBtnsForm d-flex justify-content-end">
                  <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">fechar</button>
                  <button type="submit" class="btn btn-primary text-white">confirmar</button>
              </div>
</form>

@endsection --}}
