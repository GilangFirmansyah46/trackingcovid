<?php

namespace App\Models;
use App\Models\Provinsi;
use App\Models\Kecamatan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kota extends Model
{
 
    public function Provinsi () {
        return $this->belongsTo('App\Models\Provinsi','id_provinsi');
    }
    public function Kecamatan () {
        return $this->hasMany('App\Models\Kecamatan','id_kota');
    }
    use HasFactory;
}