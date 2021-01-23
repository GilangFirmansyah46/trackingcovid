<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelurahan extends Model
{
    use HasFactory;

    protected $table = "kelurahans";

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class);
    }

    public function rw(){
        return $this->hasMany(Rw::class);
    }
}
