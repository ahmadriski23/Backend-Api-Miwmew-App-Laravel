<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'gender',
        'description',
        'price',
        'weight',
        'born',
        'date_of_birth',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
