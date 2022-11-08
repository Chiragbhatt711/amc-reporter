<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageAmc extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'party_id',
        'amc_type',
        'start_date',
        'end_date',
        'product_id',
        'qty',
        'note',
        'contract_amount',
        'tax',
        'extf1',
        'extf2',
        'extf3',
        'extf4',
        'extf5',
        'extf6',
        'extf7',
        'extf8',
        'extf9',
        'extf10',
        'service_day',
        'no_of_service',
        'total_amount',
    ];
}
