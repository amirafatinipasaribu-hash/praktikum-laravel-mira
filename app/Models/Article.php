<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            return $this->image;
        }

        $seed = $this->slug ?: ($this->id ?? 'artikel');
        return 'https://picsum.photos/seed/' . urlencode($seed) . '/800/450';
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}