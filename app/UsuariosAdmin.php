<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsuariosAdmin extends Model
{
    static function ListarUser(){
        $ListaUser = DB::table('tb_user')
            ->select(
                'tb_user.nm_user as nome',
                'tb_user.id as id',
                'tb_user.email as email',
            //     'tb_perfil.foto_perfil as foto',
            // )->join('tb_perfil','tb_perfil.id_user','=', 'tb_user.id')
            )->where('tb_user.bl_acesso', 1)
            ->get();

        return $ListaUser;
    }

    static function ListarNaoUser(){
        $ListaUser = DB::table('tb_user')
            ->select(
                'tb_user.nm_user as nome',
                'tb_user.id as id',
                'tb_user.email as email',
            //     'tb_perfil.foto_perfil as foto',
            // )->join('tb_perfil','tb_perfil.id_user','=', 'tb_user.id')
            )->where('tb_user.bl_acesso', 0)
            ->get();

        return $ListaUser;
    }

    static function perfilUser(int $id){
        $perfilUser = DB::table('tb_user')
            ->select(
                'tb_user.nm_user as nome',
                'tb_user.id as id',
                'tb_user.email as email',
                'tb_perfil.foto_perfil as foto',
                // 'tb_perfil.nm_profissao as profissao',
                'tb_perfil.telefone_perfil as telefone',
                'tb_estado.nm_estado as estado',
                'tb_cidade.nm_cidade as cidade',
                'tb_perfil.dt_nasc as dt_nasc',
                )
            ->join('tb_perfil', 'tb_perfil.id_user', '=', 'tb_user.id')
            ->join('tb_cidade', 'tb_cidade.id_user', '=', 'tb_user.id')
            ->join('tb_estado', 'tb_estado.id_estado', '=', 'tb_cidade.id_estado')
            ->where('tb_user.id', $id)->get();

        return $perfilUser;
    }

    static function ModulosUser(int $id){
        $ModulosUser = DB::table('tb_user')
            ->select(
                'tb_modulo.nm_modulo as nome_modulo',
                'tb_modulo.id_modulo as id',
                'tb_acesso.bl_modulo as bool',
                'tb_user.id as id_user'
                ,
            )
            ->join('tb_acesso', 'tb_acesso.id_user', '=', 'tb_user.id')
            ->join('tb_modulo','tb_modulo.id_modulo', '=', 'tb_acesso.id_modulo')
            ->where('tb_acesso.id_user', $id)
            ->get();

            return $ModulosUser;
    }

    static function ModulosNaoUser(){
        $ModulosNaoUser = DB::table('tb_modulo')
            ->select(
                'tb_modulo.nm_modulo as nome_modulo',
                'tb_modulo.id_modulo as id',
            )
            // ->join('tb_acesso', 'tb_acesso.id_user', '=', 'tb_user.id')
            // ->where('tb_acesso.id_user','!=', $id)
            ->get();

        return $ModulosNaoUser;
    }

}
