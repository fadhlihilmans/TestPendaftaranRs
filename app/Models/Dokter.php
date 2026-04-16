<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $guarded = [];

    public function pendaftaran() 
    { 
        return $this->hasMany(Pendaftaran::class, 'dokter_id');
    }
}
