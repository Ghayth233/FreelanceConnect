<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposition',
        'montant',
        'delai_jours',
        'statut',
        'travail_id',
        'freelance_id'
    ];

    public function travail()
    {
        return $this->belongsTo(Travail::class);
    }

    public function freelance()
    {
        return $this->belongsTo(User::class, 'freelance_id');
    }
}
