<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Gamers_Model extends Authenticatable
{

    protected $fillable = ['nick', 'email', 'password', 'steamUsername'];

    protected $hidden = ['password'];

    use HasApiTokens, HasFactory, Notifiable;

}
