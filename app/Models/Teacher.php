<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * Scope a query to search teachers by name or course name.
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function (Builder $query, $term) {
            $query->where(function (Builder $query) use ($term) {
                $query->where('name', 'like', "%{$term}%")
                      ->orWhereHas('courses', function (Builder $query) use ($term) {
                          $query->where('name', 'like', "%{$term}%")
                                ->orWhere('code', 'like', "%{$term}%");
                      });
            });
        });
    }

    /**
     * Scope a query to include the average quality rating.
     */
    public function scopeWithAvgQuality(Builder $query): Builder
    {
        return $query->withAvg('reviews', 'quality');
    }
}
