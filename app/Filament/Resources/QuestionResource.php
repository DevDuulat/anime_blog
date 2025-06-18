<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Question;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuestionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionResource\RelationManagers;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Вопросы';
    protected static ?string $modelLabel = 'Вопросы';
    protected static ?string $pluralModelLabel = 'Вопросы';

   public static function form(Form $form): Form
  {
      return $form
          ->schema([
              Select::make('quiz_id')
                  ->label('Выберите тест')
                  ->required()
                  ->relationship('quiz', 'title')
                  ->searchable()
                  ->preload(),

              Forms\Components\Textarea::make('question_text')
                  ->label('Вопрос')
                  ->required()
                  ->columnSpanFull(),

              Forms\Components\FileUpload::make('image')
                  ->label('Изображение')
                  ->image(),

              // Секция с ответами
              Forms\Components\Repeater::make('answers')
                  ->relationship()
                  ->schema([
                      Forms\Components\TextInput::make('answer_text')
                          ->label('Текст ответа')
                          ->required()
                          ->maxLength(255),

                      Forms\Components\Toggle::make('is_correct')
                          ->label('Правильный ответ')
                          ->required(),
                  ])
                  ->defaultItems(5) // По умолчанию 3 поля для ответов
                  ->minItems(5)     // Минимум 3 ответа
                  ->maxItems(5)     // Максимум 3 ответа
                  ->columnSpanFull()
                  ->label('Ответы')
                  ->addActionLabel('Добавить ответ')
                  ->orderable(false), // Отключаем сортировку, чтобы всегда было ровно 3 ответа
          ]);
  }

  public static function table(Table $table): Table
  {
      return $table
          ->columns([
              Tables\Columns\TextColumn::make('quiz.title')
                  ->label('Тест')
                  ->sortable()
                  ->numeric(),

              Tables\Columns\TextColumn::make('question_text')
                  ->label('Вопрос')
                  ->limit(50),

              Tables\Columns\ImageColumn::make('image')
                  ->label('Изображение'),

              Tables\Columns\TextColumn::make('answers_count')
                  ->label('Кол-во ответов')
                  ->counts('answers'),

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
            // You can remove this relation manager if you're handling answers in the main form
            // RelationManagers\AnswersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
      return 'Вопросы';
    }

    public static function getNavigationLabel(): string
    {
        return 'Вопросы';
    }
}
