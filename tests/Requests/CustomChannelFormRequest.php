<?php

namespace Foxen\LaravelValidationErrorLogger\Tests\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Foxen\LaravelValidationErrorLogger\LogsValidationErrors;

class CustomChannelFormRequest extends FormRequest
{
    use LogsValidationErrors;

    protected $logChannel = 'custom_channel';

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
