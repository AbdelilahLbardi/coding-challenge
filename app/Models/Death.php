<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Death extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'character_id',
        'responsible_id',
        'cause',
        'last_words',
        'season',
        'episode',
        'death_caused_count'
    ];

    /**
     * @return BelongsTo
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * @return HasOne
     */
    public function responsible(): HasOne
    {
        return $this->hasOne(Character::class, 'id', 'responsible_id');
    }
}
