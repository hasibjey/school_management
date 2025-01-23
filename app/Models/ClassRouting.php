<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRouting extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_day',
        'class_id',
        'subject_id',
        'class_time'
    ];

    public function myClass()
    {
        return $this->belongsTo(MyClass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
