<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhelFunctionRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $basePattern = '!%*+-\/<=>?A-Za-z';
        return [
            'phelNamespace' => ['required', 'string', 'regex:/[A-Za-z][-0-9A-Z\\a-z]*/', 'max:255'],
            'name' => ['required', 'string', "regex:/[$basePattern][0-9$basePattern]*/", 'max:255'],
            'symbol_type' => ['required', 'string', 'in:special-form,macro,function'],
            'description' => ['nullable', 'string', 'max:16000'],
        ];
    }
}
