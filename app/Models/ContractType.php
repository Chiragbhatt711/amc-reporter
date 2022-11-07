<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'group',
        'brand',
        'model',
        'product_code',
        'product_name',
        'product_description'
    ];
}
