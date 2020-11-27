<table class="table table-striped mb-0">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Aluno</th>
            <th>Data de criação</th>
            @if($opt == 1)
                <th>Status</th>
            @endif
            <th>Descrição</th>
            <th>Resposta</th>
        </tr>
    </thead>
    @foreach ( $Duvidas as $x )
    <tbody>
        <tr>
            <td class="pt-4">{{ $x->tipo_duvida }}</td>
            <td class="pt-4">{{ $x->nome_user }}</td>
            <td class="pt-4">{{ $x->dt_criacao }}</td>
            {{-- @if($opt == 1) --}}
                @if($x->bool == true)
                    <td class="pt-4">Respondida</td>
                @else
                    <td class="pt-4">Não respondida</td>
                @endif
            {{-- @endif --}}
            <td class="pt-4">
                <button type="button" class="btn btn-success btn-info" data-toggle="modal" data-target="#modalAnswer{{ $x->id_duvida }}">Descrição</button>
                @component('components.modal.modalAnswer')
                @slot('idModal', 'modalAnswer'.$x->id_duvida)
                @slot('contentModal')
                  <p class="autocomplete-suggestion">Descrição: {{ $x->ds_duvida }}</p>
                @endslot
              @endcomponent
            </td>
            @if($x->bool == true)
            <td class="pt-4">
            <button type="button" class="btn btn-success btn-info" data-toggle="modal" data-target="#modalAnswerR{{ $x->id_duvida }}">Resposta</button>
                @component('components.modal.modalAnswer')
                @slot('idModal', 'modalAnswerR'.$x->id_duvida)
                @slot('contentModal')
                  <p class="autocomplete-suggestion">Resposta: {{ $x->ds_resposta }}</p>
                @endslot
              @endcomponent
            </td>
            @else
            <td class="pt-4">
            <button type="button" class="btn btn-success btn-info" data-toggle="modal" data-target="#modalAdd{{ $x->id_duvida }}">Criar</button>
                @component('components.modal.modalForm')
                @slot('actionForm', route('admin.duvidas.EnviarResposta',['id' => $x->id_duvida]))
                @slot('modalTitle', 'Responder Duvida')
                @slot('id','modalAdd'.$x->id_duvida)
                @slot('content')
                    @include('components.duvidas.duvidaResponder', ['duvida' => $x->ds_duvida])
                @endslot
            @endcomponent
            </td>
            @endif
            <td>
                <form method="POST" action="{{ route('admin.duvidas.delete.Destroy',['id' => $x->id_duvida]) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
