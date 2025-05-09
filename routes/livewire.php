<?php

// Necesario para ocupar Livewire::setScriptRoute personalizados
// Para que Los recursos de JavaScript serán servidos por su servidor web
// php artisan livewire:publish --assets

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Livewire::setScriptRoute(function ($handle) {
    return Route::get(env('APP_URL_PRE', 'null') . '/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(env('APP_URL_PRE', 'null') . '/livewire/update', $handle);
});