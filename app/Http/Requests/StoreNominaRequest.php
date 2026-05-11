<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreNominaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomina' => ['required', 'string', 'max:255'],
            'fecha_emision' => ['required', 'string'],
            'comentario' => ['nullable', 'string', 'max:500'],
        ];
    }
}
