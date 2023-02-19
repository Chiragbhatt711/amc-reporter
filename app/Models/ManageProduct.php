<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'group_id',
        'brand',
        'model',
        'product_code',
        'product_name',
        'mrp',
        'min_qty',
        'unit',
        'opening_qty',
        'description'
    ];
}
