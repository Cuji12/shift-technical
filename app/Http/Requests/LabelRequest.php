<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * @return array<string, string>
     */
    public function messages(): array

    {
        return [
            'name.required' => 'Please enter a name for the label',
            'name.max:255' => "How long does your label need to be?!",
        ];

    }
}
