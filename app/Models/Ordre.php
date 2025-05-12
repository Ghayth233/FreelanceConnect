<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordre extends Model
{
    protected $fillable = [
        'travail_id',
        'freelancer_nom',
        'freelancer_email',
        'proposition',
        'prix_propose',
        'delai_jours',
        'statut'
    ];

    public function travail()
    {
        return $this->belongsTo(Travail::class);
    }
}
