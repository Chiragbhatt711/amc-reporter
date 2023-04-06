<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutwardProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'outward_id',
        'product_id',
        'qty',
        'rate',
        'amount'
    ];
}
