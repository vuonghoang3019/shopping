<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
class UserTestAuth extends Authenticable
{
    protected $table = 'users';
    protected $fillable = ['email','password'];
}
