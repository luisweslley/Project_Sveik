<div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Perfil</th>
          <th>Bloquear</th>
        </tr>
      </thead>
      @if(count($users) > 0)
      <tbody>
        @foreach($users as $x)
        <tr>
            <td>{{$x->id}}</td>
            <td>{{$x->nome}}</td>
            <td>{{$x->email}}</td>
            <td>
            <a href="{{route('admin.usuarios.detalhesUser', ['id' => $x->id])}}" class="btn btn-primary">+</a>
            </td>
            <td>
                <form method="POST" action="{{ route('admin.usuarios.BloquearEntrada',['id' => $x->id]) }}">
                    {{ csrf_field() }}
                    <button class="btn btn-danger" type="submit">X</button>
                </form>
            </td>
        </tr>
        @endforeach
      </tbody>
      @else
      Não a usuarios
      @endif
    </table>
  </div>
