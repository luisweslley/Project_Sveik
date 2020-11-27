@extends('adminlte::page')

@section('content')
<link rel="stylesheet" href="{{ asset('../css/styleHome/styleHome.css')}}">
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('admin.modulo.index'))
    @slot('image', 'ion ion-file')
    @slot('title','Modulos')
    @endcomponent
   </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('admin.feed.index'))
    @slot('image', 'ion ion-bag')
    @slot('title','Feed')
    @endcomponent
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('admin.duvidas.index'))
    @slot('image', 'ion ion-bag')
    @slot('title','Duvidas')
    @endcomponent
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @component('components.home.smallbox')
    @slot('route', route('admin.usuarios.index'))
    @slot('image', 'ion ion-bag')
    @slot('title','Usuarios')
    @endcomponent
  </div>
  <div class="col-lg-10 col-10">
  @component('components.box.boxContent')
  @slot('color', 'info-box-icon bg-info')
  @slot('icon', 'far fa-copy')
  @slot('Message', 'Total de Usuarios')
  @slot('number', count($listarUser))
  @endcomponent
</div>

<div class="col-lg-11 col-11">
<a href="{{ route('logout') }}" class="nav-link">
    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
    <i class="nav-icon fas ion-md-log-out"></i>
    <p>Sair</p>
</div>
</div>
  {{-- <div class="card">
    @component('components.box.boxheaderCollapse')
    @slot('name', 'Lista de usuarios')
    @endcomponent --}}
    <!-- /.card-header -->
    {{-- <div class="table-responsive"> --}}
    {{-- <div class="card-body p-0" style="display: block;">
        @component('components.home.listaUsuarios')
        @slot('users', $listarUser)
        @endcomponent --}}

      <!-- /.table-responsive -->
    {{-- </div> --}}

    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix" style="display: block;">
      <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
      <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
    </div> --}}
    <!-- /.card-footer -->
@endsection
