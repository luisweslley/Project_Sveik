<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    protected $table = 'tb_acesso';

    protected $fillable = [
    'id_user',
    'id_modulo',
    'bl_modulo',
    ];
}
