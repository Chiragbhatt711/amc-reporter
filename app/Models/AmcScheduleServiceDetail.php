<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmcScheduleServiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'amc_id',
        'service_date'
    ];
}
