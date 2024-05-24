<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'unit',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function nutritionalFact(){
        return $this->hasMany(NutritionalFact::class);
    }

}
