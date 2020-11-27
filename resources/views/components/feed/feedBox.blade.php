@if($user == 'admin')
@inject('comentario', 'app\Http\Controllers\AdminControllers\FeedController')
@else
@inject('comentario', 'app\Http\Controllers\UserControllers\FeedController')
@endif
    <div class="user-block">
        @if($foto == null)
        <img class="img-circle img-bordered-sm" src="{{ Storage::url("../Fotos/profile-picture.jpg") }}" alt="user image">
        @else
        <img class="img-circle img-bordered-sm" src="{{ Storage::url("../Fotos_perfil/$id_user/$foto") }}" alt="user image">
        @endif
      <span class="username">
        <a href="#">{{$nome}}</a>
      </span>
      <span class="description">Publicada em: {{$hora}} - {{$data}}</span>
      @if($user == 'admin')
    <form method="POST" action="{{route( $user.'.feed.Delete', ['id' => $id])}}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button class="btn btn-tool"  type="submit">
        <i class="far fa-trash-up mr-1"></i> Deletar Post</button>
    </form>
    @endif
    </div>
    <!-- /.user-block -->
    <p>
        {{$titulo}}
    </p>
    <p>
        {{$texto}}
    </p>
    @if($imagem != null)
    <p>
        <img class="img-fluid mb-3" src="{{ Storage::url("../feed/fotos/$imagem") }}" style="width:500px;height:500px;" alt="Photo">
    </p>
    @endif
    <p>
        <div class="card-header">
        <button type="button" class="btn btn-tool"  data-toggle="collapse" data-target="#collapse{{$id}}" aria-expanded="false" aria-controls="collapseExample">
                <i class="far fa-comments mr-1"></i> Comentarios ({{$comentarios_count}})
                </button>
            {{-- </a> --}}
            <form method="POST" action="{{route( $user.'.feed.Curtir', ['id' => $id])}}">
                {{ csrf_field() }}
                <button class="btn btn-tool"  type="submit">
                <i class="far fa-thumbs-up mr-1"></i> Curtir({{$curtidas}})</button>
            </form>

            <div class="collapse" id="collapse{{$id}}">
                <div class="user-block">
                @foreach($comentarios as $x)
                @component('components.feed.comentariosBox')
                @slot('nome', $comentario->getName($x->tipo,$x->id_user))
                @slot('foto',$comentario->getFoto($x->tipo,$x->id_user))
                @slot('id', $x->id)
                @slot('id_user', $x->id_user)
                @slot('texto',$x->comentario)
                @slot('data', date('d-m-y', strtotime("$x->data")))
                @slot('hora', date('H:i:s', strtotime("$x->data")))
                @slot('user', $user)
            @endcomponent
            @endforeach
            <div class="mt-5">
                <form method="POST" action="{{ route( $user.'.feed.Comentar', ['id' => $id])}}">
                    {{ csrf_field() }}
                    <div class="col-12 row align-items-center justify-content-center m-0">
                        <div class="col-8">
                            <div class="form-group mb-0">
                                <input class="form-control form-control-sm" name="comentario" type="text" placeholder="Escrever um comentario">
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary">Publicar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </p>


