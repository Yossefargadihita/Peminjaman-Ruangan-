<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'floor', 'status', 'rental_price'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_room')->withPivot('quantity')->withTimestamps();
    }
}
