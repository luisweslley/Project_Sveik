<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'tb_aulas';

    public $timestamps = false;

    protected $fillable = [
        'id_aula',
        'nm_aula',
        'dt_criacao',
        'id_modulo',
    ];
}
