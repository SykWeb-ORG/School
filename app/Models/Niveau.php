<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;
    protected $table = 'niveau';
    protected $fallable = ['nom','niveau_id','filiere_id'];
    public $timestamps = false;

    public function filiere(){

        return $this->belongsTo(Filiere::class);
    }
}
