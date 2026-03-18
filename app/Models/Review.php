<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'user_id',
        'course_id',
        'quality',
        'difficulty',
        'punctuality',
        'organization',
        'takes_attendance',
        'teacher_role',
        'comment',
        'would_take_again',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function helpfulnessVotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ReviewHelpfulness::class);
    }

    public function getHelpfulCountAttribute()
    {
        return $this->helpfulnessVotes()->where('is_helpful', true)->count();
    }

    public function getNotHelpfulCountAttribute()
    {
        return $this->helpfulnessVotes()->where('is_helpful', false)->count();
    }
}
