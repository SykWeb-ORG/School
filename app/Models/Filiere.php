<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = ['nom'];
    public $timestamps = false;


    public function niveaux(){
        return $this->hasMany(Niveau::class);
    }
}
