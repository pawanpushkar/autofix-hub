<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RepairRequest extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle',
        'year',
        'description',
        'status',
        'customer_name',
        'customer_email',
        'customer_phone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(RepairQuote::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(RepairRequestPhoto::class);
    }
}