<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuantity extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'type'
    ];

    const TYPES = [
        0 => 'in',
        1 => 'out'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
