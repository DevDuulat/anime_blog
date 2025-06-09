<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'user_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Связь с вопросами (будет)
  public function questions()
  {
    return $this->hasMany(Question::class);
  }
}
