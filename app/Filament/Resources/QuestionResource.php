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
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image(),

                // Add answers section
                Forms\Components\Repeater::make('answers')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('answer_text')
                            ->required()
                            ->maxLength(255)
                            ->label('Текст ответа'),
                        Forms\Components\Toggle::make('is_correct')
                            ->required()
                            ->label('Правильный ответ'),
                    ])
                    ->defaultItems(3) // Default 3 answer fields
                    ->minItems(3) // Minimum 3 answers required
                    ->maxItems(3) // Maximum 3 answers allowed
                    ->columnSpanFull()
                    ->label('Ответы')
                    ->addActionLabel('Добавить ответ')
                    ->orderable(false), // Disable reordering if you want exactly 3 answers
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quiz.title')
                    ->numeric()
                    ->sortable()
                    ->label('Тест'),
                Tables\Columns\TextColumn::make('question_text')
                    ->limit(50)
                    ->label('Вопрос'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('answers_count')
                    ->counts('answers')
                    ->label('Кол-во ответов'),
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
}
