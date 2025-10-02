<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public function prodi(){
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
}
