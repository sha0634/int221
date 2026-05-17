<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    protected $fillable = [
        'portfolio_id',
        'client_name',
        'client_email',
        'subject',
        'message',
        'replies',
        'status',
    ];

    protected $casts = [
        'replies' => 'array',
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
