<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $navigationLabel = 'Панель управление';
    protected static ?string $modelLabel = 'Панель управление';
    protected static ?string $pluralModelLabel = 'Панель управление';

    public static function shouldRegisterNavigation(): bool
    {
        return true; // Показывать в меню
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Главная';
    }

    public static function getNavigationLabel(): string
    {
        return 'Панель управления';
    }

}
