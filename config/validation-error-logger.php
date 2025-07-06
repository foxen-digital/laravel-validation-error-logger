<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that will be used to log
    | validation errors. You can use any of the channels defined in your
    | `config/logging.php` file. The default is 'stack'.
    |
    */
    "log_channel" => env("LOG_VALIDATION_ERRORS_CHANNEL", "stack"),

    /*
    |--------------------------------------------------------------------------
    | Exclude Fields From Logging
    |--------------------------------------------------------------------------
    |
    | This option allows you to specify a list of fields that should be
    | excluded from the logged data. This is useful for preventing sensitive
    | information from being written to your logs. By default, stanard password
    | fields are already included.
    |
    */
    "exclude_from_logging" => ["password", "password_confirmation"],
];
