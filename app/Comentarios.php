<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comentarios extends Model
{
    protected $table = 'tb_comentario';

    protected $fillable = [
    'id_comentario',
    'ds_comentario',
    'dt_comentario',
    'tp_user',
    'nm_user',
    'id_post',
    ];

    static function ExibirComentarios($id){

        $comentarios = DB::table('tb_comentario')->select(
            'id_comentario as id',
            'ds_comentario as comentario',
            'dt_comentario as data',
            'tp_user as tipo',
            'id_user as id_user'
        )->where('id_post', $id)
        ->get();

        return $comentarios;
    }
}
