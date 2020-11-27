<table class="table table-hover">
    <thead>
      <tr>
        <th>Numero</th>
        <th>Nome exercicio</th>
        <th>Exercicios</th>
        <th>Editar</th>
        <th>Correção</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$id_exercicio}}</td>
        <td>{{$nome}}</td>
        <td>
            <form method="GET" action="{{route('admin.modulo.detalhes.Download', ['id' => $id_exercicio ])}}">
                {{ csrf_field() }}
                <button class="btn btn-primary" type="submit">Baixar</button>
            </form>
        </td>
        <td>
            <a href="{{route('admin.modulo.ExercicioEditar', ['id' => $id_exercicio])}}" class="btn btn-success"><i class="fa fa-wrench"></i></a>
        </td>
        <td>
            @if($correcao == null)
            <a href="{{route('admin.modulo.CorrecaoCriar', ['id' => $id_exercicio])}}" class="btn btn-success">Adicionar</a>
            @else
            <form method="GET" action="{{route('admin.modulo.detalhes.Download', ['id' => $id_exercicio ])}}">
                {{ csrf_field() }}
                <button class="btn btn-primary" type="submit">Baixar</button>
            </form>
            <form method="POST" action="{{ route('admin.modulo.DeleteCorrecao',['id' => $id_exercicio]) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-danger" type="submit">Apagar</button>
            </form>
            @endif
        </td>
        <td>
            <form method="POST" action="{{ route('admin.modulo.DeleteExercicio',['id' => $id_exercicio]) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
            </form>
        </td>
      </tr>
    </tbody>
  </table>
