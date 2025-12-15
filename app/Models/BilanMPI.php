<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BilanMPI extends Model
{
    use SoftDeletes;

    protected $table = 'bilans_mpi';

    protected $fillable = [
        'nom',
        'prenom',
        'cip',
        'formateurs',
        'notes_brutes',
        'bilan_genere',
        'user_id',
        'impact_efficacite',
        'impact_marche_travail',
        'impact_insertion_sociale',
    ];

    protected $casts = [
        'bilan_genere' => 'array',
    ];

    /**
     * Relation avec l'utilisateur qui a créé le bilan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir le nom complet formaté
     */
    public function getNomCompletAttribute(): string
    {
        return strtoupper($this->nom) . ' ' . ucfirst($this->prenom);
    }
}