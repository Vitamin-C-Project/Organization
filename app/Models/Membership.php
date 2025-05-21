<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membership extends Model
{
    protected $fillable = [
        'member_id',
        'year_id',
        'position_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    #[Scope]
    public function active(Builder $builder): void
    {
        $builder->where('status', 1);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'year_id', 'id');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
