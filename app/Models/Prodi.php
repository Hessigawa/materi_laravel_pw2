<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode', 'fakultas_id'];

    public function fakultas(){
        return $this->belongsTo(fakultas::class, 'fakultas_id', "id");
    }

    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class);
    }

}