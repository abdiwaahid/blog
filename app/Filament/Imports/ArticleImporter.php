<?php

namespace App\Filament\Imports;

use App\Models\Article;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ArticleImporter extends Importer
{
    protected static ?string $model = Article::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('title')->requiredMapping()->rules(['required']),
            ImportColumn::make('sub_title'),
            ImportColumn::make('body')->requiredMapping()->rules(['required']),
            ImportColumn::make('status')->requiredMapping()->rules(['required']),
            ImportColumn::make('published_at')->rules(['datetime']),
            ImportColumn::make('scheduled_for')->rules(['datetime']),
            ImportColumn::make('cover_photo_path')->requiredMapping()->rules(['required']),
            ImportColumn::make('photo_alt_text')->requiredMapping()->rules(['required']),
            ImportColumn::make('user')->requiredMapping()->relationship('user','name')->rules(['required']),
            ImportColumn::make('views')->requiredMapping()->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): ?Article
    {
        // return Article::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Article();
    }


    protected function beforeCreate(): void
    {
        $this->record->offsetSet('slug', str($this->record->title)->slug());
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your Article import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
