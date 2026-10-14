<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtudiantRequest;
use App\Repositories\Contracts\EtudiantRepositoryInterface;
use Inertia\Inertia;
use Inertia\Response;

class EtudiantController extends Controller
{
   
    public function __construct(
        protected EtudiantRepositoryInterface $etudiantRepository
    ) {}

   
    public function index(): Response
    {
        return Inertia::render('etudiants/etudiant', [
            'etudiants' => $this->etudiantRepository->all(),
        ]);
    }

    
    public function store(StoreEtudiantRequest $request)
    {
        $this->etudiantRepository->create($request->validated());

        return redirect()->back();
    }


}