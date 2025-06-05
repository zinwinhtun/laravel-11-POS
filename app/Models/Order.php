<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Payment_History;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    //
    protected $guarded = [];

    /**
     * Get the user/payment_history/product that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment_history(): BelongsTo
    {
        return $this->belongsTo(Payment_History::class);
    }

     public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
