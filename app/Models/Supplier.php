<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'company_name',
        'person_name',
        'supplier_type',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'phone_no',
        'e_mail'
    ];
}
