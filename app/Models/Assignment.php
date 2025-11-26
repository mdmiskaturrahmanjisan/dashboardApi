<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'delivery_man_id',
        'customer_id',
        'distance'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function deliveryMan()
    {
        return $this->belongsTo(User::class, 'delivery_man_id');
    }
}
