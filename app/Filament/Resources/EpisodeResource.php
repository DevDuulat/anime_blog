<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EpisodeResource\Pages;
use App\Filament\Resources\EpisodeResource\RelationManagers;
use App\Models\Episode;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class EpisodeResource extends Resource
{
    protected static ?string $model = Episode::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Эпизоды';
    protected static ?string $modelLabel = 'Эпизоды';
    protected static ?string $pluralModelLabel = 'Эпизоды';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('media_item_id')
                    ->label('Медиа элемент')
                    ->relationship('mediaItem', 'title')
                    ->required(),

                TextInput::make('title')
                    ->label('Название')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true) // При потере фокуса
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->label('Слаг')
                    ->required()
                    ->maxLength(255),

                TextInput::make('video_url')
                    ->label('Ссылка на видео')
                    ->url()
                    ->required(),

                // FileUpload::make('video_url')
                //     ->label('Видео')
                //     ->directory('episodes')
                //     ->disk('public')
                //     ->acceptedFileTypes(['video/mp4'])
                //     ->maxSize(2097152)
                //     ->preserveFilenames()
                //     ->required(),

                TextInput::make('episode_number')
                    ->label('Номер эпизода')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mediaItem.title')
                    ->label('Медиа элемент')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Слаг')
                    ->searchable(),
                Tables\Columns\TextColumn::make('video_url')
                    ->label('Ссылка на видео')
                    ->searchable(),
                Tables\Columns\TextColumn::make('episode_number')
                    ->label('Номер эпизода')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Удалить выбранные'),
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
            'index' => Pages\ListEpisodes::route('/'),
            'create' => Pages\CreateEpisode::route('/create'),
            'edit' => Pages\EditEpisode::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
      return 'Эпизоды';
    }

    public static function getNavigationLabel(): string
    {
        return 'Эпизоды';
    }
}
