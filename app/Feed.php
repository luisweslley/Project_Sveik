<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feed extends Model
{
    protected $table = 'tb_post';

    public $timestamps = false;

    protected $fillable = [
    'id_post',
    'nm_post',
    'ds_post',
    'id_user',
    'dt_post',
    'qt_curtida',
    'tp_user',
    ];


static function ExibirPostAdmin(){

    $mural = DB::table('tb_post')->select(
        "tb_post.id_post as id",
        "tb_post.nm_post as titulo",
        "tb_post.ds_post as descricao",
        "tb_post.dt_post as data",
        "tb_post.qt_curtida as curtidas",
        "tb_post.id_user as id_user",
        "tb_post.tp_user as tipo"
        // "tb_image_post.nm_image as imagem",
        // 'tb_admin.nm_admin as nome'
    )
        // ->join('tb_image_post', 'tb_image_post.id_post', '=', 'tb_post.id_post')
        // ->join('tb_admin', 'tb_admin.id', '=', 'tb_post.id_admin')
        ->orderBy('tb_post.id_post', 'desc')
        ->get();
    return $mural;
}
 static function ExibirFoto($id){

    $foto = DB::table('tb_image_post')->select(
        "tb_image_post.id_post as id_post",
        "tb_image_post.id_image as id_image",
        "tb_image_post.nm_image as nm_image",
    )
    ->where('tb_image_post.id_post', $id)
    ->first();

    return $foto;
 }




}
