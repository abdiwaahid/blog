<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages\CreateArticle;
use App\Filament\Resources\ArticleResource\Pages\EditArticle;
use App\Filament\Resources\ArticleResource\Pages\ListArticles;
use App\Models\Article;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Articles';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->columnSpanFull(),
                TextInput::make('excerpt')->columnSpanFull()->required(),
                RichEditor::make('content')->required()->columnSpanFull(),
                Select::make('topic_id')->relationship('topic', 'name'),
                Select::make('tags')->relationship('tags', 'name')->multiple(),
                TextInput::make('meta_keywords')->label('Keywords')->columnSpanFull(),
                Group::make([
                    ToggleButtons::make('status')->required()
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'pending' => 'pending',
                        ])->default('published')->inline()->live(),
                    DateTimePicker::make('scheduled_for')->visible(fn ($get) => $get('status') === 'scheduled'),
                ])->columns(['md' => 2])->columnSpanFull(),
                FileUpload::make('featured_image')->image()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->wrap()->lineClamp(2),
                TextColumn::make('excerpt')->searchable()->wrap()->lineClamp(1),
                TextColumn::make('status')->badge()->searchable(),
                TextColumn::make('views')->searchable(),
                TextColumn::make('published_at')->dateTime()->sortable(),
                TextColumn::make('scheduled_for')->dateTime()->sortable(),
                ImageColumn::make('featured_image')->searchable(),
                TextColumn::make('user.name')->numeric()->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }
}
