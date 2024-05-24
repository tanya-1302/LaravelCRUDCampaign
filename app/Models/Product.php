<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'units',
        'image',
        'barcode',
        'category',
        'manufacturer_id'
    ];

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }

    public function ingredient(){
        return $this->hasMany(Ingredient::class);
    }
}
