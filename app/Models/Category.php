<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    protected $guarded = [];

   /**
    * Get all of the Product for the Category
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function Product(): HasMany
   {
       return $this->hasMany(Product::class);
   }
}
