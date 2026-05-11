<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateUserInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'adscripcion' => ['required', 'string', 'max:255'],
            'unidad' => ['required', 'string', 'max:255'],
            'lugar' => ['required', 'string', 'max:255'],
            'titular_area' => ['required', 'string', 'max:255'],
            'pagador_habilitado' => ['required', 'string', 'max:255'],
        ];
    }
}
