<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'price',
        'stock',
        'onCart'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
