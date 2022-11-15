<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageReceipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'amc_id',
        'date',
        'payment_mode',
        'amount',
        'reference_no',
        'note',
    ];
}
