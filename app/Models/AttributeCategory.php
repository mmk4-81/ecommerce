<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributeCategory extends Pivot
{
    protected $table = 'attribute_category';

    protected $fillable = [
        'attribute_id',
        'category_id',
        'is_filter',
        'is_variation',
    ];
}
