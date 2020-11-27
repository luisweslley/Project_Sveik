<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modulo extends Model
{
    protected $table = 'tb_modulo';

    public $timestamps = false;

    protected $fillable = [
    'id_modulo',
    'nm_modulo',
    'ds_modulo',
    'dt_criacao',
    'id_admin',
    'id_nivel',
    ];


    static function ExibirModuloUser(int $id){

        $ExibirModulos = DB::table('tb_modulo')->select(
            'tb_modulo.nm_modulo as nome_modulo',
            'tb_modulo.id_nivel as nivel',
            'tb_modulo.id_modulo as id_modulo',
            'tb_modulo.ds_modulo as ds_modulo',
            // DB::raw('COUNT(tb_aulas.*) as numero_aula'),
            // DB::raw('COUNT(tb_exercicio.*) as numero_exercicios'),
            'tb_acesso.bl_modulo as bool'
            )
            ->join('tb_acesso', 'tb_acesso.id_modulo', '=', 'tb_modulo.id_modulo')
            // ->join('tb_aulas', 'tb_aulas.id_modulo', '=', 'tb_modulo.id_modulo')
            // ->join('tb_exercicio', 'tb_exercicio.id_aula', '=', 'tb_aulas.id_aula')
            ->where('tb_acesso.id_user', $id)
            ->get();

        return $ExibirModulos;
    }

    static function DetalhesModulosUser(int $id, int $id_user){

        $detalhesModulo = DB::table('tb_aulas')->select(
            'tb_aulas.nm_aula as nome_aula',
            'tb_aulas.id_aula as id',
            )
            ->join('tb_acesso', 'tb_acesso.id_modulo', '=', 'tb_aulas.id_modulo')
            ->where('tb_aulas.id_modulo', $id)
            ->where('tb_acesso.id_user', $id_user)
            ->get();
        return $detalhesModulo;
    }

    static function DetalhesExerciciosUser(int $id){

        $detalhesExercicios = DB::table('tb_exercicio')->select(
            'tb_exercicio.nm_exercicio as nome_exercicio',
            'tb_exercicio.id_exercicio as id_exercicio',
            'tb_exercicio.anexo_exercicio as anexo',
            'tb_exercicio.anexo_correcao as anexo_correcao',
            )
            ->where('tb_exercicio.id_aula', $id)
            ->get();
        return $detalhesExercicios;

    }


// Admin Queries
    static function ExibirModulosAdmin(int $id){

        $ExibirModulos = DB::table('tb_modulo')->select(
            'tb_modulo.id_modulo as id_modulo',
            'tb_modulo.nm_modulo as nome_modulo',
            'tb_modulo.ds_modulo as ds_modulo',
            'tb_modulo.id_nivel as nivel',
            )
            // ->join('tb_acesso', 'tb_acesso.id_modulo', '=', 'tb_modulo.id_modulo')
            // ->join('tb_aulas', 'tb_aulas.id_modulo', '=', 'tb_modulo.id_modulo')
            // ->join('tb_exercicio', 'tb_exercicio.id_aula', '=', 'tb_aulas.id_aula')
            ->where('tb_modulo.id_admin', $id)
            ->get();
        return $ExibirModulos;
    }


    static function detalhesModulo(int $id){

        $detalhesModulo = DB::table('tb_modulo')->select(
            'tb_modulo.nm_modulo as nome_modulo',
            'tb_modulo.id_nivel as nivel',
            // 'tb_user.nm_user as nome_user',
            // 'COUNT(tb_aulas.*) as numero_aula',
            // 'COUNT(tb_exercicio.*) as numero_exercicios',
            'tb_aulas.nm_aula as nome_aula',
            'tb_aulas.id_aula as id_aula',
            // 'tb_exercicio.id_exercicio as id_exercicio',
            // 'tb_exercicio.nm_exercicio as nome_exercicio',
            // 'tb_exercicio.anexo_exercicio as anexo_exercicio',
            // 'tb_exercicio.anexo_correcao as anexo_correcao'
            )
            ->join('tb_aulas', 'tb_aulas.id_modulo', '=', 'tb_modulo.id_modulo')
            // ->join('tb_exercicio', 'tb_exercicio.id_aula', '=', 'tb_aulas.id_aula')
            ->where('tb_modulo.id_modulo', $id)
            ->get();

        return  $detalhesModulo;
    }

    static function listaUserModulo(int $id){

        $listaUserModulo = DB::table('tb_modulo')->select(
            'tb_user.nm_user as nome',
            'tb_user.email as email',
            'tb_user.id as id',
            'tb_perfil.foto_perfil as foto',
            )
            ->join('tb_acesso', 'tb_acesso.id_modulo', '=', 'tb_modulo.id_modulo')
            ->join('tb_user', 'tb_user.id', '=', 'tb_acesso.id_user')
            ->join('tb_perfil','tb_perfil.id_user','=','tb_user.id')
            ->where('tb_modulo.id_modulo', $id)
            ->get();

        return $listaUserModulo;
    }

    static function InfoRest($id){

        $ExibirInfo = DB::table('tb_modulo')->select(
            'tb_modulo.id_modulo as id_modulo',
            'tb_modulo.nm_modulo as nome_modulo',
            'tb_modulo.id_nivel as nivel',
            )
            // ->join('tb_acesso', 'tb_acesso.id_modulo', '=', 'tb_modulo.id_modulo')
            ->join('tb_aulas', 'tb_aulas.id_modulo', '=', 'tb_modulo.id_modulo')
            ->join('tb_exercicio', 'tb_exercicio.id_aula', '=', 'tb_aulas.id_aula')
            ->where('tb_modulo.id_modulo', $id)
            ->get();

            return $ExibirInfo;
    }


}
