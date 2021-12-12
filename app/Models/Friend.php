<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId1', 'userId2', 'accepted'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','userId1','id');
        return $this->belongsTo('App\Models\User','userId2','id');
    }
}
