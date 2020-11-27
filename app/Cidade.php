<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'tb_cidade';

    public $timestamps = false;

    protected $fillable = [
    'id_user',
    'nm_cidade',
    'id_estado'
    ];
}
