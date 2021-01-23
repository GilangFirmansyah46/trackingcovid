<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;

    protected $table = "kecamatans";

    public function kota(){
        return $this->belongsTo(Kota::class);
    }

    public function kelurahan(){
        return $this->hasMany(Kelurahan::class);
    }
}
