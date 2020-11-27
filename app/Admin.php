<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_admin';
    protected $guard = 'admin';

    protected $fillable = [
       'id', 'nm_admin', 'email','email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
