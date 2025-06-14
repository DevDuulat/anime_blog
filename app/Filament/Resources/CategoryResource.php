<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
  protected static ?string $model = Category::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        SelectTree::make('parent_id')
          ->relationship('parent', 'name', 'parent_id')
          ->placeholder(__('Выберите родительскую категорию'))
          ->defaultOpenLevel(1)
          ->searchable()
          ->clearable()
          ->withCount()
          ->enableBranchNode(),

      Forms\Components\TextInput::make('name')
          ->required()
          ->maxLength(255)
          ->live(onBlur: true)
          ->afterStateUpdated(function (Set $set, $state) {
              $set('slug', Str::slug($state));
          }),
    Forms\Components\TextInput::make('slug')
          ->required()
          ->maxLength(255),
        ]);
  }


  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('parent.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('slug')
          ->searchable(),
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
      'index' => Pages\ListCategories::route('/'),
      'create' => Pages\CreateCategory::route('/create'),
      'edit' => Pages\EditCategory::route('/{record}/edit'),
    ];
  }
}
