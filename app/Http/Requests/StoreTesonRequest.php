<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreTesonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomina_id' => ['required', 'exists:nominas,id'],
            'tipo_personal' => ['required', 'integer', 'in:1,2,3,4'],
            'remision_nomina' => ['required', 'integer', 'in:1,2,3,4,5,6,7'],
            'folio_inicial' => ['nullable', 'integer', 'min:1'],
            'folio_final' => ['nullable', 'integer', 'min:1'],
            'observaciones' => ['nullable', 'string', 'max:500'],
        ];
    }
}
