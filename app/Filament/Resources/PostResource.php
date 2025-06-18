<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Посты';
    protected static ?string $modelLabel = 'Посты';
    protected static ?string $pluralModelLabel = 'Посты';

    public static function form(Form $form): Form
  {
      return $form
          ->schema([
              Grid::make()
                  ->schema([
                      Forms\Components\Hidden::make('user_id')
                          ->default(Auth::id())
                          ->required(),

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

                      Forms\Components\TextInput::make('title')
                          ->label('Заголовок')
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

                      Forms\Components\FileUpload::make('image')
                          ->label('Изображение')
                          ->image(),
                  ]),

              RichEditor::make('content')
                  ->label('Содержание')
                  ->columnSpan('full')
                  ->toolbarButtons([
                      'attachFiles',   // прикрепить файлы
                      'blockquote',    // цитата
                      'bold',          // жирный
                      'bulletList',    // маркированный список
                      'codeBlock',     // блок кода
                      'h2',            // заголовок 2 уровня
                      'h3',            // заголовок 3 уровня
                      'italic',        // курсив
                      'link',          // ссылка
                      'orderedList',   // нумерованный список
                      'redo',          // повторить
                      'strike',        // зачеркнутый
                      'underline',     // подчеркивание
                      'undo',          // отменить
                  ]),
          ]);
  }
  public static function table(Table $table): Table
  {
      return $table
          ->columns([
              Tables\Columns\TextColumn::make('category_id')
                  ->label('Категория (ID)')
                  ->numeric()
                  ->sortable(),

              Tables\Columns\TextColumn::make('user_id')
                  ->label('Пользователь (ID)')
                  ->numeric()
                  ->sortable(),

              Tables\Columns\TextColumn::make('title')
                  ->label('Название')
                  ->searchable(),

              Tables\Columns\TextColumn::make('slug')
                  ->label('Слаг')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
      return 'Посты';
    }

    public static function getNavigationLabel(): string
    {
        return 'Посты';
    }
}
