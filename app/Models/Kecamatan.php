<?php

namespace App\Models;
use App\Models\Kota;
use App\Models\Kelurahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
 
    public function Kota () {
        return $this->belongsTo('App\Models\Kota','id_kota');
    }
    public function Kelurahan () {
        return $this->hasMany('App\Models\Kelurahan','id_kecamatan');
    }
    use HasFactory;
}