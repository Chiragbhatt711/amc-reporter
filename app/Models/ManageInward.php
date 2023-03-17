<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageInward extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'inward_date',
        'supplier_id',
        'note',
    ];
}
