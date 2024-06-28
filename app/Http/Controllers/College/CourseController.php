<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Http\Requests\College\Course\CoursesRequest;
use App\Http\Requests\College\Course\UpdateCourseRequest;
use App\Models\College\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function createCourse(CoursesRequest $request)
    {
        try {
            $course = Course::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Curso creado con éxito',
                'data' => $course,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getCourse($course_id)
    {
        try {
            $course = Course::with('students')->findOrFail($course_id);
            return response()->json([
                'success' => true,
                'message' => 'Curso recuperado con éxito',
                'data' => $course,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getAllCourses()
    {
        try {
            $courses = Course::with('students')->get();

            // Agregar un registro de depuración
            foreach ($courses as $course) {
                Log::info('Course: ', $course->toArray());
                foreach ($course->students as $student) {
                    Log::info('Student: ', $student->toArray());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Cursos recuperados con éxito',
                'data' => $courses,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getExistingCourses()
    {
        try {
            $courses = Course::all();
            return response()->json([
                'success' => true,
                'message' => 'Cursos existentes recuperados con éxito',
                'data' => $courses,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function updateCourse(UpdateCourseRequest $request, $course_id)
    {
        try {
            $course = Course::findOrFail($course_id);
            $course->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Curso actualizado con éxito',
                'data' => $course,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function deleteCourse($course_id)
    {
        try {
            $course = Course::findOrFail($course_id);
            $course->delete();
            return response()->json([
                'success' => true,
                'message' => 'Curso eliminado con éxito',
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
}
