<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsageExamplePostingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'example' => ['required', 'string', 'max:16000']
        ];
    }
}
