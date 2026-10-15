<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairRequestPhoto extends Model
{
    protected $fillable = [
        'repair_request_id',
        'photo_path',
    ];

    public function repairRequest(): BelongsTo
    {
        return $this->belongsTo(RepairRequest::class);
    }
}