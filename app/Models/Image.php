<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class Image extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getThumb() {
        if(!$this->nsfw)
            return "thumbs/{$this->filename}";
        return "blur_thumbs/{$this->filename}";
    }

    public function getImg() {
        return "images/{$this->filename}";
    }

    public function getShortHotUrl() {
        return route('hotImage', $this->shortid);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($image) {
            Storage::delete(["public/images/{$image->filename}",
            "public/thumbs/{$image->filename}",
            "public/blur_thumbs/{$image->filename}"]);
        });
    }
}
