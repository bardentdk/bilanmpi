<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bilan extends Model
{
    protected $fillable = [
        'stagiaire_nom',
        'stagiaire_prenom',
        'formation_titre',
        'formation_date_debut',
        'formation_date_fin',
        'objectifs_atteints',
        'competences_acquises',
        'points_forts',
        'axes_amelioration',
        'observations_generales',
        'note_globale',
        'original_data',
        'rewritten_data',
    ];

    protected $casts = [
        'formation_date_debut' => 'date',
        'formation_date_fin' => 'date',
        'note_globale' => 'decimal:1',
        'original_data' => 'array',
        'rewritten_data' => 'array',
    ];
}