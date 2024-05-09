<?php

namespace App\Http\Requests\Giphy;

use App\Http\Requests\JsonRequest;

class UserGifRequest extends JsonRequest
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
            'gif_id' => 'required|string',
            'alias' => 'string'
        ];
    }
}
