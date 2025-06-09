<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'user_id',
    'image',
    'category_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function questions()
  {
    return $this->hasMany(Question::class);
  }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
