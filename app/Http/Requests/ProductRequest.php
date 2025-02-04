<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        if ($this->isMethod('put')) {
            return [
                'name' => 'required|string|max:255',
                'description' => 'string',
                'price' => 'required|numeric|min:0.99',
                'stock' => 'numeric|min:1|max:999'
            ];
        }

        if ($this->isMethod('patch')) {
            return [
                'name' => 'string|max:255',
                'description' => 'string',
                'price' => 'numeric|min:0.99',
                'stock' => 'numeric|min:0|max:999'
            ];
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
           'message' => 'Missing variable.',
           'errors' => $validator->errors() 
        ], 422));
    }
}
