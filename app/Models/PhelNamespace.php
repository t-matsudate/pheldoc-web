<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhelNamespace extends Model
{
    use HasFactory;

    protected $fillable = [
        'namespace'
    ];
}
