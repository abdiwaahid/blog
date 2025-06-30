<?php

namespace App\Providers;

use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
        $this->configureFilament();
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


    protected function configureFilament(): void
    {
        Select::configureUsing(function ($component): void {
            $component->searchable()->preload()->native(false);
        });

        SelectFilter::configureUsing(function ($component): void {
            $component->searchable()->preload()->native(false);
        });

        DateTimePicker::configureUsing(function ($component): void {
            $component->native(false);
        });

        DatePicker::configureUsing(function ($component): void {
            $component->native(false);
        });

        CreateAction::configureUsing(function ($component): void {
            $component->icon('heroicon-o-plus');
        });

        ImportAction::configureUsing(function ($component): void {
            $component->icon('heroicon-o-arrow-up-tray');
        });
    }
}
