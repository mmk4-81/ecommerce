<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'following_shop_id',
        'following_date',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followingShop()
    {
        return $this->belongsTo(Shop::class, 'following_shop_id');
    }
}
