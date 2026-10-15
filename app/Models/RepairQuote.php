<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairQuote extends Model
{
    protected $fillable = [
        'repair_request_id',
        'parts_cost',
        'labor_cost',
        'tax_amount',
        'notes',
        'status',
    ];

    public function repairRequest(): BelongsTo
    {
        return $this->belongsTo(RepairRequest::class);
    }
}