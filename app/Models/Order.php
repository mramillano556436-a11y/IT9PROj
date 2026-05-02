<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'status', 'total', 'items_count', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
    return $this->hasMany(OrderItem::class);
    }
}
