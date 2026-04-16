<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $guarded = [];

    public function pendaftaran() 
    { 
        return $this->hasMany(Pendaftaran::class, 'poli_id');
    }
}
