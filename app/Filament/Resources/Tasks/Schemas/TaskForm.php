<?php

namespace App\Filament\Resources\Tasks\Schemas;

use App\Enums\TaskFrequency;
use App\Enums\TaskType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')->options(TaskType::toArray())->required()->columnSpanFull(),
                Toggle::make('is_link')->dehydrated(false)->live(),
                RichEditor::make('content')->columnSpanFull()->visible(fn($get) => ! $get('is_link'))
                    ->required(fn($get) => ! $get('is_link'))
                    ->label('Content'),
                TextInput::make('url')->visible(fn($get) => $get('is_link'))
                    ->required(fn($get) => $get('is_link'))
                    ->label('Link')->columnSpanFull(),
                Toggle::make('is_recurring')->required()->live()->columnSpanFull(),
                DateTimePicker::make('due_date')->visible(fn($get) => ! $get('is_recurring'))
                    ->required(fn($get) => ! $get('is_recurring'))
                    ->label('Due Date')->columnSpanFull(),
                Group::make([
                    Select::make('frequency')->options(TaskFrequency::toArray())->required(fn($get) => $get('is_recurring')),
                    TextInput::make('params')->label('Params'),
                    DateTimePicker::make('end_date'),
                ])->columnSpanFull()->columns(['md' => 2])->visible(fn($get) => $get('is_recurring')),

                Textarea::make('notes')->columnSpanFull(),
            ]);
    }
}
