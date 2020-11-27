<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'tb_estado';

    protected $fillable = [
    'id_estado',
    'nm_estado',
    'sigla'
    ];
}
