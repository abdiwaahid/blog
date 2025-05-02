<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Imports\ArticleImporter;
use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ExportAction::make()->exports([
            //     ExcelExport::make('table')->fromTable(),
            // ]),
            ImportAction::make()->importer(ArticleImporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
