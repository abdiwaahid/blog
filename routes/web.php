<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return Inertia::render('welcome');
});
