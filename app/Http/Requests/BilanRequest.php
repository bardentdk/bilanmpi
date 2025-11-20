<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BilanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_apprenant' => 'required|string',
            'formation' => 'required|string',
            'notes_cip' => 'required|string',
            'points_forts' => 'nullable|string',
            'axes_amelioration' => 'nullable|string',
        ];
    }
}
