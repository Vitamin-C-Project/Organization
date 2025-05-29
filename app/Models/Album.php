<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'status',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str($value . "-" . time())->slug();
    }

    #[Scope]
    public function active(Builder $builder): void
    {
        $builder->where('status', 1);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
