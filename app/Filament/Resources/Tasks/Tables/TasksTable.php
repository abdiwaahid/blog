<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->sortable(),
                TextColumn::make('type')->searchable(),
                TextColumn::make('url')->label('Link')->searchable(),
                TextColumn::make('due_date')->label('Due')->dateTime()->sortable(),
                IconColumn::make('is_completed')->boolean(),
                IconColumn::make('is_recurring')->boolean(),
                TextColumn::make('frequency')->label('Recurrence')->searchable(),
                TextColumn::make('end_date')->label('End Date')->dateTime()->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
