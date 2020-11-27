<table class="table table-striped mb-0">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Data de criação</th>
            <th>Status</th>
            <th>Descrição</th>
            <th>Resposta</th>
        </tr>
    </thead>
    @foreach ( $listarDuvidas as $x )
    <tbody>
        <tr>
            <td class="pt-4">{{ $x->tipo_duvida }}</td>
            <td class="pt-4">{{ $x->dt_criacao }}</td>
           @if($x->bool == true)
            <td class="pt-4">Respondida</td>
           @else
            <td class="pt-4">Não respondida</td>
           @endif
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
                <p>Aguardando liberação</p>
            </td>
            @endif
    </tbody>
    @endforeach
</table>

