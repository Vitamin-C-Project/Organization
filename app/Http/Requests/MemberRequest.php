<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'year' => 'required|integer|exists:academic_years,id',
            'name' => 'required|string|min:3|max:100',
            'grade' => 'required|integer|exists:grades,id',
            'phone' => 'required|string|min:9|max:15',
            'gender' => 'required|string|in:L,P',
            'birth_place' => 'required|string|min:3|max:100',
            'birth_date' => 'required|date',
            'address' => 'required|string|min:3|max:200',
            'father_name' => 'required|string|min:3|max:100',
        ];
    }
}
