<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageComplaintTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'title',
        'description',
        'priority'
    ];
}
