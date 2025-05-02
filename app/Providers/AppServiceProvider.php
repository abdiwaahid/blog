<?php

namespace App\Providers;
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
        Forms\Components\Select::configureUsing(function ($component): void {
            $component->native(false);
        });

        Forms\Components\DateTimePicker::configureUsing(function ($component): void {
            $component->native(false);
        });

        Forms\Components\DatePicker::configureUsing(function ($component): void {
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
