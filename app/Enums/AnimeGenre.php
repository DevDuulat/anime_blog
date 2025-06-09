<?php

namespace App\Enums;

enum AnimeGenre: string
{
    case Action = 'Боевик';
    case Adventure = 'Приключения';
    case Fantasy = 'Фэнтези';
    case Drama = 'Драма';
    case Romance = 'Романтика';
    case Comedy = 'Комедия';
    case Horror = 'Ужасы';
}
