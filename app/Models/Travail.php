<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travail extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'budget',
        'date_limite',
        'statut',
        'user_id'
    ];

    protected $dates = ['date_limite'];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }
}
