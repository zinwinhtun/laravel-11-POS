<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [];

    public static function payment_methods(){
        return [
           'Cash'=> 'Cash',
           'Card' => 'Card',
           'K-Pay'=> 'K-Pay',
           'CB-Pay' => 'CB-Pay',
           'Wave Money' => 'Wave Money',
           'True Money' => 'True Money',
           'AYA-Pay' => 'AYA-Pay'
        ];
    }
}
