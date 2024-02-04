<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
    ];
    public function supply_category(){
        return $this->belongsTo(SupplyCategory::class);
    }
}
