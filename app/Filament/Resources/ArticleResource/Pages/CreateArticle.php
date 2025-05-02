<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['slug'] = str($data['title'])->slug();
        $data['meta_title'] = $data['title'];
        $data['meta_description'] = $data['excerpt'];
        
        $data['published_at'] =  when($data['status'] == 'published' ,now());
        return $data;
    }
}
