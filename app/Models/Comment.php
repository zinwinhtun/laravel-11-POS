<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    //
    protected $guarded = [];


    //Database relationship

    /**
     * Get the user that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    //for user table
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    //for product table
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
