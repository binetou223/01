<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEtudiantRequest extends FormRequest
{
    
   
   /**
     * Determine if the user is authorized to make this request.
     */
   
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_complet' => ['required', 'string', 'min:2', 'max:100'],
            'sexe' => ['required', 'in:M,F'],
            'niveau' => ['required', 'integer', 'in:1,2,3'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'nom_complet.required' => 'Le nom complet est obligatoire.',
            'nom_complet.min' => 'Le nom complet doit comporter au moins 2 caractères.',
            'sexe.required' => 'Veuillez sélectionner le sexe.',
            'sexe.in' => 'Le sexe sélectionné est invalide.',
            'niveau.required' => 'Veuillez sélectionner un niveau d’études.',
            'niveau.in' => 'Le niveau doit être 1, 2 ou 3.',
        ];
    }
}
