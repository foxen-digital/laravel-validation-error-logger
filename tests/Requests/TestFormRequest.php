<?php

namespace Foxen\LaravelValidationErrorLogger\Tests\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Foxen\LaravelValidationErrorLogger\LogsValidationErrors;

class TestFormRequest extends FormRequest
{
    use LogsValidationErrors;

    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
