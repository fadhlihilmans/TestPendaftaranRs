<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $guarded = [];

    public function pasien() 
    { 
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
    public function dokter() 
    { 
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
    public function poli() 
    { 
        return $this->belongsTo(Poli::class, 'poli_id');
    }
}
