<?php

namespace App\Http\Controllers\Films;

use App\Http\Controllers\Controller;
use App\Http\Requests\Films\CreateMovieRequest;
use App\Http\Requests\Films\UpdateMovieWithPivotRequest;
use App\Models\Films\Movie;
use Exception;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function createMovie(CreateMovieRequest $request)
    {
        try {
            $movie = Movie::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Movie added successfully.',
                'data' => $movie,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function updateMovieWithPivot(UpdateMovieWithPivotRequest $request, $movie_id)
    {
        try {
            $movie = Movie::findOrFail($movie_id);
            $movie->update($request->only(['title', 'duration']));

            if ($request->has('genres')) {
                $genres = collect($request->genres)->mapWithKeys(function ($genre) {
                    return [$genre['genre_id'] => ['extra_info' =>$genre['extra_info']]];
                });
                $movie->genres()->sync($genres);
            }

            return response()->json([
                'success' => true,
                'message' => 'Movie updated successfully',
                'data' => $movie,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function deleteMovie($movie_id)
    {
        try {
            $movie = Movie::findOrFail($movie_id);
            $movie->delete();
            return response()->json([
                'success' => true,
                'message' => 'Movie deleted successfully',
                'data' => null,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getMovie($movie_id)
    {
        try {
            $movie = Movie::with('genres')->findOrFail($movie_id);
            $perPage = 5;
            return response()->json([
                'success' => true,
                'message' => 'Movie retrieved succcessfully',
                'data' => $movie,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getAllMovies()
    {
        try {
            $perPage = 5;
            $movies = Movie::with('genres')->paginate($perPage);
            return response()->json([
                'success' => true,
                'message' => 'Movies retrieved succcessfully',
                'data' => $movies,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
