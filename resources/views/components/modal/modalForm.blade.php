<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h4 class="modal-title col-11 text-start pl-0">{{ $modalTitle }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" method="POST" action="{{ $actionForm }}" class="d-flex col-12 p-0 flex-column">
              {{ csrf_field() }}
              {{ $content }}
              <div class="boxBtnsForm d-flex justify-content-end">
                  <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">fechar</button>
                  <button type="submit" class="btn btn-primary text-white">confirmar</button>
              </div>
          </form>
        </div>
        <div class="modal-footer border-0">
        </div>
      </div>
    </div>
  </div>
