@inject('comentario', 'app\Http\Controllers\UserControllers\FeedController')
@extends('adminlte::page')

@section('router')
<p class="routes mb-0 pt-20"><a href="{{route('user.home')}}">Home</a> <i class="fa fa-angle-right"></i> <a href="{{route('user.feed.index')}}">Feed</a></p>
@endsection
@section('content')
<h1 class="m-0 text-dark">Feed</h1>
<a href="{{route('user.feed.create')}}" class="btn btn-primary">Criar postagem</a>
   <!-- Post -->

    @if(count($ExibirPost) > 0)
    @foreach($ExibirPost as $x)
    <div class="card">
    <div class="card-body">
        <div class="tab-content">
        {{-- <div class="tab-pane active" id="activity"> --}}
            <div class="post">
            @component('components.feed.feedBox')
            @slot('nome',$comentario->getName($x->tipo,$x->id_user))
            @slot('foto',$comentario->getFoto($x->tipo,$x->id_user))
            @slot('imagem',$comentario->getFotoPost($x->id))
            {{-- @slot('imagem',$comentario->getFotoPost($x->id)) --}}
            @slot('id_user', $x->id_user)
            @slot('data', date('d-m-y', strtotime("$x->data")))
            @slot('hora', date('H:i:s', strtotime("$x->data")))
            @slot('titulo', $x->titulo)
            @slot('texto',$x->descricao)
            @slot('id', $x->id)
            @slot('user', 'user')
            @slot('comentarios_count',count($comentario->getComentarios($x->id)))
            @slot('comentarios', $comentario->getComentarios($x->id))
            @slot('curtidas', $x->curtidas)
        @endcomponent
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
</div>
@endforeach
@else
Não a nenhum post no momento!
@endif

     <!-- /.post -->


@endsection

