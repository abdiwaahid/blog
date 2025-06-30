<?php

namespace App\Providers;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Select::configureUsing(function ($component): void {
            $component->native(false);
        });

        DateTimePicker::configureUsing(function ($component): void {
            $component->native(false);
        });

        DatePicker::configureUsing(function ($component): void {
            $component->native(false);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Model::unguard();
    }
}
