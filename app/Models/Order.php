<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'customer_name',
        'total',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
