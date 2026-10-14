<?php

namespace App\Repositories\Eloquent;

use App\Models\Etudiant;
use App\Repositories\Contracts\EtudiantRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EtudiantsRepository implements EtudiantRepositoryInterface
{
    public function all(): Collection
    {
        return Etudiant::latest()->get();
    }
    public function create(array $data): Etudiant
    {
        return Etudiant::create($data);
    }
    public function delete(int $id): bool
    {
        return (bool) Etudiant::destroy($id);
    }
}
