<?php

use Foxen\LaravelValidationErrorLogger\Tests\Requests\CustomChannelFormRequest;
use Foxen\LaravelValidationErrorLogger\Tests\Requests\ExcludeFormRequest;
use Foxen\LaravelValidationErrorLogger\Tests\Requests\TestFormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

test('it logs validation errors', function () {
    Log::shouldReceive('channel->debug')->once();

    Route::post('/test-route', function (TestFormRequest $request) {
        return response()->json(['success' => true]);
    });

    $this->postJson('/test-route', ['name' => '']);
});

test('it excludes fields from logging', function () {
    Log::shouldReceive('channel->debug')->withArgs(function ($message, $context) {
        expect($context['Data'])->not->toHaveKey('password');
        return true;
    })->once();

    Route::post('/test-route', function (ExcludeFormRequest $request) {
        return response()->json(['success' => true]);
    });

    $this->postJson('/test-route', ['name' => '', 'password' => 'secret']);
});

test('it uses a custom log channel', function () {
    Log::shouldReceive('channel')->with('custom_channel')->andReturnSelf();
    Log::shouldReceive('debug')->once();

    Route::post('/test-route', function (CustomChannelFormRequest $request) {
        return response()->json(['success' => true]);
    });

    $this->postJson('/test-route', ['name' => '']);
});