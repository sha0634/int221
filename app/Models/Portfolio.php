<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    protected $fillable = [
        'user_id',
        'template_name',
        'theme_color',
        'title',
        'bio',
        'about_text',
        'avatar',
        'banner',
        'skills',
        'keywords',
        'projects',
        'social_links',
        'slug',
        'is_live',
        'search_appearances',
    ];

    protected $casts = [
        'skills' => 'array',
        'keywords' => 'array',
        'projects' => 'array',
        'social_links' => 'array',
        'is_live' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(PortfolioView::class);
    }
}
