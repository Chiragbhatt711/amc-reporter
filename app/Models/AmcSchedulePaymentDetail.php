<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmcSchedulePaymentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'amc_id',
        'installment_date',
        'installment_amount'
    ];
}
