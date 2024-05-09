<?php

namespace App\Http\Requests\Giphy;

use App\Http\Requests\JsonRequest;

class GiphySearchRequest extends JsonRequest
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
            'query' => 'string|required',
            'limit' => 'integer|sometimes',
            'offset' => 'integer|sometimes'
        ];
    }
}
