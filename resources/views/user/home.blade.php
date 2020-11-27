@extends('adminlte::page',['user' => $user])

@section('content')
<link rel="stylesheet" href="{{ asset('../css/styleHome/styleHome.css')}}">
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('user.modulo.index'))
    @slot('image', 'ion ion-file')
    @slot('title','Modulos')
    @endcomponent
   </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('user.feed.index'))
    @slot('image', 'ion ion-bag')
    @slot('title','Feed')
    @endcomponent
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('user.duvidas.index'))
    @slot('image', 'ion ion-bag')
    @slot('title','Duvidas')
    @endcomponent
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('user.perfil.index'))
    @slot('image', 'ion ion-bag')
    @slot('title','Perfil')
    @endcomponent
  </div>
  <a href="{{ route('logout') }}" class="nav-link">
    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
    <i class="nav-icon fas ion-md-log-out"></i>
    <p>Sair</p>
 {{-- <!-- Modal -->
 <form class="" enctype="multipart/form-data" action="{{ route('empreendedor.home.EditarVideo') }}" method="POST">
    {{ csrf_field() }}
  <div class="modal fade" id="ModalVideo" tabindex="-1" role="dialog" aria-labelledby="TituloModalVideo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalVideo">Vídeo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if($linkVideo == null)
              <div class="form-group text-left col-md-10 mx-auto">
                <label for="link">Link do video da startup</label>
                <input type="text" id="link" name="link" maxlength="150" class="form-control">
              </div>
              @else
              <iframe width="560" height="315" src="{{$x->link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              @endif
            </div>
            <div class="modal-footer">
              @if($linkVideo == null)
              <button type="submit" class="btn bg-info">confirmar</button>
              @endif
              <button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
            </div>
        </div>
    </div>
</div>
</form> --}}
<!-- end Modal -->

</div>

@endsection
