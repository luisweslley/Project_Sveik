@if(isset($email))
<div class="modal" id="modalMensagem" tabindex="1" role="dialog" aria-hidden="false">
    <div class="modal-dialog m-auto" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
          <p>Para concluir seu cadastro enviamos para seu email <strong>{{ $email }}</strong>, um link de confirmação</p>
        </div>
        <div class="modal-footer">
          <a class="text-white btn btn-secondary" href="{{url('/')}}">ok</a>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
        $('#modalMensagem').modal('show');
    });
  </script>
@endif
