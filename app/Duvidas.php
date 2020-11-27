<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Duvidas extends Model
{
    protected $table = 'tb_duvida';

    public $timestamps = false;

    protected $fillable = [
    'id_duvida',
    'id_user',
    'id_admin',
    'tipo_duvida',
    'ds_duvida',
    'ds_resposta',
    'dt_criacao',
    'bl_duvida'
    ];

    static function DuvidaUser($id){

        $UserDuvida = DB::table('tb_duvida')
        ->select(
            'tb_duvida.id_duvida as id_duvida',
            'tb_duvida.ds_duvida as duvida',
            'tb_duvida.dt_criacao as data',
            'tb_tipo_duvida.nm_tipo as tipo_duvida',
            'tb_user.nm_user as nome_user',
            'tb_duvida.bl_duvida as bool',
            'tb_duvida.ds_resposta as ds_resposta'
            )
        ->join('tb_tipo_duvida', 'tb_tipo_duvida.id_tipo', '=', 'tb_duvida.tipo_duvida')
        ->join('tb_user', 'tb_user.id', '=', 'tb_duvida.id_user')
        ->orderBy('tb_duvida.dt_criacao', 'ASC')
        ->where('tb_duvida.id_duvida',$id)
        ->get();

        return $UserDuvida;

    }
    static function ListDuvidas(){

        $listDuvidas = DB::table('tb_duvida')
        ->select(
            'tb_duvida.id_duvida as id_duvida',
            'tb_duvida.ds_duvida as ds_duvida',
            'tb_duvida.dt_criacao as dt_criacao',
            'tb_tipo_duvida.nm_tipo as tipo_duvida',
            'tb_user.nm_user as nome_user',
            'tb_duvida.bl_duvida as bool',
            'tb_duvida.ds_resposta as ds_resposta'
            )
        ->join('tb_tipo_duvida', 'tb_tipo_duvida.id_tipo', '=', 'tb_duvida.tipo_duvida')
        ->join('tb_user', 'tb_user.id', '=', 'tb_duvida.id_user')
        ->orderBy('dt_criacao', 'ASC')
        ->get();

        return $listDuvidas;
    }

    static function DuvidasRespondidas(){

        $listRespondidas = DB::table('tb_duvida')
        ->select(
            'tb_duvida.id_duvida as id_duvida',
            'tb_duvida.ds_duvida as duvida',
            'tb_duvida.dt_criacao as data',
            'tb_tipo_duvida.nm_tipo as tipo_duvida',
            'tb_user.nm_user as nome_user',
            'tb_duvida.bl_duvida as bool',
            'tb_duvida.ds_resposta as ds_resposta'
            )
        ->join('tb_tipo_duvida', 'tb_tipo_duvida.id_tipo', '=', 'tb_duvida.tipo_duvida')
        ->join('tb_user', 'tb_user.id', '=', 'tb_duvida.id_user')
        ->orderBy('dt_criacao', 'ASC')
        ->where('tb_duvida.bl_duvida', 1)
        ->get();

        return $listRespondidas;
    }

    static function DuvidasNaoRespondidas(){

        $listNaoRespondidas = DB::table('tb_duvida')
        ->select(
            'tb_duvida.id_duvida as id_duvida',
            'tb_duvida.ds_duvida as duvida',
            'tb_duvida.dt_criacao as data',
            'tb_tipo_duvida.nm_tipo as tipo_duvida',
            'tb_user.nm_user as nome_user',
            'tb_duvida.bl_duvida as bool',
            'tb_duvida.ds_resposta as ds_resposta'
            )
        ->join('tb_tipo_duvida', 'tb_tipo_duvida.id_tipo', '=', 'tb_duvida.tipo_duvida')
        ->join('tb_user', 'tb_user.id', '=', 'tb_duvida.id_user')
        ->orderBy('dt_criacao', 'ASC')
        ->where('tb_duvida.bl_duvida', 0)
        ->get();

        return $listNaoRespondidas;
    }

// Queries do User

    static function DuvidasUserFilter($id, $bool){

        $UserDuvidasRespondidas = DB::table('tb_duvida')
        ->select(
            'tb_duvida.ds_duvida as duvida',
            'tb_duvida.dt_criacao as dt_criacao',
            'tb_tipo_duvida.nm_tipo as tipo_duvida',
            'tb_user.nm_user as nome_user',
            'tb_duvida.bl_duvida as bool',
            'tb_duvida.ds_resposta as ds_resposta'
            )
        ->join('tb_tipo_duvida', 'tb_tipo_duvida.id_tipo', '=', 'tb_duvida.tipo_duvida')
        ->join('tb_user', 'tb_user.id', '=', 'tb_duvida.id_user')
        ->orderBy('tb_duvida.dt_criacao', 'ASC')
        ->where('tb_duvida.bl_duvida', $bool)
        ->where('tb_duvida.id_user',$id)
        ->get();

            return $UserDuvidasRespondidas;
    }

    static function ListDuvidasUser($id){

        $listUserDuvidas = DB::table('tb_duvida')
        ->select(
            'tb_duvida.ds_duvida as ds_duvida',
            'tb_duvida.dt_criacao as dt_criacao',
            'tb_tipo_duvida.nm_tipo as tipo_duvida',
            'tb_user.nm_user as nome_user',
            'tb_duvida.bl_duvida as bool',
            'tb_duvida.ds_resposta as ds_resposta',
            'tb_duvida.id_duvida as id_duvida'
            )
        ->join('tb_tipo_duvida', 'tb_tipo_duvida.id_tipo', '=', 'tb_duvida.tipo_duvida')
        ->join('tb_user', 'tb_user.id', '=', 'tb_duvida.id_user')
        ->orderBy('tb_duvida.dt_criacao', 'ASC')
        ->where('tb_duvida.id_user',$id)
        ->get();

        return $listUserDuvidas;
    }

    static function TiposDuvidas(){

        $tipos = DB::table('tb_tipo_duvida')
        ->select('nm_tipo', 'id_tipo')
        ->get();

        return $tipos;
    }

}
