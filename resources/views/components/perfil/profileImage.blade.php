    <div class="card-body box-profile pb-2">
        @if($foto == null)
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ Storage::url("../Fotos/profile-picture.jpg") }}" style="width:100px;height:100px;" alt="User profile picture">
        </div>
        @else
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ Storage::url("../Fotos_perfil/$id_user/$foto") }}" style="width:100px;height:100px;" alt="User profile picture">
        </div>
        @endif
        <h3 class="profile-username text-center">{{ $nome }}</h3>


        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item pb-3">
                <b class="text-dark">Email</b><a class="float-right">{{$email}}</a>
            </li>
        </ul>
    </div>
