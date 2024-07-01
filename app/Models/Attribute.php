<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('is_filter', 'is_variation');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('value', 'is_active');
    }
}
