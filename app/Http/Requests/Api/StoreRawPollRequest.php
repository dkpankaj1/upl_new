<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\HttpResponses;

class StoreRawPollRequest extends FormRequest
{
    use HttpResponses;
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
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => ['required'],
            'longitude' => ['required'],
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        return $this->sendHttpResponseException("validation exception", $validator->errors());
    }
}
