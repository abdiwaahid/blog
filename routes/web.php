<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Volt::route('/', 'pages.index')->name('home');
    Volt::route('/topics', 'pages.topics.index')->name('topics');
    Volt::route('/topics/{slug}', 'pages.topics.topic')->name('topic');
    Volt::route('/articles', 'pages.articles.index')->name('articles');
    Volt::route('/article/{slug}', 'pages.articles.article')->name('article');

require __DIR__.'/auth.php';
