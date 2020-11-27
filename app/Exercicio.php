<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    protected $table = 'tb_exercicio';

    public $timestamps = false;

    protected $fillable = [
        'id_exercicio',
        'nm_exercicio',
        'anexo_exercicio',
        'anexo_correcao',
        'dt_criacao',
        'id_aula',
        ];

}
