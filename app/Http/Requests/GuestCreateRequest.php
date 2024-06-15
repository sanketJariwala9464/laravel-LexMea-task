<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestCreateRequest extends FormRequest
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
            'full_name' => 'required',
            'age' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => __('required', ['Full name']),
            'age.required' => __('required', ['Age']),
            'age.integer' => __('numeric', ['Age'])
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = ApiResponse::error($validator->errors()->first(), 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
