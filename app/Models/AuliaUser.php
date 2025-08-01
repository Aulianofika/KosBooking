<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AuliaUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'aulia_users';

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password','remember_token'];
}
