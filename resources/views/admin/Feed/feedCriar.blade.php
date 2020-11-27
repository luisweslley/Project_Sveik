@extends('adminlte::page')
@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('admin.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('admin.feed.index')}}">Feed</a></p>
@endsection
@section('content')
<form enctype="multipart/form-data" class="form-horizontal" action="{{Route('admin.feed.create.CriarFeed')}}" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInput">Título</label>
        <input type="text" name="Titulo" class="form-control" id="exampleInputEmail1">
      </div>
      <div class="form-group">
        <label for="exampleInput">Texto</label>
        <textarea type="text" name="Descricao" class="form-control" id="exampleInputPassword1"></textarea>
      </div>
      <div class="form-group">
        <label for="anexo" class="col-sm-3 col-form-label text-dark">Adicionar Imagem</label>
        <div class="col-sm-9 d-flex align-items-center">
            <label for="inputAnexo" id="labelAnexo" class="col-sm-2 form-control label-btn mb-0 mr-1 bg-info border-0 font-weight-normal d-flex flex-row align-items-center justify-content-center"><i class="icon ion-md-attach text-lg mr-1"></i> anexar</label>
            <div class="divFileName col-sm-10 text-secondary">Selecionar arquivo...</div>
            <input type="file" name="fileFeed" accept=".jpg, .jpeg, .png" class="form-control d-none" id="inputAnexo">
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Publicar</button>
    </div>
  </form>
@endsection
