<?php

namespace Foxen\LaravelValidationErrorLogger\Tests\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Foxen\LaravelValidationErrorLogger\LogsValidationErrors;

class ExcludeFormRequest extends FormRequest
{
    use LogsValidationErrors;

    protected $excludeFromLogging = ["password"];

    public function rules(): array
    {
        return [
            "name" => "required",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
