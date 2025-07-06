# Laravel Validation Error Logger

This package provides a simple trait to log validation errors in your Laravel application.

## Installation

Install the package via composer:

```bash
composer require foxen/laravel-validation-error-logger
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Foxen\LaravelValidationErrorLogger\ServiceProvider"
```

This will create a `config/validation-error-logger.php` file in your application. Here you can configure the default logging channel and fields to exclude from logging.

## Usage

To use the trait, simply import and use it in your FormRequest class:

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Foxen\LaravelValidationErrorLogger\LogsValidationErrors;

class MyRequest extends FormRequest
{
    use LogsValidationErrors;

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
```

### Customizing the Log Channel

You can override the default log channel by setting the `$logChannel` property in your request class:

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Foxen\LaravelValidationErrorLogger\LogsValidationErrors;

class MyRequest extends FormRequest
{
    use LogsValidationErrors;

    protected $logChannel = 'custom_channel';

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
```

### Excluding Fields from Logging

You can exclude fields from being logged by setting the `$excludeFromLogging` property in your request class:

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Foxen\LaravelValidationErrorLogger\LogsValidationErrors;

class MyRequest extends FormRequest
{
    use LogsValidationErrors;

    protected $excludeFromLogging = ['password', 'password_confirmation'];

    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required|confirmed',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
```
