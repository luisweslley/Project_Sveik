<div class="card-header p-2 pl-4">
    <h3 class="card-title text-md">Sobre</h3>
  </div>
  <div class="card-body pb-2 pt-3">
    <strong class="text-dark"><i class="fas fa-calendar mr-1"></i> Data de nascimento</strong>
    <p class="text-muted">
        {{ $data_nasc }}
    </p>
    <hr>
    <strong class="text-dark"><i class="fas fa-phone mr-1"></i> Telefone</strong>
    <p class="text-muted">
        {{ $telefone }}
    </p>
    <hr>
    <p class="text-muted" style="margin-bottom:1.3rem;">
        {{ $cidade }}-{{ $estado }}, {{ $pais }}
    </p>
  </div>
