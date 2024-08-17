<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsageExample extends Model
{
    use HasFactory;

    protected $fillable = [
        'example'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function phelFunction(): BelongsTo
    {
        return $this->belongsTo(PhelFunction::class);
    }
}
