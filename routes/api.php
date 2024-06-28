<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\College\CourseController;
use App\Http\Controllers\FruitsController;
use App\Http\Controllers\NumberController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\College\StudentController;
use App\Http\Controllers\Films\MovieController;
use App\Http\Controllers\Films\GenreController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\ZodiacController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/my-age', [PeopleController::class, 'ageCalculator']);
Route::post('/number-comparator', [NumberController::class, 'numberComparator']);
Route::post('/zodiac-predictor', [ZodiacController::class, 'zodiacPredictor']);
Route::post('/text-comparator', [TextController::class, 'textComparator']);

Route::get('fruits/show-all', [FruitsController::class, 'showAll']);
Route::post('fruits/create', [FruitsController::class, 'create']);
Route::get('fruits/show/{id}', [FruitsController::class, 'show']);
Route::put('fruits/update/{id}', [FruitsController::class, 'update']);
Route::delete('fruits/delete/{id}', [FruitsController::class, 'delete']);

Route::post('fruits/buy-fruit/{id}', [FruitsController::class, 'buyFruit']);
Route::post('fruits/supply-fruit/{id}', [FruitsController::class, 'supplyFruit']);

Route::get('fruits/missing-fruits', [FruitsController::class, 'missingFruits']);

Route::get('fruits/vegetables', [FruitsController::class, 'vegetables']);
Route::get('fruits/apples-existance', [FruitsController::class, 'applesExistance']);
Route::post('fruits/filter', [FruitsController::class, 'productsFilter']);

Route::post('company/create-department', [CompanyController::class, 'createDepartments']);
Route::post('company/create-employee', [CompanyController::class, 'createEmployees']);
Route::get('company/show-employee/{id}', [CompanyController::class, 'getEmployees']);
Route::get('company/show-department/{id}', [CompanyController::class, 'getDepartments']);
Route::get('company/show-employees', [CompanyController::class, 'getAllEmployees']);
Route::get('company/show-departments', [CompanyController::class, 'getAllDepartments']);
Route::put('company/update-employee/{id}', [CompanyController::class, 'updateEmployee']);
Route::put('company/update-department/{id}', [CompanyController::class, 'updateDepartment']);
Route::delete('company/delete-employee/{id}', [CompanyController::class, 'deleteEmployee']);
Route::delete('company/delete-department/{id}', [CompanyController::class, 'deleteDepartment']);

Route::post('company/create-task', [CompanyController::class, 'createTask']);

Route::post('/courses/create', [CourseController::class, 'createCourse']);
Route::get('/courses/getById/{course_id}', [CourseController::class, 'getCourse']);
Route::get('/courses/get-all', [CourseController::class, 'getAllCourses']);
Route::get('/courses/get-all-without-students', [CourseController::class, 'getExistingCourses']);
Route::put('/courses/edit/{course_id}', [CourseController::class, 'updateCourse']);
Route::delete('/courses/delete/{course_id}', [CourseController::class, 'deleteCourse']);

Route::post('/students/create', [StudentController::class, 'createStudent']);
Route::post('/students/assign-course/{student_id}', [StudentController::class, 'assignCourse']);
Route::post('/students/assign-courses/{student_id}', [StudentController::class, 'assignCourses']);
Route::delete('/students/delete/{student_id}', [StudentController::class, 'deleteStudent']);
Route::get('/students/get-student/{course_id}', [StudentController::class, 'getStudent']);
Route::get('/students/get-all-students', [StudentController::class, 'getAllStudents']);
Route::put('/students/edit/{student_id}', [StudentController::class, 'updateStudent']);
Route::put('/students/edit-student-with-pivot/{student_id}', [StudentController::class, 'updateStudentWithPivot']);

Route::post('/films/create-movie', [MovieController::class, 'createMovie']);
Route::delete('/films/delete-movie/{movie_id}', [MovieController::class, 'deleteMovie']);
Route::get('/films/get-movie/{movie_id}', [MovieController::class, 'getMovie']);
Route::get('/films/get-all-movies', [MovieController::class, 'getAllMovies']);
Route::put('/films/edit-movie-with-pivot/{movie_id}', [MovieController::class, 'updateMovieWithPivot']);

Route::post('/films/create-genre', [GenreController::class, 'createGenre']);
Route::get('/films/get-genre/{genre_id}', [GenreController::class, 'getGenre']);
Route::get('/films/get-all-genres', [GenreController::class, 'getAllGenres']);
Route::put('/films/edit/{genre_id}', [GenreController::class, 'updateGenre']);
Route::delete('/films/delete-genre/{genre_id}', [GenreController::class, 'deleteGenre']);
