<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'status',
        'tech_visit',
        'model',
        'tax',
        'nb_places',
        'total_price',
        'paid_price',
        'monthly_price',
    ];

    protected $with = [
        'driver',
    ];

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
}
