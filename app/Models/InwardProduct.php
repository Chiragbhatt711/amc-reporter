<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InwardProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'inward_id',
        'product_id',
        'qty',
        'rate',
        'amount'
    ];
}
