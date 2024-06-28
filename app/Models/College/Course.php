<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'courseName'
    ];
    protected $table = 'courses';

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student','course_id','student_id')
        ->withPivot('additional_info')
        ->withTimestamps();
    }
}
