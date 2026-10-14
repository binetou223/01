<?php

namespace App\Repositories\Contracts;

use App\Models\Etudiant;

use Illuminate\Database\Eloquent\Collection;

interface  EtudiantRepositoryInterface{
      
    public function all(): Collection;
   
    public function create(array $data): Etudiant;
   
    public function delete(int $id): bool;
}