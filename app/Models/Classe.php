<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'niveau_id',
        'surveillant_general_id',
        'prof_id',
        'nb_max_student',
    ];
    protected $with = [
        'seances',
        'students.absences',
    ];

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }

    public function prof(){
        return $this->belongsTo(Prof::class);
    }

    public function surveillant_generale(){
        return $this->belongsTo(Surveillant_Generale::class, 'surveillant_general_id');
    }

    public function seances(){
        return $this->hasMany(Seance::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function inscription(){
        return $this->belongsTo(Inscription::class);
    }
}
