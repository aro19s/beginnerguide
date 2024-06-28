<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentName',
        'age'
    ];
    protected $table = 'students';

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student','student_id','course_id')
        ->withPivot('additional_info')
        ->withTimestamps();
    }
}
