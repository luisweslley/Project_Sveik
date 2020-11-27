<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Perfil extends Model
{
    protected $table = 'tb_perfil';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'cpf_perfil',
        'dt_nasc',
        'foto_perfil',
        'telefone_perfil',
    ];

    static function exibirDados(int $id){

    $userPerfil = DB::table('tb_user')->select(
            'tb_user.nm_user as nome',
            'tb_user.email as email',
            'tb_perfil.foto_perfil as foto',
            'tb_perfil.cpf_perfil as cpf',
            'tb_perfil.telefone_perfil as telefone',
            'tb_estado.sigla as sigla',
            'tb_estado.nm_estado as estado',
            'tb_estado.id_estado as id_estado',
            'tb_cidade.nm_cidade as cidade',
            'tb_perfil.dt_nasc as dt_nasc',
            )
        ->join('tb_perfil', 'tb_perfil.id_user', '=', 'tb_user.id')
        ->join('tb_cidade', 'tb_cidade.id_user', '=', 'tb_user.id')
        ->join('tb_estado', 'tb_estado.id_estado', '=', 'tb_cidade.id_estado')
        ->where('tb_user.id', $id)->first();

    return $userPerfil;
    }

}
