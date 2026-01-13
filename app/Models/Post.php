<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Post extends Model
{
    protected $fillable = ['title', 'content', 'image', 'user_id'];
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
