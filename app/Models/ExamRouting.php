<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRouting extends Model
{
    use HasFactory;

    protected $fillable = ['semester', 'class_id', 'subject_id', 'exam_date', 'exam_time'];

    public function myClass()
    {
        return $this->belongsTo(MyClass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
