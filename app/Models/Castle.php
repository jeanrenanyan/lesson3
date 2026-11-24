<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;

class Castle extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'pg_castles';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    protected $guarded = [];

    protected static function booted()
    {
        static::updating(function (Castle $castle) {
            Gate::authorize('update-castle', $castle);
        });

        static::deleting(function (Castle $castle) {
            $ability = $castle->isForceDeleting() ? 'force-delete-castle' : 'delete-castle';

            Gate::authorize($ability, $castle);
        });

        static::restoring(function (Castle $castle) {
            Gate::authorize('restore-castle', $castle);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
