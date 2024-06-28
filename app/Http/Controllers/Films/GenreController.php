<?php

namespace App\Http\Controllers\Films;

use App\Http\Requests\Films\CreateGenreRequest;
use App\Http\Controllers\Controller;
use App\Models\Films\Genre;
use Exception;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function createGenre(CreateGenreRequest $request)
    {
        try {
            $genre = Genre::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Genre added successfully',
                'data' => $genre,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getGenre($genre_id)
    {
        try {
            $genre = Genre::with('movies')->findOrFail($genre_id);
            return response()->json([
                'success' => true,
                'message' => 'Genre retrieved successfully',
                'data' => $genre,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getAllGenres()
    {
        try {
            $perPage = 5;
            $genres = Genre::with('movies')->paginate($perPage);
            return response()->json([
                'success' => true,
                'message' => 'Genres retrieved successfully',
                'data' => $genres,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function updateGenre(Request $request, $genre_id)
    {
        try {
            $genre = Genre::findOrFail($genre_id);
            $genre->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Genre updated successfully',
                'data' => $genre,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function deleteGenre($genre_id)
    {
        try {
            $genre = Genre::findOrFail($genre_id);
            $genre->delete();
            return response()->json([
                'success' => true,
                'message' => 'Genre deleted successfully',
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
}
