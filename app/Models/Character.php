<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Character extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'enemy',
        'defence',
        'strength',
        'accuracy',
        'magic',
        'user_id',
        //a képességpontok (defence, strength, accuracy, magic) összege nem haladhatja meg a 20-at
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contests()
    {
        return $this->belongsToMany(Contest::class)->withPivot('hero_hp', 'enemy_hp');
    }
}
