<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\ApiResponse;

class RoomCreateRequest extends FormRequest
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
            'floor_number' => 'required|integer',
            'room_number' => 'required|integer',
            'capacity' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'floor_number.required' => __('required', ['Floor number']),
            'floor_number.integer' => __('numeric', ['Floor number']),
            'room_number.required' => __('required', ['Room number']),
            'room_number.integer' => __('numeric', ['Room number']),
            'capacity.required' => __('required', ['Capacity']),
            'capacity.integer' => __('numeric', ['Capacity'])
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = ApiResponse::error($validator->errors()->first(), 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
