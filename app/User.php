<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_user';
    protected $guard = 'user';

    protected $fillable = [
       'id', 'nm_user', 'email','email_verified_at', 'bl_acesso', 'bl_email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
