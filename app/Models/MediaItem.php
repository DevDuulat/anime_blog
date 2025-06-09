<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
      'watch_url',
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

}
