<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalFact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'unit',
        'ingredient_id'
    ];

    public function ingredient(){
        return $this->belongsToMany(Ingredient::class, 'ingredient_nutritional_fact');
    }
}
