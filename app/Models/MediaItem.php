<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaItem extends Model
{
    use HasFactory;

     protected $fillable = [
      'title',
      'slug',
      'category_id',
      'studio',
      'release_date',
      'type',
      'genres',
      'description',
      'views',
      'image',
    ];

    protected $casts = [
      'release_date' => 'date',
      'type' => MediaType::class,
      'genres' => 'array',
    ];

    public function category(): BelongsTo
    {
      return $this->belongsTo(Category::class);
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class)->orderBy('episode_number');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

}
