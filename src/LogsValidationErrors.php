<?php

namespace Foxen\LaravelValidationErrorLogger;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;

trait LogsValidationErrors
{
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->failed()) {
                    $logChannel = property_exists($this, 'logChannel') && $this->logChannel
                        ? $this->logChannel
                        : config('validation-error-logger.log_channel', 'default');

                    $configExcludes = config('validation-error-logger.exclude_from_logging', []);

                    $classExcludes = property_exists($this, 'excludeFromLogging') && is_array($this->excludeFromLogging)
                        ? $this->excludeFromLogging
                        : [];

                    $excludeFromLogging = array_merge($configExcludes, $classExcludes);

                    Log::channel($logChannel)->debug(
                        'Validation failure',
                        [
                            'URL' => request()->url(),
                            'Validator' => get_class($this),
                            'Errors' => $validator->errors()->all(),
                            'Data' => Arr::except($validator->getData(), $excludeFromLogging),
                        ]
                    );
                }
            },
        ];
    }
}
