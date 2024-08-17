<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhelFunction extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'symbol_type',
        'description'
    ];

    protected $attributes = [
        'description' => null,
    ];

    public function phelNamespace(): BelongsTo
    {
        return $this->belongsTo(PhelNamespace::class);
    }

    public function usageExamples(): HasMany
    {
        return $this->hasMany(UsageExample::class);
    }
}
