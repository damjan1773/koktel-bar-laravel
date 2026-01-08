<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PorudzbinaUpdateRequest extends FormRequest
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
            'broj_stola' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'napomena' => ['nullable', 'string'],
            'korisnik_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
