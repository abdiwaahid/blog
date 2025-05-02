<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationGroup = 'Articles';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->columnSpanFull(),
                Forms\Components\TextInput::make('excerpt')->columnSpanFull()->required(),
                Forms\Components\RichEditor::make('content')->autofocus(false)->required()->columnSpanFull(),
                Forms\Components\Select::make('topic_id')->relationship('topic','name'),
                Forms\Components\Select::make('tags')->relationship('tags','name')->multiple(),
                Forms\Components\TextInput::make('meta_keywords')->label('Keywords')->columnSpanFull(),
                Forms\Components\Group::make([
                    Forms\Components\ToggleButtons::make('status')->required()
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'pending' => 'pending',
                        ])->default('published')->inline()->live(),
                    Forms\Components\DateTimePicker::make('scheduled_for')->visible(fn($get) => $get('status') === 'scheduled'),
                ])->columns(['md' => 2])->columnSpanFull(),
                Forms\Components\FileUpload::make('featured_image')->image()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->wrap()->lineClamp(2),
                Tables\Columns\TextColumn::make('sub_title')->searchable()->wrap()->lineClamp(1),
                Tables\Columns\TextColumn::make('body')->searchable()->wrap()->lineClamp(1),
                Tables\Columns\TextColumn::make('status')->badge()->searchable(),
                Tables\Columns\TextColumn::make('views')->searchable(),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('scheduled_for')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('cover_photo_path')->searchable(),
                Tables\Columns\TextColumn::make('photo_alt_text')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
