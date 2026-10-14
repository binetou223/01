<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etudiant extends Model
{
    protected $fillable = [
        'nom_complet',
        'sexe',
        'niveau',
        'groupe_id'
    ];

    protected $casts = [
        'niveau' => 'integer',
    ];

    public function groupe(): BelongsTo
    {
        return $this->belongsTo(Groupe::class);
    }
}
