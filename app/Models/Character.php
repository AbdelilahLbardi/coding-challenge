<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Character extends Model
{
    use HasFactory;

    const STATUS_ALIVE = 'alive';
    const STATUS_DEAD = 'dead';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'occupation',
        'nickname',
        'image',
        'status',
        'category',
        'seasons'
    ];

    protected $casts = [
        'occupation' => AsArrayObject::class,
        'seasons' => AsArrayObject::class,
        'status' => 'bool'
    ];

    public function isAlive(): bool
    {
        return $this->attributes['status'];
    }

    public function isDead(): bool
    {
        return !$this->isAlive();
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value) == self::STATUS_ALIVE;
    }

    public function getStatusAttribute($value)
    {
        return ($value ? self::STATUS_ALIVE : self::STATUS_DEAD);
    }

    /**
     * @return HasMany
     */
    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function death(): HasOne
    {
        return $this->hasOne(Death::class);
    }

    /**
     * Creates the character by name if not provided by the API
     *
     * @param string $name
     * @return Character|Model
     */
    public static function findByNameOrCreate(string $name): Character|Model
    {
        return Character::query()
            ->where('name', '=', $name)
            ->firstOrCreate(
                ['name' => $name],
                ['id' => Character::query()->orderByDesc('id')->select('id')->first()->id + 1]
            );
    }
}
