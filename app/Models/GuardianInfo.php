<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'father_name', 'mother_name', 'phone', 'alternate_phone'
    ];
}
