<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Groupe extends Model
{
    protected $fillable = [
        'nom',
        'code'
    ];

    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);
    }
}
