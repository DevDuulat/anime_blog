<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use App\Enums\MediaType;
use Filament\Forms\Form;
use App\Enums\MediaGenre;
use App\Models\MediaItem;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use App\Filament\Resources\MediaItemResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MediaItemResource\RelationManagers;

class MediaItemResource extends Resource
{
    protected static ?string $model = MediaItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Медиа';
    protected static ?string $modelLabel = 'Медиа';
    protected static ?string $pluralModelLabel = 'Медиа';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),

                Forms\Components\TextInput::make('slug')
                    ->label('Слаг')
                    ->required()
                    ->maxLength(255),

                SelectTree::make('category_id')
                    ->label('Категория')
                    ->relationship(
                        relationship: 'category',
                        titleAttribute: 'name',
                        parentAttribute: 'parent_id'
                    )
                    ->placeholder('Выберите категорию')
                    ->searchable()
                    ->defaultOpenLevel(2)
                    ->enableBranchNode()
                    ->clearable()
                    ->withCount()
                    ->required(),

                Forms\Components\TextInput::make('studio')
                    ->label('Студия')
                    ->maxLength(255),

                Forms\Components\DatePicker::make('release_date')
                    ->label('Дата релиза'),

                Select::make('type')
                    ->label('Тип')
                    ->options(
                        collect(MediaType::cases())
                            ->mapWithKeys(fn($case) => [$case->value => $case->value])
                    )
                    ->required(),

                CheckboxList::make('genres')
                    ->label('Жанры')
                    ->options(
                        collect(MediaGenre::cases())
                            ->mapWithKeys(fn($case) => [$case->value => $case->value])
                    )
                    ->columns(2)
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image(),

                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('views')
                    ->label('Просмотры')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Слаг')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable(),

                Tables\Columns\TextColumn::make('studio')
                    ->label('Студия')
                    ->searchable(),

                Tables\Columns\TextColumn::make('release_date')
                    ->label('Дата релиза')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->searchable(),

                Tables\Columns\TextColumn::make('views')
                    ->label('Просмотры')
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
            'index' => Pages\ListMediaItems::route('/'),
            'create' => Pages\CreateMediaItem::route('/create'),
            'edit' => Pages\EditMediaItem::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
      return 'Медиа';
    }

    public static function getNavigationLabel(): string
    {
        return 'Медиа';
    }
}
