<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPointRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:App\Models\UserPoint,id'],
            'latitude' => ['nullable', 'numeric', 'between:-90.0,90.0', 'regex:/^-?\d{1,3}\.\d{1,9}$/'],
            'longitude' => ['nullable', 'numeric', 'between:-180.0,180.0', 'regex:/^-?\d{1,3}\.\d{1,9}$/'],
            'municipal_id' => ['nullable', 'integer', 'exists:App\Models\MunicipalGeometry,id'],
            'geom' => ['nullable', 'string'],
        ];
    }
}
