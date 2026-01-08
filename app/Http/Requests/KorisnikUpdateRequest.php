<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KorisnikUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'table' => ['required', 'string'],
            'ime' => ['required', 'string'],
            'prezime' => ['required', 'string'],
            'uloga' => ['required', 'string'],
        ];
    }
}
