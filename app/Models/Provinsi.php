<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;

    protected $table = "provinsis";

    public function kota(){
        return $this->hasMany(Kota::class);
    }
}
