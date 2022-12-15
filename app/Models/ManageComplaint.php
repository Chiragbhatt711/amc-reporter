<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageComplaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'amc_no',
        'product_id',
        'complaint_by',
        'comp_by_mobile_number',
        'description',
        'priority',
        'handover',
        'handover_to',
        'handover_date',
        'handover_time',
        'update_date',
        'status',
        'attend_by',
        'solution_id',
        'call_description',
        'call_remark',
    ];
}
