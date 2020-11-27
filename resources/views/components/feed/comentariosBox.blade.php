
    {{-- <div class="user-block"> --}}
        @if($foto == null)
        <img class="img-circle img-bordered-sm" src="{{ Storage::url("../Fotos/profile-picture.jpg") }}" alt="user image">
        @else
        <img class="img-circle img-bordered-sm" src="{{ Storage::url("../Fotos_perfil/$id_user/$foto") }}" alt="user image">
        @endif
      <span class="username">
        <a>{{$nome}}</a>
      </span>
      <span class="description">Publicada em: {{$hora}} - {{$data}}</span>
      @if($user == 'admin')
      <form method="POST" action="{{route( $user.'.feed.DeleteComentario', ['id' => $id])}}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button class="btn btn-tool"  type="submit">
          <i class="far fa-trash-up mr-1"></i> Deletar Comentario</button>
      </form>
      @endif

    <!-- /.user-block -->
    <p>
        {{$texto}}
    </p>
{{-- </div> --}}
