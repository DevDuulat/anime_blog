<?php

namespace App\Enums;

enum MediaType: string
{
  case TV = 'Сериал';
  case Movie = 'Фильм';
  case OVA = 'OVA';
  case ONA = 'ONA';
  case Special = 'Спешл';
}
