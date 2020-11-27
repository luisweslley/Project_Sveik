@inject('comentario', 'app\Http\Controllers\AdminControllers\FeedController')
@extends('adminlte::page')

@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('admin.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('admin.feed.index')}}">Feed</a></p>
@endsection
@section('content')
<h1 class="m-0 text-dark">Feed</h1>
<a href="{{route('admin.feed.create')}}" class="btn btn-primary">Criar postagem</a>

        <!-- Post -->
        @if(count($ExibirPost) > 0)
        @foreach($ExibirPost as $x)
        <div class="card">
            <div class="card-body">
                {{-- <div class="tab-content"> --}}
                  <div class="tab-pane active" id="activity">
        <div class="post">
        @component('components.feed.feedBox')
        @slot('nome',$comentario->getName($x->tipo,$x->id_user))
        @slot('foto',$comentario->getFoto($x->tipo,$x->id_user))
        @slot('imagem',$comentario->getFotoPost($x->id))
        @slot('id_user', $x->id_user)
        @slot('data', date('d-m-y', strtotime("$x->data")))
        @slot('hora', date('H:i:s', strtotime("$x->data")))
        @slot('texto',$x->descricao)
        @slot('titulo',$x->titulo)
        @slot('id', $x->id)
        @slot('user', 'admin')
        @slot('comentarios_count',count($comentario->getComentarios($x->id)))
        @slot('comentarios', $comentario->getComentarios($x->id))
        @slot('curtidas', $x->curtidas)
    @endcomponent
        </div>
    </div>
{{-- </div> --}}
</div>
</div>

        @endforeach
        @else
        Não a nenhum post no momento!
        @endif
        <!-- /.post -->

{{-- </div> --}}
@endsection
