{{-- <div class="card-body table-responsive p-0"> --}}
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Modulo</th>
        </tr>
      </thead>
      <tbody>
        @foreach($modulos as $x)
        <tr>
            <td>{{$x->nome_modulo}}</td>
            <td>
                <form method="POST" action="{{route('admin.usuarios.detalhesUser.BloquearAcesso',['id' => $x->id, 'user' => $x->id_user])}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-primary" type="submit">Bloquear</button>
                </form>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  {{-- </div> --}}
