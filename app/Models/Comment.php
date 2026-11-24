<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;     

    protected $fillable = [
        'castle_id',
        'user_id',
        'text', 
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function castle(): BelongsTo
    {
        return $this->belongsTo(Castle::class, 'castle_id');
    }
}
