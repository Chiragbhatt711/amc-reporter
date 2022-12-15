<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallUpdateItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'complaint_id',
        'item_name',
        'used_qty',
        'rate',
        'amount',
    ];
}
