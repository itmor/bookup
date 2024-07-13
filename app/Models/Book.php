<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'storage_id'];

    public function ratings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating(): int
    {
        $averageRating = $this->ratings()->avg('rate');

        if ($averageRating === null) {
            return 0;
        }

        return max(0, min(5, $averageRating));
    }

    public function hasUserRate(): ?bool
    {
        if (!Auth::check()) {
            return null;
        }

        $userRating = $this->ratings()->where('user_id', Auth::id())->first();

        if ($userRating) {
            return $userRating->rate;
        }

        return false;
    }

    public function getPreviewBase64(): string
    {
       return FileHelper::get($this->storage_id);
    }
}
