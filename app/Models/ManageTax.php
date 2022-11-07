<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageTax extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'profile_name',
        'tax_lable_name',
        'tax_caption_1',
        'tax_percentage_1',
        'tax_caption_2',
        'tax_percentage_2',
        'tax_caption_3',
        'tax_percentage_3',
        'tax_caption_4',
        'tax_percentage_4',
        'tax_caption_5',
        'tax_percentage_5',
    ];
}
