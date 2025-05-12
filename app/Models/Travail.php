<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travail extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'budget',
        'categorie',
        'statut',
        'date_limite'
    ];

    protected $dates = [
        'date_limite',
        'created_at',
        'updated_at'
    ];

    public function ordres()
    {
        return $this->hasMany(Ordre::class);
    }
}
