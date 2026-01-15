<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Opinion extends Model
{
    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_email',
        'title',
        'slug',
        'content',
        'status',
        'published_at',
        'admin_note',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_REVIEWED  = 'reviewed';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_REJECTED  = 'rejected';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
            ->whereNotNull('published_at');
    }

    public static function makeUniqueSlug(string $title): string
    {
        $base = Str::slug(Str::limit($title, 80, ''), '-');
        $slug = $base ?: Str::random(8);

        $i = 2;
        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
