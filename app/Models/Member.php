<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory;

    protected  $fillable = [
        'year_id',
        'grade_id',
        'name',
        'phone',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'father_name',
        'status',
        'created_by',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'status' => 'boolean',
    ];

    public  function year(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'year_id', 'id');
    }

    public  function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public  function membership(): HasOne {
        return $this->hasOne(Membership::class, 'member_id', 'id');
    }
}
