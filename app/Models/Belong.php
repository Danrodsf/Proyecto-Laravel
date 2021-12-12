<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belong extends Model {

    use HasFactory;

    protected $fillable = ['userId', 'partyId'];

    public function user() {

        return $this->belongsTo('App\Models\User','userId','id');
        
    }

    public function party() {

        return $this->belongsTo('App\Models\Party','partyId','id');
        
    }

    
}
