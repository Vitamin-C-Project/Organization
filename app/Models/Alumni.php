<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'member_id',
        'membership_id',
        'destination_name',
        'appointment',
        'graduation_year',
        'type',
        'status',
    ];

    protected $casts = [
        'type' => 'integer',
        'status' => 'boolean',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class, 'membership_id', 'id');
    }
}
