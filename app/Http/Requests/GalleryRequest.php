<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'files' => 'required|array|max:4',
            'files.*' => 'required|mimes:jpg,jpeg,png,heic,pdf,doc,docx,xls,xlsx,ppt,pptx,mp4,mkv,mp3|max:20480',
        ];
    }
}
