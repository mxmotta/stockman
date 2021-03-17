<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price'
    ];

    public function quantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }

    public function getInAttribute()
    {
        return $this->quantities()->where('type', 'in')->sum('quantity');        
    }

    public function getOutAttribute()
    {
        return $this->quantities()->where('type', 'out')->sum('quantity');        
    }

    public function getTotalAttribute()
    {
        return $this->in - $this->out;
    }
}
