<div class="card-body">
    <div class="form-group">
        <label>Duvida</label>
        <textarea class="form-control" rows="3" name="duvida"></textarea>
      </div>
    <div class="form-group">
        <label>Tipos de duvidas</label>
        <select class="form-control" name="tipo">
        @foreach ($Tipos as $x)
        <option value="{{$x->id_tipo}}">{{$x->nm_tipo}}</option>
        @endforeach
        </select>
      </div>
  </div>
