<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'file_name',
        'file_path',
        'file_type',
        'file_extension',
        'file_size',
    ];

    protected static function booted()
    {
        static::deleting(function ($gallery) {
            Storage::disk('public')->delete($gallery->file_path);

            $extension = self::where([
                'file_extension' => $gallery->file_extension,
                'album_id' => $gallery->album_id
            ]);
            if ($extension->count() < 2) {
                Storage::disk('public')->deleteDirectory("files/{$gallery->album_id}/{$gallery->file_extension}");
            }
        });
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
