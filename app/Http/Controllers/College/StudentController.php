<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Http\Requests\College\Student\AssignCourseRequest;
use App\Http\Requests\College\Student\AssignCoursesRequest;
use App\Http\Requests\College\Student\StudentsRequest;
use App\Http\Requests\College\Student\UpdateStudentRequest;
use App\Http\Requests\College\Student\UpdateStudentWithPivotRequest;
use App\Models\College\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function createStudent(StudentsRequest $request)
    {
        try {
            $student = Student::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Student registered successfully',
                'data' => $student
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function assignCourse(AssignCourseRequest $request, $student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            $student->courses()->attach($request->course_id);
            return response()->json([
                'success' => true,
                'message' => 'Course assigned successfully!',
                'data' => $student,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function assignCourses(AssignCoursesRequest $request, $student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            $student->courses()->attach($request->courses_ids);
            return response()->json([
                'success' => true,
                'message' => 'Courses assigned successfully!',
                'data' => $student,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function deleteStudent($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            $student->delete();
            return response()->json([
                'success' => true,
                'message' => 'Student removed successfully!',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getStudent($student_id)
    {
        try {
            $student = Student::with('courses')->findOrFail($student_id);
            return response()->json([
                'success' => true,
                'message' => 'Student retrieved successfully!',
                'data' => $student,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getAllStudents()
    {
        try {
            $students = Student::with('courses')->get();
            Log::info('Students data: ', $students->toArray());
            return response()->json([
                'success' => true,
                'message' => 'Students retrieved successfully!',
                'data' => $students,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function updateStudent(UpdateStudentRequest $request, $student_id)
    {
        try {
            $student = Student::findOrFail($student_id);

            $student->update($request->only(['studentName', 'age']));

            if ($request->has('course_ids')) {
                $student->courses()->sync($request->course_ids);
            }
            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully!',
                'data' => $student,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function updateStudentWithPivot(UpdateStudentWithPivotRequest $request, $student_id)
    {
        try {
            $student = Student::findOrFail($student_id);

            // Actualizar los datos del estudiante
            $student->update($request->only(['studentName', 'age']));

            // Actualizar los cursos asociados si se proporciona
            if ($request->has('courses')) {
                $courses = collect($request->courses)->mapWithKeys(function ($course) {
                    return [$course['course_id'] => ['additional_info' => $course['additional_info']]];
                });
                $student->courses()->sync($courses);
            }
            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully!',
                'data' => $student,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
