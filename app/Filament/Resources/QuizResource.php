<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Quiz;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\QuizResource\Pages;
use CodeWithDennis\FilamentSelectTree\SelectTree;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Тесты';
    protected static ?string $modelLabel = 'Тест';
    protected static ?string $pluralModelLabel = 'Тесты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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

                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::id())
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image(),
            ]);
    }


  public static function table(Table $table): Table
  {
      return $table
          ->columns([
              Tables\Columns\TextColumn::make('title')
                  ->label('Название')
                  ->searchable(),

              Tables\Columns\ImageColumn::make('image')
                  ->label('Изображение'),

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
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
    public static function getBreadcrumb(): string
    {
      return 'Тесты';
    }

    public static function getNavigationLabel(): string
    {
        return 'Тесты';
    }
}
