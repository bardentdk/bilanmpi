<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BilanMPI extends Model
{
    protected $table = 'bilans_mpi';

    protected $fillable = [
        'nom',
        'prenom',
        'cip',
        'formateurs',
        'notes_brutes',
        'bilan_genere',
    ];

    protected $casts = [
        'bilan_genere' => 'array',
    ];

    /**
     * Obtenir le nom complet formaté
     */
    public function getNomCompletAttribute(): string
    {
        return strtoupper($this->nom) . ' ' . ucfirst($this->prenom);
    }
}