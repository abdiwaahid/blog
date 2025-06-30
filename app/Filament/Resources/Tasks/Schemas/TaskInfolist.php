<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TaskInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->numeric(),
                TextEntry::make('type'),
                TextEntry::make('url'),
                TextEntry::make('status'),
                TextEntry::make('priority'),
                TextEntry::make('due_date')
                    ->dateTime(),
                IconEntry::make('is_completed')
                    ->boolean(),
                IconEntry::make('is_recurring')
                    ->boolean(),
                TextEntry::make('recurrence_pattern'),
                TextEntry::make('recurrence_end_date')
                    ->dateTime(),
                TextEntry::make('color'),
                TextEntry::make('icon'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
