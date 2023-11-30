<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user1_id', 'user2_id', 'accepted'
    ];

    protected $casts = [
        'accepted' => 'boolean'
    ];

    public function user1() : BelongsTo
    {
        return $this->belongsTo(User::class, "user1_id", "id");
    }

    public function user2() : BelongsTo
    {
        return $this->belongsTo(User::class, "user2_id", "id");
    }
}
