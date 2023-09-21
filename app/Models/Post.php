<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope('first_user', function (Builder $builder) {
            $builder->where('user_id', 1);
        });
    }

    public function user(): BelongsTo
    {
       return $this->belongsTo(User::class);
    }


}
