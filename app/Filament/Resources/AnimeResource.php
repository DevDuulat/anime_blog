<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnimeResource\Pages;
use App\Filament\Resources\AnimeResource\RelationManagers;
use App\Models\Anime;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use App\Enums\AnimeType;
use App\Enums\AnimeGenre;

class AnimeResource extends Resource
{
  protected static ?string $model = Anime::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([

        Forms\Components\TextInput::make('title')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('slug')
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
          ->maxLength(255),
        Forms\Components\DatePicker::make('release_date'),
        Select::make('type')
          ->label('Тип')
          ->options(
            collect(AnimeType::cases())
              ->mapWithKeys(fn($case) => [$case->value => $case->value])
          )
          ->required(),

        CheckboxList::make('genres')
          ->label('Жанры')
          ->options(
            collect(AnimeGenre::cases())
              ->mapWithKeys(fn($case) => [$case->value => $case->value])
          )
          ->columns(2)
          ->required(),
        Forms\Components\FileUpload::make('image')
          ->image(),

        Forms\Components\Textarea::make('description')
          ->columnSpanFull(),
        Forms\Components\TextInput::make('watch_url')
          ->maxLength(255),
        Forms\Components\TextInput::make('views')
          ->required()
          ->numeric()
          ->default(0),

      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('image'),
        Tables\Columns\TextColumn::make('title')
          ->searchable(),
        Tables\Columns\TextColumn::make('slug')
          ->searchable(),
        Tables\Columns\TextColumn::make('category.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('studio')
          ->searchable(),
        Tables\Columns\TextColumn::make('release_date')
          ->date()
          ->sortable(),
        Tables\Columns\TextColumn::make('type')
          ->searchable(),
        Tables\Columns\TextColumn::make('watch_url')
          ->searchable(),
        Tables\Columns\TextColumn::make('views')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
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
      'index' => Pages\ListAnimes::route('/'),
      'create' => Pages\CreateAnime::route('/create'),
      'edit' => Pages\EditAnime::route('/{record}/edit'),
    ];
  }
}
