<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnswerResource\Pages;
use App\Filament\Resources\AnswerResource\RelationManagers;
use App\Models\Answer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Ответы';
    protected static ?string $modelLabel = 'Ответы';
    protected static ?string $pluralModelLabel = 'Ответы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('question_id')
                    ->label('Вопрос')
                    ->relationship('question', 'question_text')
                    ->searchable()
                    ->required()
                    ->preload(),

                Forms\Components\TextInput::make('answer_text')
                    ->label('Текст ответа')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_correct')
                    ->label('Правильный ответ')
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question.question_text')
                    ->label('Вопрос')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('answer_text')
                    ->label('Ответ')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_correct')
                    ->label('Правильный?')
                    ->boolean(),

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
            'index' => Pages\ListAnswers::route('/'),
            'create' => Pages\CreateAnswer::route('/create'),
            'edit' => Pages\EditAnswer::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Ответы'; // Перевод "Answers"
    }

    public static function getTitle(): string
    {
        return 'Список ответов'; // Перевод заголовка страницы
    }

    public static function getNavigationLabel(): string
    {
        return 'Ответы'; // Для меню
    }

    public static function getCreateButtonLabel(): string
    {
        return 'Создать';
    }



}
