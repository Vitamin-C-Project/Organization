<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumniRequest extends FormRequest
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
            'destination_name' => 'required|string|min:1|max:100',
            'graduation_year' => 'required|string|min:1|max:100',
            'appointment' => 'required|string|min:1|max:100',
            'type' => 'required|in:1,2,3,4',
        ];
    }
}
