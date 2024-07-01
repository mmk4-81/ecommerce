<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'priority',
        'is_active',
        'type',
        'button_text',
        'button_link',
        'button_icon',
    ];

    const TYPES = ['header', 'footer', 'sidebar'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
