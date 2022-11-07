<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageParty extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'party_name',
        'contact_person_name',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'mobile_no',
        'phone_no',
        'email',
        'opening_balance',
        'extf_1',
        'extf_2',
        'extf_3',
        'extf_4',
        'extf_5',
    ];
}
