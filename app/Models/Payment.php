<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [];

    public static function payment_methods(){
        return [
           'Card' => 'Card',
           'KBZ-Pay'=> 'KBZ-Pay',
           'CB-Pay' => 'CB-Pay',
           'Wave Money' => 'Wave Money',
           'True Money' => 'True Money',
           'AYA-Pay' => 'AYA-Pay',
           'Other' => 'Other'
        ];
    }
}
