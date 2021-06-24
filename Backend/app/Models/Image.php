<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'title'];

    /*
     * book has many images, images belongs to 1 event
     */
    public function event() : BelongsTo {
        return $this->belongsTo(Event::class);
    }
}


