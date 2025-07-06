<?php

namespace Foxen\LaravelValidationErrorLogger;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;

trait LogsValidationErrors
{
    protected $logChannel = 'default';
    protected $excludeFromLogging = [];
    
    public function after(): array
    {
        $class = get_class($this);
        $data = Arr::except($validator->getData(), $this->excludeFromLogging);
        return [
            function (Validator $validator) use ($class) {
                if ($validator->failed()) {
                    Log::channel($this->logChannel)->debug(
                        'Validation failure',
                        [
                            'URL' => request()->url(),
                            'Validator' => $class,
                            'Errors' => $validator->errors()->all(),
                            'Data' => $data,
                        ]
                    );
                }
            }
        ];
    }
}
