<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model {

    use HasFactory;

    protected $fillable = ['name', 'owner', 'gameId'];

    public function belongs() {

        return $this->hasMany('App\Models\Belong');

    }

    public function messages() {

        return $this->hasMany('App\Models\Message');

    }

    public function games() {

        return $this->belongsTo('App\Models\Game','gameId','id' );

    }
    
}
