<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Fakultas extends Model
{
    use HasFactory;
    
    protected $fillable = ['nama', 'kode'];
    public function prodi(){
        return $this->hasMany(Prodi::class);
    }
}
