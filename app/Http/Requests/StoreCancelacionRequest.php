<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreCancelacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'num_empleado' => ['required', 'integer'],
            'nombre' => ['required', 'string', 'max:255'],
            'numero_cheque' => ['required', 'integer'],
            'importe' => ['required', 'numeric', 'min:0'],
            'clave' => ['required', 'integer', 'in:50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,80,81'],
        ];
    }
}
